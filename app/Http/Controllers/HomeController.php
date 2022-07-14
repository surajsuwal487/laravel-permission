<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Role::create(['name' => 'admin']);

        // Permission::create(['name' =>  'publish post']);
        return view('home');
    }

    public function github(){
        //send the users request to gitHub
        // dd('here');
        return Socialite::driver('github')->redirect();
    }

    public function githubRedirect(){
        //get oauth request back from github to authenticate users

        $user = Socialite::driver('github')->user();
        
        $user = User::firstOrCreate([
            'email' => $user->email
        ], [
            'name' => $user->name,
            'password' => Hash::make(Str::random(24))
        ]);

        Auth::login($user,true);
        return redirect('/home');
    }
}
