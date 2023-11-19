<?php

namespace App\Http\Controllers\WorkerControllers;

use App\Models\{Category, Subcategory, Pozicija, Default_category, Default_subcategory, Default_pozicija, Units};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\Helper;

class OptionsController extends Controller
{
   public function create()
   {  
      $worker_id = Helper::worker();

      $custom_categories = Category::select('id','name')->where('worker_id', $worker_id)
         ->whereNull('is_category_deleted')
         ->get();

      $custom_subcategories = Subcategory::select('id','name','custom_category_id')->where('worker_id', $worker_id)
         ->whereNull('is_subcategory_deleted')
         ->get();

      $custom_pozicija = Pozicija::select('id','custom_title','custom_subcategory_id')->where('worker_id', $worker_id)
         ->whereNull('is_pozicija_deleted')
         ->get();

      return view('worker.views.my-categories.index', ['custom_categories' => $custom_categories, 'custom_subcategories' => $custom_subcategories, 'custom_pozicija' => $custom_pozicija])->with('successMsg', '')->with('name','')->with('old_name', '');
   }

   public function showCategory($id){
      return view('worker.views.my-categories.save-category',
      [
         'category' => Category::where('id', $id)
            ->where('worker_id', Helper::worker())
            ->whereNull('is_category_deleted')
            ->first(), 
         'id' => $id
      ]);
   }

   public function showSubcategory($id){
      return view('worker.views.my-categories.save-subcategory',
      [
         'subcategory' => Subcategory::where('id', $id)
            ->where('worker_id', Helper::worker())
            ->whereNull('is_subcategory_deleted')
            ->first(), 
         'id' => $id
      ]);
   }

   public function showPozicija($id){
      return view('worker.views.my-categories.save-pozicija',
      [
         'pozicija' => Pozicija::where('id', $id)
            ->where('worker_id', Helper::worker())
            ->whereNull('is_pozicija_deleted')
            ->first(), 
         'id' => $id, 
         'units' => Units::all()
      ]);
   }

   public function updateCategory(Request $request){
      $request->validate([
         'category' => ['required','min:3'],
         'id' => ['required','exists:App\Models\Category,id'],
      ]);

      $name = $request->input('category');
      $id = $request->input('id');
      Category::where('id', $id)->where('worker_id', Helper::worker())->update(['name' => $name]);
      return redirect(route("worker.options.update"))->with('successMsg', 'kecske')->with('name', $name)->with('old_name', Category::select('name')->where('id', $id)->first()->name);
   }

   public function updateSubcategory(Request $request){
      $request->validate([
         'subcategory' => ['required','min:3'],
         'id' => ['required','exists:App\Models\Subcategory,id'],
      ]);

      $name = $request->input('subcategory');
      $id = $request->input('id');
      Subcategory::where('id', $id)->where('worker_id', Helper::worker())->update(['name' => $name]);
      return redirect(route("worker.options.update"))->with('successMsg', 'kecske')->with('name', $name)->with('old_name', Subcategory::select('name')->where('id', $id)->first()->name);
   }

   public function updatePozicija(Request $request){
      $request->validate([
         'title' => ['required','min:3'],
         'description' => ['nullable'],
         'unit' => ['required'],
         'id' => ['required','exists:App\Models\Pozicija,id'],
      ]);

      $title = $request->input('title');
      $description = $request->input('description');
      $unit = $request->input('unit');
      $id = $request->input('id');

      if(empty($description))
      {
         $description = "";
      }
      Pozicija::where('id', $id)
         ->where('worker_id', Helper::worker())
         ->update([
            'custom_title' => $title,
            'custom_description' => $description,
            'unit_id' => $unit
         ]);     
      return redirect(route("worker.options.update"))->with('successMsg', 'kecske')->with('name', $title)->with('old_name', Pozicija::select('custom_title')->where('id', $id)->first()->custom_title);
   }


   public function deleteCategory(Request $request){
      $request->validate([
         'id' => ['required','exists:App\Models\Category,id'],
      ]);

      $id = $request->input('id');
      Category::where('id', $id)
         ->where('worker_id', Helper::worker())
         ->update(['is_category_deleted' => 1]);
      $subcategories = Subcategory::where('custom_category_id', $id)->get();
      Subcategory::where('custom_category_id', $id)
         ->update(['is_subcategory_deleted' => 1]);
      foreach($subcategories as $subcategory)
      {
         Pozicija::where('custom_subcategory_id', $subcategory->id)
            ->where('worker_id', Helper::worker())
            ->update(['is_pozicija_deleted' => 1]);
      }      
      Alert::success(__('app.controllers.deleted-category'))->showCloseButton()->showConfirmButton(__('app.basic.close'));
      return redirect(route("worker.options.update"));
   }

   public function deleteSubcategory(Request $request){
      $request->validate([
         'id' => ['required','exists:App\Models\Subcategory,id'],
      ]);

      $id = $request->input('id');
      Subcategory::where('id', $id)
         ->where('worker_id', Helper::worker())
         ->update(['is_subcategory_deleted' => 1]);
      Pozicija::where('custom_subcategory_id', $id)
         ->update(['is_pozicija_deleted' => 1]);      
      Alert::success(__('app.controllers.deleted-subcategory'))->showCloseButton()->showConfirmButton(__('app.basic.close'));
      return redirect(route("worker.options.update"));
   }

   public function deletePozicija(Request $request){
      $request->validate([
         'id' => ['required','exists:App\Models\Pozicija,id'],
      ]);

      $id = $request->input('id');
      Pozicija::where('id', $id)
         ->where('worker_id', Helper::worker())
         ->update(['is_pozicija_deleted' => 1]);      
      Alert::success(__('app.controllers.deleted-pozicija'))->showCloseButton()->showConfirmButton(__('app.basic.close'));
      return redirect(route("worker.options.update"));
   }
}
