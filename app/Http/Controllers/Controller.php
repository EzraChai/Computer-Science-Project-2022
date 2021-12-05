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
            $competitions = Pertandingan::all();
            return view('dashboard', compact('competitions', 'participantCount', 'userCount'));
        }
        return view('dashboard', compact('competitions', 'participantCount', 'userCount'));
    }

    public function user()
    {
        if (Auth()->user()->is_admin) {
            $user = Auth()->user();
            $users = User::where('id', "!=", $user->id)->get();
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

            dd($validated['accountType']);

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
        $isAdmin = $user->is_admin;
        $name = $user->name;

        if (Auth()->user()->is_admin) {
            $user = User::find($user->id);
            $user->delete();
        }
        return redirect('/user')->with('status',  $isAdmin ? 'Urus Setia' : 'Hakim' . ' dengan [' . $name . '] telah dipotongkan.');
    }

    public function changeStatus($id)
    {

        $user = User::findOrFail($id);

        $isAdmin = $user->is_admin;
        $name = $user->name;

        if (Auth()->user()->is_admin) {
            if ($isAdmin) {
                $user->is_admin = false;
                $user->update();
            } else {
                $user->is_admin = true;
                $user->update();
            }
        }
        return redirect('/user')->with('status',  $isAdmin ? 'Urus Setia' : 'Hakim' . ' dengan [' . $name . '] telah diupdatekan.');
    }

    public function home()
    {
        $competitions = Cache::remember('four_competitions', 30, function () {
            return Pertandingan::all()->take(4);
        });

        return view('welcome', compact('competitions'));
    }
}
