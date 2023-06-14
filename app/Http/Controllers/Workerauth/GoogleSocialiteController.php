<?php

namespace App\Http\Controllers\Workerauth;

use Auth;
use Exception;
use Socialite;
use App\Models\Worker;
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
        config(['services.google.redirect' => route('worker.callback.google') ]);
        return Socialite::driver('google')->redirect();
    }
       
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {
        config(['services.google.redirect' => route('worker.callback.google') ]);
        try {
     
            $user = Socialite::driver('google')->user();
      
            $finduser = Worker::where('name', $user->name)->first();
            
            $date = date('Y-m-d H:i:s');

            if($finduser){
      
                Auth::guard('worker')->login($finduser);
     
                return redirect(route('home'));
      
            }else{
                $newUser = Worker::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => $date,
                    'password' => encrypt('my-google')
                ]);
                $newUser->attachRole('worker'); 
                event(new Registered($newUser));
     
                Auth::guard('worker')->login($newUser);

                $worker = Auth::guard('worker')->user();

                $worker->email_verified_at = $date;
                $worker->save();
      
                return redirect(route('home'));
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
