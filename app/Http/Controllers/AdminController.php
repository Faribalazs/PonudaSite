<?php

namespace App\Http\Controllers;

use App\Models\{User,Worker,Admin,Default_category, Default_subcategory, Default_pozicija, Units};
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
      'email_verified_at' => '2023-05-03',
      'accepted' => 1,
      'photo_name' => 'null',
  ]);
  $user->attachRole('super_worker'); 
  event(new Registered($user));

    $user = Admin::create([
      'name' => 'Admin',
      'email' => 'admin@admin.com',
      'password' => Hash::make('admin123'),
      'email_verified_at' => '2023-05-03',
      'photo_name' => 'null',
    ]);
    $user->attachRole('admin');
    event(new Registered($user));
  }

  public function create()
  {
      return view('admin.admin-profile');
  }

  public function selectUsers()
  {
    $users = User::select('id','email','name', 'status')->get();
    return view('admin.show-users', ['users' => $users]);
  }

  public function banUser(Request $request){
    User::where('id', $request->input('id'))
      ->update(['status' => 0]);
    return redirect()->back();
  }

  public function unbanUser(Request $request){
    User::where('id', $request->input('id'))
      ->update(['status' => 1]);
    return redirect()->back();
  }

  public function selectWorkers()
  {
    $users = Worker::select('id','email','name', 'status')->where('accepted', 1)->get();
    return view('admin.show-workers', ['users' => $users]);
  }

  public function banWorker(Request $request){
    Worker::where('id', $request->input('id'))
      ->update(['status' => 0]);
    return redirect()->back();
  }

  public function unbanWorker(Request $request){
    Worker::where('id', $request->input('id'))
      ->update(['status' => 1]);
    return redirect()->back();
  }

  public function notActivatedWorkers()
  {
    $users = Worker::select('id','email','name')->where('accepted', 0)->get();
    return view('admin.show-workers-not-confirmed', ['users' => $users]);
  }

  public function activateWorker(Request $request){
    Worker::where('id', $request->input('id'))
      ->update(['accepted' => 1]);
    return redirect()->back();
  }

  public function dismissWorker(Request $request){
    Worker::where('id', $request->input('id'))
      ->update(['accepted' => -1]);
    return redirect()->back();
  }

  public function selectCategories()
  {
    return view('admin.show-categories', ['categories' => Default_category::all()]);
  }

  public function insertCategory(Request $request){
    Default_category::create(['name' => $request->new_category_name]);
    return redirect()->back();
  }

  public function editCategory(Request $request){
    Default_category::where('id', $request->input('id'))->update(['name' => $request->category_name]);
    return redirect()->back();
  }

  public function deleteCategory(Request $request){
    Default_category::where('id', $request->input('id'))->delete();
    return redirect()->back();
  }

  public function selectSubcategories()
  {
    return view('admin.show-subcategories', ['subcategories' => Default_subcategory::all(), 'categories' => Default_category::all()]);
  }

  public function insertSubcategory(Request $request){
    Default_subcategory::create(['name' => $request->input('new_subcategory_name'), 'category_id' => $request->input('category_options')]);
    return redirect()->back();
  }

  public function editSubcategory(Request $request){
    Default_subcategory::where('id', $request->input('id'))->update(['name' => $request->input('subcategory_name')]);
    return redirect()->back();
  }

  public function deleteSubcategory(Request $request){
    Default_subcategory::where('id', $request->input('id'))->delete();
    return redirect()->back();
  }

  public function selectPozicija()
  {
    return view('admin.show-pozicija', ['pozicija' => Default_pozicija::with('unit')->get(), 'subcategories' => Default_subcategory::all(), 'units' => Units::all()]);
  }

  public function insertPozicija(Request $request){
    Default_pozicija::create(
      [
        'subcategory_id' => $request->input('subcategory_options'),
        'title' => $request->input('new_title'),
        'description' => $request->input('new_description'),
        'unit_id' => $request->input('unit_options'),

      ]);
    return redirect()->back();
  }

  public function editPozicija(Request $request){
    Default_pozicija::where('id', $request->input('id'))->update(
      [
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'unit_id' => $request->input('unit'),
      ]);
    return redirect()->back();
  }

  public function deletePozicija(Request $request){
    Default_pozicija::where('id', $request->input('id'))->delete();
    return redirect()->back();
  }

}