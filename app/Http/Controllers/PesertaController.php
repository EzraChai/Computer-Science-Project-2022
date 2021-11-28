<?php

namespace App\Http\Controllers;

use App\Models\MarkahPeserta;
use App\Models\Peserta;
use App\Models\Pusingan;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexWithCompetitionId($competition_id)
    {
        //
        if (Auth()->user()->is_admin) {
            $participants = Peserta::where('pertandingan_id', $competition_id)->get();

            return view("peserta.participant", compact('competition_id', 'participants'));
        }
        return redirect('/dashboard/competition/' . $competition_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($competition_id)
    {
        //

        if (Auth()->user()->is_admin) {

            return view("peserta.register", compact('competition_id'));
        }

        return redirect('/dashboard/competition/' . $competition_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $competition_id)
    {
        //
        if (Auth()->user()->is_admin) {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'identity' => ['required', 'regex:/(([[0-9]{2})(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01]))([0-9]{2})([0-9]{4})/'],
                'school' => ['required', 'string', 'min:4', 'max:255'],
            ]);
            $peserta = Peserta::create([
                'identity' => $validated["identity"],
                'name' => $validated["name"],
                'school' => $validated['school'],
                'pertandingan_id' => $competition_id,
            ]);

            # code...
            $arrPusingan = Pusingan::where('pertandingan_id', $competition_id)->get();
            for ($i = 0; $i < 6; $i++) {
                MarkahPeserta::create([
                    'peserta_id' => $peserta->id,
                    'pusingan_id' => $arrPusingan[$i]->id,
                    'marks' => 0,
                    'total_marks' => 0,
                ]);
            }
            return redirect("/dashboard/competition/" . $competition_id . "/participant");
        }
        return redirect('/dashboard/competition/' . $competition_id);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($competition_id, $id)
    {
        //
        if (Auth()->user()->is_admin) {
            $participant = Peserta::findOrFail($id);
            return view("peserta.edit", compact('competition_id', 'participant'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $competition_id, $id)
    {
        //
        if (Auth()->user()->is_admin) {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'identity' => ['required', 'regex:/(([[0-9]{2})(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01]))([0-9]{2})([0-9]{4})/'],
                'school' => ['required', 'string', 'min:4', 'max:255'],
            ]);

            $participant = Peserta::findOrFail($id);
            $participant->name = $validated['name'];
            $participant->identity = $validated['identity'];
            $participant->school = $validated['school'];
            $participant->update();

            return redirect("/dashboard/competition/" . $competition_id . "/participant");
        }
        return redirect("/dashboard/competition/" . $competition_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($competition_id, $id)
    {
        //
        if (Auth()->user()->is_admin) {
            MarkahPeserta::where("peserta_id", $id)->delete();

            Peserta::findOrFail($id)->delete();

            return redirect("/dashboard/competition/" . $competition_id . "/participant");
        }
        return redirect("/dashboard/competition/" . $competition_id);
    }
}
