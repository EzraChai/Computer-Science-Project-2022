<?php

namespace App\Http\Controllers;

use App\Models\Pertandingan;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    //
    public function query(Request $request)
    {
        $competitions = null;
        if ($request->has('search')) {
            $competitions = Pertandingan::search($request->search)->get();
            $participants = Peserta::where("name", "like", "%" . $request->search . "%")->get();
            if ($participants) {
                $competitionsCount = $competitions->count();
                foreach ($participants as $key => $participant) {
                    if ($competitionsCount == 0) {
                        $competitions[$key] = DB::table("pertandingans")->find($participant->pertandingan_id);
                    } else {
                        $competitions[$competitionsCount + $key] = Pertandingan::find($participant->pertandingan_id);
                    }
                }
            }
            $arr_id = null;
            for ($i = 0; $i < $competitions->count(); $i++) {
                $arr_id[$i] = $competitions[$i]->id;
            }
            $arr_id = array_flip($arr_id);
            $arr_id = array_flip($arr_id);

            $competitions = null;
            $counter = 0;

            foreach ($arr_id as $key => $comp_id) {
                $competitions[$counter] = Pertandingan::findOrFail($comp_id);
                $counter++;
            }

            for ($i = 0; $i < count($competitions); $i++) {
                $competitions[$i]->participantName = DB::table("pesertas")->where("pertandingan_id", $competitions[$i]->id)->pluck("name");
            };
        }

        $text = $request->search;

        return view("pertandingan", compact("competitions", "text"));
    }
}
