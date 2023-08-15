<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller
{
  public function insertAdmin()
  {
    $user = Worker::create([
      'name' => 'Test',
      'email' => 'test@test.com',
      'password' => Hash::make('testpass'),
      'email_verified_at' => '2023-05-03'
  ]);
  $user->attachRole('super_worker'); 
  event(new Registered($user));

    $user = Admin::create([
      'name' => 'Admin',
      'email' => 'admin@admin.com',
      'password' => Hash::make('123'),
      'photo_name' => 'null',
    ]);
    $user->attachRole('admin');
    event(new Registered($user));
  }

  public function create()
  {
      return view('admin.admin-profile');
  }
}