<?php

namespace App\Http\Controllers\WorkerControllers;

use App\Models\{Category, Subcategory, Pozicija, Default_category, Default_subcategory, Units};
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\Helper;
use App\Rules\CheckID;

class NewOptions extends Controller
{
   //custom category create & store start

   public function CategoryCreate()
   {
      return view('worker.views.my-categories.add-new-category');
   }


   public function store_category(Request $request)
   {
      $request->validate([
         'category_name_sr' => ['required','max:64','string'],
         'category_name_rs_cyrl' => ['max:64','string'],
      ]);

      $category_name_sr = $request->input('category_name_sr');

      $category_name_rs_cyrl = $request->input('category_name_rs_cyrl') ?? "";

      Category::create([
         'worker_id' => Helper::worker(),
         'name' => [
            'sr' => $category_name_sr,
            'rs-cyrl' => $category_name_rs_cyrl,
         ],
         'has_subcategory' => false,
      ]);

      Alert::success(__('app.basic.successfully-added'))->showCloseButton()->showConfirmButton(__('app.basic.close'));
      return redirect(route('worker.options.update'));  
   }
   //custom category create & store end

   //custom subcategory create & store start
   private function custom_Categories($worker)
   {
      return Category::where('worker_id', $worker)->whereNull('is_category_deleted')->get();
   }

   private function custom_Subcategories($worker)
   {
      return Subcategory::where('worker_id', $worker)->whereNull('is_subcategory_deleted')->get();
   }

   public function SubCategoryCreate()
   {
      $worker_id = Helper::worker();
      return view('worker.views.my-categories.add-new-subcategory',['categories' => Default_category::all(), 'custom_categories' => $this->custom_Categories($worker_id)]);
   }

   public function store_subcategory(Request $request)
   {
      $request->validate([
         'subcategory_name_sr' => 'required|max:64|regex:/^[a-z\s]+$/i',
         'subcategory_name_rs_cyrl' => ['max:64','string'],
         'category' => ['required', new CheckID(Default_category::class, Category::class)],
      ]);
   
      $new_subcategory = Subcategory::create([
         'worker_id' => Helper::worker(),
         'custom_category_id' => $request->input('category'),
         'name' => [
            'sr' => $request->input('subcategory_name_sr'),
            'rs-cyrl' => $request->input('subcategory_name_rs_cyrl') ?? "",
         ],
         'has_pozicija' => false,
      ]);

      Category::whereId($new_subcategory->custom_category_id)->update(['has_subcategory' => true]);

      Alert::success(__('app.basic.successfully-added'))->showCloseButton()->showConfirmButton(__('app.basic.close'));
      return redirect(route('worker.options.update'));  
   }
   
   //custom subcategory create & store end

   //custom pozicija create & store start

   public function pozicijaCreate()
   {
      $worker_id = Helper::worker();
      return view('worker.views.my-categories.add-new-pozicija',['categories' => Default_category::all(), 'custom_categories' => $this->custom_Categories($worker_id), 'subcategories' => Default_subcategory::all(), 'custom_subcategories' => $this->custom_Subcategories($worker_id), 'units'=> Units::all()]);
   }

   public function store_pozicija(Request $request)
   {
      $request->validate([
         'subcategory' => ['required', new CheckID(Default_subcategory::class, Subcategory::class)],
         'unit_id' => ['required','exists:App\Models\Units,id_unit'],
         'pozicija_name_sr' => ['required','string'],
         'pozicija_name_rs_cyrl' => ['string'],
         'poz_des_sr' => ['nullable','string'],
         'poz_des_rs_cyrl' => ['nullable','string'],
      ]);

      $new_pozicija = Pozicija::create([
         'worker_id' => Helper::worker(),
         'custom_subcategory_id' => $request->input('subcategory'),
         'unit_id' => $request->input('unit_id'),
         'custom_title' => [
            'sr' => $request->input('pozicija_name_sr'),
            'rs-cyrl' => $request->input('pozicija_name_rs_cyrl') ?? "",
         ],
         'custom_description' => [
            'sr' => $request->input('poz_des_sr'),
            'rs-cyrl' => $request->input('poz_des_rs_cyrl') ?? "",
         ],
      ]);

      Subcategory::whereId($new_pozicija->custom_subcategory_id)->update(['has_pozicija' => true]);

      Alert::success(__('app.basic.successfully-added'))->showCloseButton()->showConfirmButton(__('app.basic.close'));
      return redirect(route('worker.options.update'));  
   }

   //custom pozicija create & store start
}
