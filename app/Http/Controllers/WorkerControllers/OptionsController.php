<?php

namespace App\Http\Controllers\WorkerControllers;

use App\Models\{Category, Subcategory, Pozicija, Default_category, Default_subcategory, Default_pozicija, Units};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;

class OptionsController extends Controller
{
   public function create()
   {  
      $worker_id = Helper::worker();

      $c_categories = Category::select(
            'custom_categories.id',
            'custom_categories.name',
            DB::raw("CONCAT(COALESCE(sc.category_id, ''), COALESCE(c_sc.custom_category_id, '')) AS merged_id")
         )
         ->leftJoin('custom_subcategories as c_sc', 'c_sc.custom_category_id', '=', 'custom_categories.id')
         ->leftJoin('subcategories as sc', 'sc.category_id', '=', 'custom_categories.id')
         ->where('custom_categories.worker_id', $worker_id)
         ->whereNull('custom_categories.is_category_deleted')
         ->get();

      $categories = Default_category::select(
            'categories.id',
            'categories.name',
            DB::raw("CONCAT(COALESCE(sc.category_id, ''), COALESCE(c_sc.custom_category_id, '')) AS merged_id")
         )
         ->leftJoin('custom_subcategories as c_sc', 'c_sc.custom_category_id', '=', 'categories.id')
         ->leftJoin('subcategories as sc', 'sc.category_id', '=', 'categories.id')
         ->get();

      $c_subcategories = Subcategory::select('custom_subcategories.id','custom_subcategories.name','custom_subcategories.custom_category_id',
            DB::raw("CONCAT(COALESCE(p.subcategory_id, ''), COALESCE(c_p.custom_subcategory_id, '')) AS merged_id")
         )
         ->leftJoin('pozicija as p', 'p.subcategory_id', '=', 'custom_subcategories.id')
         ->leftJoin('custom_pozicija as c_p', 'c_p.custom_subcategory_id', '=', 'custom_subcategories.id')
         ->where('custom_subcategories.worker_id', $worker_id)
         ->whereNull('custom_subcategories.is_subcategory_deleted')
         ->get();

      $subcategories = Default_subcategory::select('subcategories.id','subcategories.name','subcategories.category_id',
            DB::raw("CONCAT(COALESCE(p.subcategory_id, ''), COALESCE(c_p.custom_subcategory_id, '')) AS merged_id")
         )
         ->leftJoin('pozicija as p', 'p.subcategory_id', '=', 'subcategories.id')
         ->leftJoin('custom_pozicija as c_p', 'c_p.custom_subcategory_id', '=', 'subcategories.id')
         ->get();

      $c_pozicije = Pozicija::select('id','custom_title','custom_subcategory_id')->where('worker_id', $worker_id)
         ->whereNull('is_pozicija_deleted')
         ->get();

      $pozicije = Default_pozicija::select('id','title','subcategory_id')
         ->get();

      $custom_categories = $c_categories->merge($categories);
      $custom_subcategories = $c_subcategories->merge($subcategories);
      $custom_pozicije = $c_pozicije->merge($pozicije);

      return view('worker.views.my-categories.index', ['custom_categories' => $custom_categories, 'custom_subcategories' => $custom_subcategories, 'custom_pozicije' => $custom_pozicije])->with('successMsg', '')->with('name','')->with('old_name', '');
   }

   public function showCategory($id){
      $category = Category::where('id', $id)
         ->where('worker_id', Helper::worker())
         ->whereNull('is_category_deleted')
         ->first();
      if($category != null)
      {
         return view('worker.views.my-categories.save-category',
         [
            'category' => $category, 
            'id' => $id
         ]);
      }

      return redirect()->back();
   }

   public function showSubcategory($id){
      $subcategory = Subcategory::where('id', $id)
         ->where('worker_id', Helper::worker())
         ->whereNull('is_subcategory_deleted')
         ->first();
      if($subcategory != null)
      {
         return view('worker.views.my-categories.save-subcategory',
         [
               'subcategory' => $subcategory, 
               'id' => $id
         ]);
      }

      return redirect()->back();
   }

   public function showPozicija($id){
      $pozicija = Pozicija::where('id', $id)
         ->where('worker_id', Helper::worker())
         ->whereNull('is_pozicija_deleted')
         ->first();
      if($pozicija != null)
      {
         return view('worker.views.my-categories.save-pozicija',
         [
            'pozicija' => $pozicija, 
            'id' => $id, 
            'units' => Units::all()
         ]);
      }

      return redirect()->back();
   }

   public function updateCategory(Request $request){
      $request->validate([
         'category' => ['required','min:3'],
         'id' => ['required','exists:App\Models\Category,id'],
      ]);

      $name = $request->input('category');
      $id = $request->input('id');
      Category::where('id', $id)->where('worker_id', Helper::worker())->update(['name' => ['sr' => $name]]);
      return redirect(route("worker.options.update"))->with('successMsg', 'kecske')->with('name', $name)->with('old_name', Category::select('name')->where('id', $id)->first()->name);
   }

   public function updateSubcategory(Request $request){
      $request->validate([
         'subcategory' => ['required','min:3'],
         'id' => ['required','exists:App\Models\Subcategory,id'],
      ]);

      $name = $request->input('subcategory');
      $id = $request->input('id');
      Subcategory::where('id', $id)->where('worker_id', Helper::worker())->update(['name' => ['sr' => $name]]);
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
            'custom_title' => ['sr' => $title],
            'custom_description' => ['sr' => $description],
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
