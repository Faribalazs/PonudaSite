<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index()
   {
       if(Auth::user()->hasRole('user')){
          return view('userdash');
       } 
       else {
          return view('dashboard');
     }
   }

   public function aboutUs()
   {
      return view('worker.views.home.about-us');
   }

   public function profile()
   {
    return view('profile');
   }

   public function home()
   {
    return view('worker.views.home.home');
   }
}
