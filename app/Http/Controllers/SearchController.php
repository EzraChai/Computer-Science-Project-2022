<?php

namespace App\Http\Controllers;

use App\Models\Pertandingan;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function query(Request $request)
    {
        $competitions = null;
        $text = $request->search;

        if ($request->has('search')) {
            $competitions = Pertandingan::search($request->search)->get();
            $participants = Peserta::where("name", "like", "%" . $request->search . "%")->get();
            $participants2 = Peserta::where("secondName", "like", "%" . $request->search . "%")->get();
            foreach ($participants2 as $key => $participant) {
                if ($participants->count() == 0) {
                    $participants = $participants2;
                } else {
                    $participantsLength = $participants->count();
                    for ($i = 0; $i < $participantsLength; $i++) {
                        $participants[$participantsLength + $i] = $participant;
                    }
                }
            }

            $competitionsCount = $competitions->count();
            foreach ($participants as $key => $participant) {
                if ($competitionsCount == 0) {
                    $competitions[$key] = DB::table("pertandingans")->find($participant->pertandingan_id);
                } else {
                    $competitions[$competitionsCount + $key] = Pertandingan::find($participant->pertandingan_id);
                }
            }
            $arr_id = array();
            for ($i = 0; $i < $competitions->count(); $i++) {
                array_push($arr_id, $competitions[$i]->id);
            }

            //  If there is no competiton then return no conpetition
            if ($arr_id == null) {
                $competitions = array();
                return view("pertandingan", compact("competitions", "text"));
            }

            // Remove same element from an array
            $arr_id = array_unique($arr_id);


            $competitions = null;
            $counter = 0;

            foreach ($arr_id as $key => $comp_id) {
                $competitions[$counter] = Pertandingan::findOrFail($comp_id);
                $counter++;
            }

            for ($i = 0; $i < count($competitions); $i++) {
                $competitions[$i]->participantName = DB::table("pesertas")->where("pertandingan_id", $competitions[$i]->id)->get();
            };
            return view("pertandingan", compact("competitions", "text"));
        }
    }
}
