<?php

namespace App\Http\Controllers\WorkerControllers;

use App\Models\{Category, Subcategory, Pozicija, Default_category, Default_subcategory, Default_pozicija};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\Helper;

class OptionsController extends Controller
{
   public function create()
   {  
      if(Auth::guard('worker'))
      {
      $worker_id = Helper::worker();
      list($categories, $subcategories, $pozicija, $custom_categories, $custom_subcategories, $custom_pozicija) = $this->selectData($worker_id);
      return view('worker.views.my-categories.index', ['categories' => $categories, 'subcategories' => $subcategories, 'pozicija' => $pozicija, 'custom_categories' => $custom_categories, 'custom_subcategories' => $custom_subcategories, 'custom_pozicija' => $custom_pozicija])->with('successMsg', '')->with('name','')->with('old_name', '');
      }
      else
      {
         return redirect()->back();
      }
   }

   private function selectData($worker_id)
   {
      //default
      $categories = Default_category::all();
      $subcategories = Default_subcategory::all();
      $pozicija = Default_pozicija::join('units', 'pozicija.unit_id', '=', 'units.id_unit')->get();
      //custom
      $custom_categories = Category::where('worker_id', $worker_id)
         ->whereNull('is_category_deleted')
         ->get();

      $custom_subcategories = Subcategory::where('worker_id', $worker_id)
         ->whereNull('is_subcategory_deleted')
         ->get();

      $custom_pozicija = Pozicija::where('worker_id', $worker_id)
         ->whereNull('is_pozicija_deleted')
         ->get();

      return array($categories, $subcategories, $pozicija, $custom_categories, $custom_subcategories, $custom_pozicija);
   }

   public function showCategory($id){
      return view('worker.views.my-categories.save-category',['category' => $this->custom_Category($id), 'id'=> $id]);
   }
   private function custom_Category($id){
      return Category::where('id', $id)
         ->where('worker_id', Helper::worker())
         ->whereNull('is_category_deleted')
         ->get();
   }

   public function showSubcategory($id){
      return view('worker.views.my-categories.save-subcategory',['subcategory' => $this->custom_Subcategory($id), 'id'=> $id]);
   }
   private function custom_Subcategory($id){
      return Subcategory::where('id', $id)
         ->where('worker_id', Helper::worker())
         ->whereNull('is_subcategory_deleted')
         ->get();   
   }

   public function showPozicija($id){
      return view('worker.views.my-categories.save-pozicija',['pozicija' => $this->custom_Pozicija($id), 'id'=> $id]);
   }
   private function custom_Pozicija($id){
      return Pozicija::where('id', $id)
         ->where('worker_id', Helper::worker())
         ->whereNull('is_pozicija_deleted')
         ->get();   
   }

   public function updateCategory(Request $request){
      $name = $request->input('category');
      $id = $request->input('id');
      $old_name = $this->select_custom_category($id)->name;
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
      return Category::select('id', 'name')
         ->where('id', $id)
         ->get()
         ->first();   
   }
   private function update_custom_category($name, $id){
      Category::where('id', $id)
         ->update(['name' => $name]);   
   }

   public function updateSubcategory(Request $request){
      $name = $request->input('subcategory');
      $id = $request->input('id');
      $old_name = $this->select_custom_subcategory($id)->name;
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
      return Subcategory::select('id', 'name')
         ->where('id', $id)
         ->get()
         ->first();   
   }
   private function update_custom_subcategory($name, $id){
      Subcategory::where('id', $id)
         ->update(['name' => $name]);      
   }

   public function updatePozicija(Request $request){
      $title = $request->input('title');
      $description = $request->input('description');
      $id = $request->input('id');
      $old_name = $this->select_custom_pozicija($id)->custom_title;
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
      return Pozicija::select('id', 'custom_title')
         ->where('id', $id)
         ->get()
         ->first();   
   }
   private function update_custom_pozicija($title,$description,$id){
      Pozicija::where('id', $id)
         ->update([
            'custom_title' => $title,
            'custom_description' => $description
         ]);      
   }

   public function deleteCategory(Request $request){
      $id = $request->input('id');
      $this->delCategory($id);
      Alert::success('Uspešno ste izbrisali kategoriju')->showCloseButton()->showConfirmButton('Zatvori');
      return redirect(route("worker.options.update"));
   }
   private function delCategory($id){
      Category::where('id', $id)
         ->update(['is_category_deleted' => 1]);
      $subcategories = Subcategory::where('custom_category_id', $id)->get();
      Subcategory::where('custom_category_id', $id)
         ->update(['is_subcategory_deleted' => 1]);
      foreach($subcategories as $subcategory)
      {
         Pozicija::where('custom_subcategory_id', $subcategory->id)
            ->update(['is_pozicija_deleted' => 1]);
      }
   }

   public function deleteSubcategory(Request $request){
      $id = $request->input('id');
      $this->delSubcategory($id);
      Alert::success('Uspešno ste izbrisali podkategoriju')->showCloseButton()->showConfirmButton('Zatvori');
      return redirect(route("worker.options.update"));
   }
   private function delSubcategory($id){
      Subcategory::where('id', $id)
         ->update(['is_subcategory_deleted' => 1]);
      Pozicija::where('custom_subcategory_id', $id)
         ->update(['is_pozicija_deleted' => 1]);
   }

   public function deletePozicija(Request $request){
      $id = $request->input('id');
      $this->delPozicija($id);
      Alert::success('Uspešno ste izbrisali poziciju')->showCloseButton()->showConfirmButton('Zatvori');
      return redirect(route("worker.options.update"));
   }
   private function delPozicija($id){
      Pozicija::where('id', $id)
         ->update(['is_pozicija_deleted' => 1]);
   }
}
