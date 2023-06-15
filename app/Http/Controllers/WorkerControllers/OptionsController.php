<?php

namespace App\Http\Controllers\WorkerControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Pozicija;
use RealRashid\SweetAlert\Facades\Alert;

class OptionsController extends Controller
{
   public function worker()
   {
      if(Auth::guard('worker'))
      {
         return Auth::guard('worker')->user()->id;
      }
   }
   public function create()
   {  
      if(Auth::guard('worker'))
      {
      $worker_id = $this->worker();
      $worker = "worker_id";
      $categories = DB::select('select * from categories');
      $subcategories = DB::select('select * from subcategories');
      $pozicija = DB::select('select * from pozicija p JOIN units u WHERE p.unit_id = u.id_unit');
      $custom_categories = DB::select('select * from custom_categories where worker_id = ? and is_category_deleted IS NULL',[$worker_id]);
      $custom_subcategories = DB::select('select * from custom_subcategories where worker_id = ? and is_subcategory_deleted IS NULL',[$worker_id]);
      $custom_pozicija = DB::select('select * from custom_pozicija where worker_id = ? and is_pozicija_deleted IS NULL',[$worker_id]);
      return view('worker.views.update-options', ['categories' => $categories, 'subcategories' => $subcategories, 'pozicija' => $pozicija, 'custom_categories' => $custom_categories, 'custom_subcategories' => $custom_subcategories, 'custom_pozicija' => $custom_pozicija])->with('successMsg', '')->with('name','')->with('old_name', '');
      // return view('worker.views.update-options', ['custom_categories' => $custom_categories, 'custom_subcategories' => $custom_subcategories, 'custom_pozicija' => $custom_pozicija]);
      }
      else
      {
         return redirect()->back();
      }
   }

   public function showCategory($id){
      $category = DB::select('select * from custom_categories where id = ? and worker_id = ? and is_category_deleted IS NULL', [$id, $this->worker()]);
      return view('worker.views.save-category',['category' => $category, 'id'=> $id]);
   }

   public function showSubcategory($id){
      $subcategory = DB::select('select * from custom_subcategories where id = ? and worker_id = ? and is_subcategory_deleted IS NULL', [$id, $this->worker()]);
      return view('worker.views.save-subcategory',['subcategory' => $subcategory, 'id'=> $id]);
   }

   public function showPozicija($id){
      $pozicija = DB::select('select * from custom_pozicija where id = ? and worker_id = ? and is_pozicija_deleted IS NULL', [$id, $this->worker()]);
      return view('worker.views.save-pozicija',['pozicija' => $pozicija, 'id'=> $id]);
   }

   public function updateCategory(Request $request){
      $name = $request->input('category');
      $id = $request->input('id');
      $old = DB::select('select * from custom_categories where id = ?', [$id]);
      $old_name = $old[0]->name;
      if(strlen($name)>=3){
      DB::update('update custom_categories set name = ? where id = ?',[$name,$id]);
      // DB::update('update custom_categories set name = ? where id = ? and worker_id = ?',[$name, $id, $this->worker()]);
      return redirect(route("worker.options.update"))->with('successMsg', 'kecske')->with('name', $name)->with('old_name', $old_name);
      }
      else
      {
         Alert::error('Najmanje 3 karaktera!')->showCloseButton()->showConfirmButton('Zatvori');
         return $this->showCategory($id);
      }
   }

   public function updateSubcategory(Request $request){
      $name = $request->input('subcategory');
      $id = $request->input('id');
      $old = DB::select('select * from custom_subcategories where id = ?', [$id]);
      $old_name = $old[0]->name;
      if(strlen($name)>=3){
      DB::update('update custom_subcategories set name = ? where id = ?',[$name,$id]);
      // DB::update('update custom_subcategories set name = ? where id = ? and worker_id = ?',[$name, $id, $this->worker()]);
      return redirect(route("worker.options.update"))->with('successMsg', 'kecske')->with('name', $name)->with('old_name', $old_name);
      }
      else
      {
         Alert::error('Najmanje 3 karaktera!')->showCloseButton()->showConfirmButton('Zatvori');
         return $this->showSubcategory($id);
      }
   }

   public function updatePozicija(Request $request){
      $title = $request->input('title');
      $description = $request->input('description');
      $id = $request->input('id');
      $old = DB::select('select * from custom_pozicija where id = ?', [$id]);
      $old_name = $old[0]->custom_title;
      if(empty($description))
      {
         $description = "";
      }
      if(strlen($title)>=3){
      DB::update('update custom_pozicija set custom_title = ?, custom_description = ? where id = ?',[$title,$description,$id]);
      // DB::update('update custom_pozicija set title = ?, description = ? where id = ? and worker_id = ?',[$title, $description, $id, $this->worker()]);
      return redirect(route("worker.options.update"))->with('successMsg', 'kecske')->with('name', $title)->with('old_name', $old_name);
      }
      else
      {
         Alert::error('Najmanje 3 karaktera title!')->showCloseButton()->showConfirmButton('Zatvori');
         return $this->showPozicija($id);
      }
   }

   public function deleteCategory($id){
      $n = DB::select('select id, name from custom_categories where id = ?', [$id]);
      $name = $n[0]->name;
      // DB::table('custom_categories')->where('id', $id)->where('worker_id', $this->worker())->delete();
      // DB::table('custom_categories')->where('id', $id)->delete();
      DB::update('update custom_categories set is_category_deleted = ? where id = ?',[1,$id]);
      $subcategories = DB::select('select * from custom_subcategories where custom_category_id = ?', [$id]);
      DB::update('update custom_subcategories set is_subcategory_deleted = ? where custom_category_id = ?',[1,$id]);
      foreach($subcategories as $subcategory)
      {
      DB::update('update custom_pozicija set is_pozicija_deleted = ? where custom_subcategory_id = ?',[1,$subcategory->id]);
      }
      return redirect(route("worker.options.update"))->with('successMsg', 'cica')->with('name', $name);
      }

   public function deleteSubcategory($id){
      $n = DB::select('select id, name from custom_subcategories where id = ?', [$id]);
      $name = $n[0]->name;
      // DB::table('custom_subcategories')->where('id', $id)->delete();
      // DB::table('custom_subcategories')->where('id', $id)->where('worker_id', $this->worker())->delete();
      DB::update('update custom_subcategories set is_subcategory_deleted = ? where id = ?',[1,$id]);
      DB::update('update custom_pozicija set is_pozicija_deleted = ? where custom_subcategory_id = ?',[1,$id]);
      return redirect(route("worker.options.update"))->with('successMsg', 'cica')->with('name', $name);
   }

   public function deletePozicija($id){
      $n = DB::select('select id, custom_title from custom_pozicija where id = ?', [$id]);
      $name = $n[0]->custom_title;
      // DB::table('custom_pozicija')->where('id', $id)->delete();
      // DB::table('custom_pozicija')->where('id', $id)->where('worker_id', $this->worker())->delete();
      DB::update('update custom_pozicija set is_pozicija_deleted = ? where id = ?',[1,$id]);
      return redirect(route("worker.options.update"))->with('successMsg', 'cica')->with('name', $name);
   }
}
