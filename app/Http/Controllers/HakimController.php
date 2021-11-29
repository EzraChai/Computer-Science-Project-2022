<?php

namespace App\Http\Controllers;

use App\Models\MarkahPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HakimController extends Controller
{
    //
    public function addMarks(Request $request, $competition_id)
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
            return redirect("/dashboard/competition/" . $competition_id . "#add-marks" . $validator->getData()['participant-mark-id'])
                ->withErrors($validator)
                ->withInput();
        }
        $validated = $validator->getData();

        $marks = MarkahPeserta::findOrFail($validated['participant-mark-id']);
        $marks->judge_1 = $validated['judge-1'];
        $marks->judge_2 = $validated['judge-2'];
        $marks->judge_3 = $validated['judge-3'];
        $marks->judge_4 = $validated['judge-4'];
        $marks->judge_5 = $validated['judge-5'];
        $marks->judge_6 = $validated['judge-6'];
        $marks->judge_7 = $validated['judge-7'];
        $marks->difficulty = $validated['difficulty'];
        $marks->penalty = $validated['penalty'];

        $judgesMarks = array($validated['judge-1'], $validated['judge-2'], $validated['judge-3'], $validated['judge-4'], $validated['judge-5'], $validated['judge-6'], $validated['judge-7']);
        sort($judgesMarks);
        array_pop($judgesMarks);
        array_shift($judgesMarks);
        array_pop($judgesMarks);
        array_shift($judgesMarks);
        $marksGivenByJudges = (array_sum($judgesMarks) * $validated['difficulty']) - $validated['penalty'];
        $marks->marks = $marksGivenByJudges;

        if ($marks->pusingan_id == 1 || $marks->pusingan_id % 7 == 0) {
            $marks->total_marks = $marksGivenByJudges;
        } else {
            $previousParticipantMarks = MarkahPeserta::find($validated['participant-mark-id'] - 1);
            $marks->total_marks = $marksGivenByJudges + $previousParticipantMarks->total_marks;
        }
        $marks->update();
        return redirect("/dashboard/competition/" . $competition_id);
    }

    public function changeMarks(Request $request, $competition_id)
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
            return redirect("/dashboard/competition/" . $competition_id . "#change-marks" . $validator->getData()['participant-mark-id'])
                ->withErrors($validator)
                ->withInput();
        }
        $validated = $validator->getData();

        $marks = MarkahPeserta::findOrFail($validated['participant-mark-id']);
        $marks->judge_1 = $validated['judge-1'];
        $marks->judge_2 = $validated['judge-2'];
        $marks->judge_3 = $validated['judge-3'];
        $marks->judge_4 = $validated['judge-4'];
        $marks->judge_5 = $validated['judge-5'];
        $marks->judge_6 = $validated['judge-6'];
        $marks->judge_7 = $validated['judge-7'];
        $marks->difficulty = $validated['difficulty'];
        $marks->penalty = $validated['penalty'];

        $judgesMarks = array($validated['judge-1'], $validated['judge-2'], $validated['judge-3'], $validated['judge-4'], $validated['judge-5'], $validated['judge-6'], $validated['judge-7']);
        sort($judgesMarks);
        array_pop($judgesMarks);
        array_shift($judgesMarks);
        array_pop($judgesMarks);
        array_shift($judgesMarks);
        $marksGivenByJudges = (array_sum($judgesMarks) * $validated['difficulty']) - $validated['penalty'];
        $marks->marks = $marksGivenByJudges;

        if ($marks->pusingan_id == 1 || $marks->pusingan_id % 7 == 0) {
            $marks->total_marks = $marksGivenByJudges;
        } else {
            $previousParticipantMarks = MarkahPeserta::find($validated['participant-mark-id'] - 1);
            $marks->total_marks = $marksGivenByJudges + $previousParticipantMarks->total_marks;
        }
        $marks->update();
        return redirect("/dashboard/competition/" . $competition_id);
    }
}
