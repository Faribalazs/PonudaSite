<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
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

   public function profile()
   {
    return view('worker.views.profile-page');
   }

   public function personalData()
   {
    return view('worker.views.personal-data');
   }

   public function myContacts()
   {
    return view('worker.views.profile-contacts');
   }

   public function postcreate()
   {
    return view('postcreate');
   }
}
