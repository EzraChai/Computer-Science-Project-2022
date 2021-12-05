<?php

namespace App\Http\Controllers;

use App\Models\MarkahPeserta;
use App\Models\Pertandingan;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PertandinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth()->user()->is_admin) {
            return view('pertandingan.menu');
        }
        return redirect('/dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth()->user()->is_admin) {
            return view('pertandingan.menu');
        }
        return redirect('/dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (Auth()->user()->is_admin) {

            $validated = $request->validate([
                'pertandingan-name' => 'required|max:255',
                'pertandingan-avenue' => 'required|max:255',
                'pertandingan-date' => 'required',
                'pertandingan-type' => 'required'
            ]);

            $pertandingan = Pertandingan::create([
                'name' => $validated['pertandingan-name'],
                'avenue' => $validated['pertandingan-avenue'],
                'date' => $validated['pertandingan-date'],
                'type' => $validated['pertandingan-type'],
            ]);

            $pertandingan->pusingan()->createMany([
                ['round' => 1],
                ['round' => 2],
                ['round' => 3],
                ['round' => 4],
                ['round' => 5],
            ]);

            return redirect('/dashboard');
        }
        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $competition = Pertandingan::findOrFail($id);
        $rounds = $competition->pusingan;
        $participantsCount = Peserta::where("pertandingan_id", $id)->count();

        $overallParticipantsMark = null;
        for ($i = 0; $i < $rounds->count(); $i++) {
            $participantsMark = MarkahPeserta::where('pusingan_id', $rounds[$i]->id)->orderBy("total_marks", "DESC")->get();
            $overallParticipantsMark[$i] = $participantsMark;
        }
        return view('pertandingan.show', compact('competition', 'rounds', 'participantsCount', 'overallParticipantsMark'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if (Auth()->user()->is_admin) {
            $competition = Pertandingan::findOrFail($id);
            return view('pertandingan.editmenu', compact('competition'));
        }
        return redirect('/dashboard');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth()->user()->is_admin) {

            $validated = $request->validate([
                'pertandingan-tajuk' => 'required|max:255',
                'pertandingan-avenue' => 'required|max:255',
                'pertandingan-date' => 'required',
                'pertandingan-type' => 'required'
            ]);
            $competition = Pertandingan::findOrFail($id);

            $competition->name = $validated['pertandingan-tajuk'];
            $competition->avenue = $validated['pertandingan-avenue'];
            $competition->date = $validated['pertandingan-date'];
            $competition->type = $validated['pertandingan-type'];

            $competition->update();

            return redirect('/dashboard');
        }
        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if (Auth()->user()->is_admin) {

            $competition = Pertandingan::findOrFail($id);
            $pusinganId = $competition->pusingan;
            for ($i = 0; $i < $pusinganId->count(); $i++) {
                MarkahPeserta::where("pusingan_id", $i + 1)->delete();
            }
            Peserta::where("pertandingan_id", $id)->delete();
            $competition->delete();
            return redirect('/dashboard');
        }
        return redirect('/dashboard');
    }

    public function competition()
    {
        $competitions = Cache::remember('competitions', 60, function () {
            return Pertandingan::all();
        });
        for ($i = 0; $i < $competitions->count(); $i++) {
            $competitions[$i]->participantName = DB::table("pesertas")->where("pertandingan_id", $competitions[$i]->id)->get();
        };
        return view("pertandingan", compact("competitions"));
    }

    public function competitionWithId($id)
    {
        $competition = Pertandingan::findOrFail($id);
        $rounds = $competition->pusingan;
        $participantsCount = Peserta::where("pertandingan_id", $id)->count();
        if ($competition->type == "Seirama") {
            $participantsCount *= 2;
        }

        $overallParticipantsMark = null;
        for ($i = 0; $i < $rounds->count(); $i++) {
            $participantsMark = MarkahPeserta::where('pusingan_id', $rounds[$i]->id)->orderBy("total_marks", "DESC")->get();
            $overallParticipantsMark[$i] = $participantsMark;
        }
        $lastParticipantMark = $overallParticipantsMark[count($overallParticipantsMark) - 1];
        $lastFirstThreeParticipantMark = null;
        try {
            for ($i = 0; $i < 3; $i++) {
                $lastFirstThreeParticipantMark[$i] = $lastParticipantMark[$i];
            }
        } catch (\Throwable $th) {
            $lastFirstThreeParticipantMark = $lastParticipantMark;
        }

        return view('pertandingan-id', compact('competition', 'rounds', 'participantsCount', 'overallParticipantsMark', 'lastFirstThreeParticipantMark'));
    }
}
