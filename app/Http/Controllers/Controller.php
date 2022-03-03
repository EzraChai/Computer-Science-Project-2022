<?php

namespace App\Http\Controllers;

use App\Models\Pertandingan;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;
use Iman\Streamer\VideoStreamer;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $user = Auth()->user();
        $competitions = Pertandingan::all();
        $participantCount = Peserta::all()->count();
        $participantCount2 = Peserta::where("secondName", "!=", null)->count();

        $participantCount = $participantCount + $participantCount2;
        $userCount = User::all()->count();

        if ($user->is_admin) {
            $users = User::where('id', "!=", $user->id)->get();
            $competitions = Pertandingan::orderByDesc("created_at")->get();
            return view('dashboard', compact('competitions', 'participantCount', 'userCount'));
        }
        return view('dashboard', compact('competitions', 'participantCount', 'userCount'));
    }

    public function user()
    {
        if (Auth()->user()->is_admin) {
            $users = User::where('id', "!=", Auth()->user()->id)->get();
            return view('user', compact('users'));
        }
        return view('dashboard');
    }

    public function showUserRegister()
    {
        if (Auth()->user()->is_admin) {
            return view('user.register');
        }
        return view('dashboard');
    }

    public function userRegister(Request $request)
    {
        if (Auth()->user()->is_admin) {
            $validated = $request->validate([
                'name' => ['required', 'string', 'unique:users', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'accountType' => 'required',
                'password' => ['required', 'string', new Password, 'confirmed'],
            ]);

            User::create([
                'name' => $validated["name"],
                'email' => $validated["email"],
                'is_admin' => $validated["accountType"] == 'urusSetia',
                'password' => Hash::make($validated['password']),
            ]);
        }
        return redirect('/user');
    }

    public function drop($id)
    {
        $user = User::findOrFail($id);

        if (Auth()->user()->is_admin) {
            $user = User::find($user->id);
            $user->delete();
        }
        return redirect('/user');
    }

    public function changeStatus($id)
    {
        $user = User::findOrFail($id);

        if (Auth()->user()->is_admin) {
            $user -> is_admin = !$user -> is_admin;
            $user->update();
        }
        return redirect('/user');
    }

    public function home()
    {
        $competitions = Cache::remember('four_competitions', 30, function () {
            return Pertandingan::all()->sortByDesc("created_at")->take(4);
        });
        return view('welcome', compact('competitions'));
    }

    public function homeVideo()
    {
        $path = public_path('Monodivingolympicintro(1).webm');
    
        VideoStreamer::streamFile($path);
    }
}