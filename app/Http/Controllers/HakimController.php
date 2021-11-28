<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HakimController extends Controller
{
    //
    public function addMarks(Request $request, $competition_id, $participant_id)
    {
        dd($participant_id);
    }
}
