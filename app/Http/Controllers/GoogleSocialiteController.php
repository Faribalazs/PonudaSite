<?php

namespace App\Http\Controllers;

use Auth;
use Exception;
use Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;

class GoogleSocialiteController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        config(['services.google.redirect' => route('callback.google') ]);
        return Socialite::driver('google')->redirect();
    }
       
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {
        config(['services.google.redirect' => route('callback.google') ]);
        try {
     
            $user = Socialite::driver('google')->user();
      
            $finduser = User::where('name', $user->name)->first();

      
            if($finduser){
      
                Auth::login($finduser);
     
                return redirect(route('home'));
      
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'status' => 1,
                    'password' => encrypt('my-google')
                ]);
                $newUser->attachRole('user'); 
                event(new Registered($newUser));
     
                Auth::login($newUser);
      
                return redirect(route('home'));
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
