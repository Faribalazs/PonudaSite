<?php

namespace App\Http\Controllers;

use App\Models\{User,Worker,Admin,Default_category, Default_subcategory, Default_pozicija, Units, Tracker};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller
{
  public function dashboard()
  {
    $active = Tracker::where('visit_date', date('Y-m-d'))->where('visit_time', '>=', now()->subMinutes(5)->toTimeString())->distinct('worker_id')->count();
    $workers = Tracker::where('visit_date', date('Y-m-d'))->distinct('worker_id')->count();
    $workers_last_30_days = Tracker::where('visit_date', '>', now()->subDays(30)->endOfDay())->distinct('worker_id')->count();
    $max_visit = Tracker::where('visit_date', date('Y-m-d'))->orderByDesc('hits')->first();
    $overall_visit_today = Tracker::where('visit_date', date('Y-m-d'))->sum('hits');
    $overall_visit_last_30_days = Tracker::where('visit_date', '>', now()->subDays(30)->endOfDay())->sum('hits');
    $diff_ip = Tracker::where('visit_date', date('Y-m-d'))->distinct('ip')->count();
    $diff_ip_last_30_days = Tracker::where('visit_date', '>', now()->subDays(30)->endOfDay())->distinct('ip')->count();
    return view('admin.admin-dash',compact(['active','workers','workers_last_30_days','max_visit','overall_visit_today','overall_visit_last_30_days','workers_last_30_days','diff_ip','diff_ip_last_30_days']));
  }
  public function insertAdmin()
  {
    $user = Worker::create([
      'name' => 'Test',
      'email' => 'test@test.com',
      'password' => Hash::make('testpass'),
      'email_verified_at' => '2023-05-03',
      'photo_name' => 'null',
    ]);
    $user->attachRole('super_worker'); 
    event(new Registered($user));

    $user = Worker::create([
      'name' => 'worker',
      'email' => 'worker@worker.com',
      'password' => Hash::make('worker'),
      'email_verified_at' => '2023-05-03',
      'photo_name' => 'null',
    ]);
    $user->attachRole('worker'); 
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
    $users = User::select('id','email','name', 'status')->paginate(15);
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
    $users = Worker::select('id','email','name', 'status')->paginate(15);
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

  public function selectCategories()
  {
    return view('admin.show-categories', ['categories' => Default_category::paginate(15)]);
  }

  public function insertCategory(Request $request){
    $category = Default_category::create(['name' => ['sr' => $request->new_category_name]]);
    if($request->input('new_category_name_en') != null)
      $category->setTranslations('name', ['en' => $request->input('new_category_name_en')]);
    if($request->input('new_category_name_hu') != null)
      $category->setTranslations('name', ['hu' => $request->input('new_category_name_hu')]);

    $category->save();
  
    return redirect()->back();
  }

  public function editCategory(Request $request){
    Default_category::where('id', $request->input('id'))->first()->setTranslations('name', [app()->getLocale() => $request->category_name])->save();
    return redirect()->back();
  }

  public function deleteCategory(Request $request){
    Default_category::where('id', $request->input('id'))->delete();
    return redirect()->back();
  }

  public function selectSubcategories()
  {
    return view('admin.show-subcategories', ['subcategories' => Default_subcategory::paginate(15), 'categories' => Default_category::all()]);
  }

  public function insertSubcategory(Request $request){
    $subcategory = Default_subcategory::create(['name' => ['sr' => $request->input('new_subcategory_name')], 'category_id' => $request->input('category_options')]);
    if($request->input('new_subcategory_name_en') != null)
      $subcategory->setTranslations('name', ['en' => $request->input('new_subcategory_name_en')]);
    if($request->input('new_subcategory_name_hu') != null)
      $subcategory->setTranslations('name', ['hu' => $request->input('new_subcategory_name_hu')]);

    $subcategory->save();

    return redirect()->back();
  }

  public function editSubcategory(Request $request){
    Default_subcategory::where('id', $request->input('id'))->first()->setTranslations('name', [app()->getLocale() => $request->input('subcategory_name')])->save();
    return redirect()->back();
  }

  public function deleteSubcategory(Request $request){
    Default_subcategory::where('id', $request->input('id'))->delete();
    return redirect()->back();
  }

  public function selectPozicija()
  {
    return view('admin.show-pozicija', ['pozicija' => Default_pozicija::with('unit')->paginate(15), 'subcategories' => Default_subcategory::all(), 'units' => Units::all()]);
  }

  public function insertPozicija(Request $request){
    $desc_sr = !empty($request->input('new_description'))?$request->input('new_description'):'';
    $pozicija = Default_pozicija::create(
      [
        'subcategory_id' => $request->input('subcategory_options'),
        'title' => ['sr' => $request->input('new_title')],
        'description' => ['sr' => $desc_sr],
        'unit_id' => $request->input('unit_options'),
      ]);

    if($request->input('new_title_en') != null)
      $pozicija->setTranslations('title', ['en' => $request->input('new_title_en')]);
    if($request->input('new_title_hu') != null)
      $pozicija->setTranslations('title', ['hu' => $request->input('new_title_hu')]);

    if($request->input('new_description_en') != null)
      $pozicija->setTranslations('description', ['en' => $request->input('new_description_en')]);
    if($request->input('new_description_hu') != null)
      $pozicija->setTranslations('description', ['hu' => $request->input('new_description_hu')]);

    $pozicija->save();

    return redirect()->back();
  }

  public function editPozicija(Request $request){
    $desc = $request->input('description');
    $pozicija = Default_pozicija::where('id', $request->input('id'))->first();
    $pozicija->update(
      [
        'unit_id' => $request->input('unit'),
      ]);
    $pozicija->setTranslations('title', [app()->getLocale() => $request->input('title')]);
    if(isset($desc))
    {
      $pozicija->setTranslations('description', [app()->getLocale() => $desc]);
    }
    elseif((empty($desc) && app()->getLocale() == "sr"))
    {
      $desc = '';
      $pozicija->setTranslations('description', [app()->getLocale() => $desc]);
    }
    $pozicija->save();
    return redirect()->back();
  }

  public function deletePozicija(Request $request){
    Default_pozicija::where('id', $request->input('id'))->delete();
    return redirect()->back();
  }

}