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
         'category_name' => 'required|max:64|regex:/^[a-z\s]+$/i',
      ]);

      Category::create([
         'worker_id' => Helper::worker(),
         'name' => $request->input('category_name'),
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
         'subcategory_name' => 'required|max:64|regex:/^[a-z\s]+$/i',
         'category' => ['required', new CheckID(Default_category::class, Category::class)],
      ]);
   
      Subcategory::create([
         'worker_id' => Helper::worker(),
         'custom_category_id' => $request->input('category'),
         'name' => $request->input('subcategory_name'),
      ]);

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
         'poz_title' => ['required'],
         'poz_des' => ['nullable'],
      ]);

      Pozicija::create([
         'worker_id' => Helper::worker(),
         'custom_subcategory_id' => $request->input('subcategory'),
         'unit_id' => $request->input('unit_id'),
         'custom_title' => $request->input('poz_title'),
         'custom_description' => $request->input('poz_des') ?? "",
      ]);

      Alert::success(__('app.basic.successfully-added'))->showCloseButton()->showConfirmButton(__('app.basic.close'));
      return redirect(route('worker.options.update'));  
   }

   //custom pozicija create & store start
}
