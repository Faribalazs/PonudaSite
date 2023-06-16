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
      list($categories, $subcategories, $pozicija, $custom_categories, $custom_subcategories, $custom_pozicija) = $this->selectData($worker_id);
      return view('worker.views.update-options', ['categories' => $categories, 'subcategories' => $subcategories, 'pozicija' => $pozicija, 'custom_categories' => $custom_categories, 'custom_subcategories' => $custom_subcategories, 'custom_pozicija' => $custom_pozicija])->with('successMsg', '')->with('name','')->with('old_name', '');
      }
      else
      {
         return redirect()->back();
      }
   }

   private function selectData($worker_id)
   {
      //default
      $categories = DB::select('select * from categories');
      $subcategories = DB::select('select * from subcategories');
      $pozicija = DB::select('select * from pozicija p JOIN units u WHERE p.unit_id = u.id_unit');
      //custom
      $custom_categories = DB::select('select * from custom_categories where worker_id = ? and is_category_deleted IS NULL',[$worker_id]);
      $custom_subcategories = DB::select('select * from custom_subcategories where worker_id = ? and is_subcategory_deleted IS NULL',[$worker_id]);
      $custom_pozicija = DB::select('select * from custom_pozicija where worker_id = ? and is_pozicija_deleted IS NULL',[$worker_id]);
      return array($categories, $subcategories, $pozicija, $custom_categories, $custom_subcategories, $custom_pozicija);
   }

   public function showCategory($id){
      return view('worker.views.save-category',['category' => $this->custom_Category($id), 'id'=> $id]);
   }
   private function custom_Category($id){
      return DB::select('select * from custom_categories where id = ? and worker_id = ? and is_category_deleted IS NULL', [$id, $this->worker()]);

   }

   public function showSubcategory($id){
      return view('worker.views.save-subcategory',['subcategory' => $this->custom_Subcategory($id), 'id'=> $id]);
   }
   private function custom_Subcategory($id){
      return DB::select('select * from custom_subcategories where id = ? and worker_id = ? and is_subcategory_deleted IS NULL', [$id, $this->worker()]);
   }

   public function showPozicija($id){
      return view('worker.views.save-pozicija',['pozicija' => $this->custom_Pozicija($id), 'id'=> $id]);
   }
   private function custom_Pozicija($id){
      return DB::select('select * from custom_pozicija where id = ? and worker_id = ? and is_pozicija_deleted IS NULL', [$id, $this->worker()]);

   }

   public function updateCategory(Request $request){
      $name = $request->input('category');
      $id = $request->input('id');
      $old_name = $this->select_custom_category($id)[0]->name;
      if(strlen($name)>=3){
         $this->update_custom_category($name, $id);
         return redirect(route("worker.options.update"))->with('successMsg', 'kecske')->with('name', $name)->with('old_name', $old_name);
      }
      else
      {
         Alert::error('Najmanje 3 karaktera!')->showCloseButton()->showConfirmButton('Zatvori');
         return $this->showCategory($id);
      }
   }
   private function select_custom_category($id){
      return DB::select('select id, name from custom_categories where id = ?', [$id]);
   }
   private function update_custom_category($name, $id){
      DB::update('update custom_categories set name = ? where id = ?',[$name,$id]);
   }

   public function updateSubcategory(Request $request){
      $name = $request->input('subcategory');
      $id = $request->input('id');
      $old_name = $this->select_custom_subcategory($id)[0]->name;
      if(strlen($name)>=3){
         $this->update_custom_subcategory($name,$id);
         return redirect(route("worker.options.update"))->with('successMsg', 'kecske')->with('name', $name)->with('old_name', $old_name);
      }
      else
      {
         Alert::error('Najmanje 3 karaktera!')->showCloseButton()->showConfirmButton('Zatvori');
         return $this->showSubcategory($id);
      }
   }
   private function select_custom_subcategory($id){
      return DB::select('select id, name from custom_subcategories where id = ?', [$id]);
   }
   private function update_custom_subcategory($name, $id){
      DB::update('update custom_subcategories set name = ? where id = ?',[$name,$id]);
   }

   public function updatePozicija(Request $request){
      $title = $request->input('title');
      $description = $request->input('description');
      $id = $request->input('id');
      $old_name = $this->select_custom_pozicija($id)[0]->custom_title;
      if(empty($description))
      {
         $description = "";
      }
      if(strlen($title)>=3){
         $this->update_custom_pozicija($title,$description,$id);
         return redirect(route("worker.options.update"))->with('successMsg', 'kecske')->with('name', $title)->with('old_name', $old_name);
      }
      else
      {
         Alert::error('Najmanje 3 karaktera title!')->showCloseButton()->showConfirmButton('Zatvori');
         return $this->showPozicija($id);
      }
   }
   private function select_custom_pozicija($id){
      return DB::select('select id, custom_title from custom_pozicija where id = ?', [$id]);
   }
   private function update_custom_pozicija($title,$description,$id){
      DB::update('update custom_pozicija set custom_title = ?, custom_description = ? where id = ?',[$title,$description,$id]);
   }

   public function deleteCategory($id){
      $name = $this->select_custom_category($id)[0]->name;
      $this->delCategory($id);
      return redirect(route("worker.options.update"))->with('successMsg', 'cica')->with('name', $name);
   }
   private function delCategory($id){
      DB::update('update custom_categories set is_category_deleted = ? where id = ?',[1,$id]);
      $subcategories = DB::select('select * from custom_subcategories where custom_category_id = ?', [$id]);
      DB::update('update custom_subcategories set is_subcategory_deleted = ? where custom_category_id = ?',[1,$id]);
      foreach($subcategories as $subcategory)
      {
         DB::update('update custom_pozicija set is_pozicija_deleted = ? where custom_subcategory_id = ?',[1,$subcategory->id]);
      }
   }

   public function deleteSubcategory($id){
      $name = $this->select_custom_subcategory($id)[0]->name;
      $this->delSubcategory($id);
      return redirect(route("worker.options.update"))->with('successMsg', 'cica')->with('name', $name);
   }
   private function delSubcategory($id){
      DB::update('update custom_subcategories set is_subcategory_deleted = ? where id = ?',[1,$id]);
      DB::update('update custom_pozicija set is_pozicija_deleted = ? where custom_subcategory_id = ?',[1,$id]);
   }

   public function deletePozicija($id){
      $name = $this->select_custom_pozicija($id)[0]->custom_title;
      $this->delPozicija($id);
      return redirect(route("worker.options.update"))->with('successMsg', 'cica')->with('name', $name);
   }
   private function delPozicija($id){
      DB::update('update custom_pozicija set is_pozicija_deleted = ? where id = ?',[1,$id]);
   }
}
