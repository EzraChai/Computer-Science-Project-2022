<?php

namespace App\Http\Controllers;

use App\Models\MarkahPeserta;
use App\Models\Pertandingan;
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
            $competition_type = Pertandingan::findOrFail($competition_id)->type;
            $participants = Peserta::where('pertandingan_id', $competition_id)->get();

            return view("peserta.participant", compact('competition_id', 'participants', 'competition_type'));
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
        if (Auth()->user()->is_admin) {
            $competition_type = Pertandingan::findOrFail($competition_id)->type;
            return view("peserta.register", compact('competition_id', 'competition_type'));
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
        if (Auth()->user()->is_admin) {
            if ($request->comp_type == "Seirama") {
                $validated = $request->validate([
                    'name1' => ['required', 'string', 'max:255'],
                    'name2' => ['required', 'string', 'max:255'],
                    'identity1' => ['required', 'regex:/(([[0-9]{2})(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01]))([0-9]{2})([0-9]{4})/'],
                    'identity2' => ['required', 'regex:/(([[0-9]{2})(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01]))([0-9]{2})([0-9]{4})/'],
                    'school' => ['required', 'string', 'min:4', 'max:255'],
                ]);
                $peserta = Peserta::create([
                    'identity' => $validated["identity1"],
                    'secondIdentity' => $validated["identity2"],
                    'name' => $validated["name1"],
                    'secondName' => $validated["name2"],
                    'school' => $validated['school'],
                    'pertandingan_id' => $competition_id,
                ]);
            } else {
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
            }

            $arrPusingan = Pusingan::where('pertandingan_id', $competition_id)->get();
            for ($i = 0; $i < 5; $i++) {
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($competition_id, $id)
    {
        if (Auth()->user()->is_admin) {
            $competition_type = Pertandingan::findOrFail($competition_id)->type;
            $participant = Peserta::findOrFail($id);
            return view("peserta.edit", compact('competition_id', 'participant', 'competition_type'));
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
        if (Auth()->user()->is_admin) {
            if ($request->comp_type == "Seirama") {
                $validated = $request->validate([
                    'name1' => ['required', 'string', 'max:255'],
                    'name2' => ['required', 'string', 'max:255'],
                    'identity1' => ['required', 'regex:/(([[0-9]{2})(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01]))([0-9]{2})([0-9]{4})/'],
                    'identity2' => ['required', 'regex:/(([[0-9]{2})(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01]))([0-9]{2})([0-9]{4})/'],
                    'school' => ['required', 'string', 'min:4', 'max:255'],
                ]);

                $participant = Peserta::findOrFail($id);
                $participant->name = $validated['name1'];
                $participant->secondName = $validated['name2'];
                $participant->identity = $validated['identity1'];
                $participant->secondIdentity = $validated['identity2'];
                $participant->school = $validated['school'];
                $participant->update();

                return redirect("/dashboard/competition/" . $competition_id . "/participant");
            } else {
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
        if (Auth()->user()->is_admin) {
            MarkahPeserta::where("peserta_id", $id)->delete();
            Peserta::findOrFail($id)->delete();
            return redirect("/dashboard/competition/" . $competition_id . "/participant");
        }
        return redirect("/dashboard/competition/" . $competition_id);
    }
}
