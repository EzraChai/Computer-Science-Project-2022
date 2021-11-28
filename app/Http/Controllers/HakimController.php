<?php

namespace App\Http\Controllers;

use App\Models\MarkahPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HakimController extends Controller
{
    //
    public function addMarks(Request $request, $competition_id, $participant_id)
    {
        $validator = Validator::make($request->all(), [
            'judge-1' => 'required|numeric|between:0,10',
            'judge-2' => 'required|numeric|between:0,10',
            'judge-3' => 'required|numeric|between:0,10',
            'judge-4' => 'required|numeric|between:0,10',
            'judge-5' => 'required|numeric|between:0,10',
            'judge-6' => 'required|numeric|between:0,10',
            'judge-7' => 'required|numeric|between:0,10',
            'difficulty' => 'required|numeric|between:0,5',
            'penalty' => 'required|numeric|between:0,10',
        ]);

        if ($validator->fails()) {
            return redirect("/dashboard/competition/" . $competition_id . "#add-marks")
                ->withErrors($validator)
                ->withInput();
        }
        $validated = $validator->getData();

        $marks = MarkahPeserta::findOrFail($validated['participant-mark-id']);
        $marks->judge_1 = $validated['judge-1'];
        dd($marks);
        $marks->dd($marks);
    }
}
