<?php

namespace App\Http\Controllers;

use App\Models\MarkahPeserta;
use App\Models\Pertandingan;
use App\Models\Peserta;
use App\Models\Pusingan;
use Illuminate\Http\Request;
use Illuminate\Http\Testing\MimeType;

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
            $participants = Peserta::where(
                "pertandingan_id",
                $competition_id
            )->get();

            return view(
                "peserta.participant",
                compact("competition_id", "participants", "competition_type")
            );
        }
        return redirect("/dashboard/competition/" . $competition_id);
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
            return view(
                "peserta.register",
                compact("competition_id", "competition_type")
            );
        }

        return redirect("/dashboard/competition/" . $competition_id);
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
                    "name1" => ["required", "string", "max:255"],
                    "name2" => ["required", "string", "max:255"],
                    "identity1" => ["required", "max:12"],
                    "identity2" => ["required", "max:12"],
                    "school" => ["required", "string", "min:4", "max:255"],
                ]);
                $peserta = Peserta::create([
                    "identity" => $validated["identity1"],
                    "secondIdentity" => $validated["identity2"],
                    "name" => $validated["name1"],
                    "secondName" => $validated["name2"],
                    "school" => $validated["school"],
                    "pertandingan_id" => $competition_id,
                ]);
            } else {
                $validated = $request->validate([
                    "name" => ["required", "string", "max:255"],
                    "identity" => ["required", "max:12"],
                    "school" => ["required", "string", "min:4", "max:255"],
                ]);
                $peserta = Peserta::create([
                    "identity" => $validated["identity"],
                    "name" => $validated["name"],
                    "school" => $validated["school"],
                    "pertandingan_id" => $competition_id,
                ]);
            }

            $arrPusingan = Pusingan::where(
                "pertandingan_id",
                $competition_id
            )->get();
            for ($i = 0; $i < 5; $i++) {
                MarkahPeserta::create([
                    "peserta_id" => $peserta->id,
                    "pusingan_id" => $arrPusingan[$i]->id,
                    "marks" => 0,
                    "total_marks" => 0,
                ]);
            }
            return redirect(
                "/dashboard/competition/" . $competition_id . "/participant"
            );
        }
        return redirect("/dashboard/competition/" . $competition_id);
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
            return view(
                "peserta.edit",
                compact("competition_id", "participant", "competition_type")
            );
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
                    "name1" => ["required", "string", "max:255"],
                    "name2" => ["required", "string", "max:255"],
                    "identity1" => ["required", "string"],
                    "identity2" => ["required", "string"],
                    "school" => ["required", "string", "min:4", "max:255"],
                ]);

                $participant = Peserta::findOrFail($id);
                $participant->name = $validated["name1"];
                $participant->secondName = $validated["name2"];
                $participant->identity = $validated["identity1"];
                $participant->secondIdentity = $validated["identity2"];
                $participant->school = $validated["school"];
                $participant->update();

                return redirect(
                    "/dashboard/competition/" . $competition_id . "/participant"
                );
            } else {
                $validated = $request->validate([
                    "name" => ["required", "string", "max:255"],
                    "identity" => ["required", "string"],
                    "school" => ["required", "string", "min:4", "max:255"],
                ]);

                $participant = Peserta::findOrFail($id);
                $participant->name = $validated["name"];
                $participant->identity = $validated["identity"];
                $participant->school = $validated["school"];
                $participant->update();

                return redirect(
                    "/dashboard/competition/" . $competition_id . "/participant"
                );
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
            return redirect(
                "/dashboard/competition/" . $competition_id . "/participant"
            );
        }
        return redirect("/dashboard/competition/" . $competition_id);
    }

    /**
     * Show participant import page
     */
    public function showParticipantImport($competition_id)
    {
        if (Auth()->user()->is_admin) {
            $competition_type = Pertandingan::findOrFail($competition_id)->type;
            return view(
                "peserta.import",
                compact("competition_id", "competition_type")
            );
        }

        return redirect("/dashboard/competition/" . $competition_id);
    }

    /**
     * Import Participants from .csv file
     */
    public function storeParticipantImport(Request $request, $competition_id)
    {
        if (Auth()->user()->is_admin) {
            $file = $request->file("uploaded_file");
            if ($file) {
                $fileMimeType = MimeType::from($file->getClientOriginalName());
                if ($fileMimeType == "text/csv") {
                    $filename = $file->getClientOriginalName();

                    //Where uploaded file will be stored on the server
                    $location = "uploads"; //Created an "uploads" folder for that
                    // Upload file
                    $file->move($location, $filename);
                    // In case the uploaded file path is to be stored in the database
                    $filepath = public_path($location . "/" . $filename);
                    // Reading file
                    $file = fopen($filepath, "r");
                    $importData_arr = []; // Read through the file and store the contents as an array
                    $i = 0;
                    //Read the contents of the uploaded file
                    while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                        $num = count($filedata);
                        // Skip first row (Remove below comment if you want to skip the first row)
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file); //Close after reading
                }
            }

            if (Pertandingan::findOrFail($competition_id)->type == "Seirama") {
                foreach ($importData_arr as $importData) {
                    $peserta = Peserta::create([
                        "identity" => $importData[0],
                        "secondIdentity" => $importData[1],
                        "name" => $importData[2],
                        "secondName" => $importData[3],
                        "school" => $importData[4],
                        "pertandingan_id" => $competition_id,
                    ]);

                    $arrPusingan = Pusingan::where(
                        "pertandingan_id",
                        $competition_id
                    )->get();
                    for ($i = 0; $i < 5; $i++) {
                        MarkahPeserta::create([
                            "peserta_id" => $peserta->id,
                            "pusingan_id" => $arrPusingan[$i]->id,
                            "marks" => 0,
                            "total_marks" => 0,
                        ]);
                    }
                }
            } else {
                foreach ($importData_arr as $importData) {
                    $peserta = Peserta::create([
                        "identity" => $importData[0],
                        "name" => $importData[2],
                        "school" => $importData[4],
                        "pertandingan_id" => $competition_id,
                    ]);

                    $arrPusingan = Pusingan::where(
                        "pertandingan_id",
                        $competition_id
                    )->get();
                    for ($i = 0; $i < 5; $i++) {
                        MarkahPeserta::create([
                            "peserta_id" => $peserta->id,
                            "pusingan_id" => $arrPusingan[$i]->id,
                            "marks" => 0,
                            "total_marks" => 0,
                        ]);
                    }
                }
            }
            return redirect(
                "/dashboard/competition/" . $competition_id . "/participant"
            )->with("status", "Import fail telah berjaya.");
        }
        return redirect(
            "/dashboard/competition/" . $competition_id . "/participant"
        );
    }
}
