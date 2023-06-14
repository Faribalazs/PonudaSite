<?php

namespace App\Http\Controllers\WorkerControllers;

use Exception;
use App\Models\Category;
use App\Models\Pozicija;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class NewOptions extends Controller
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
      return view('worker.views.create-options');
   }

   //custom category create & store start

   public function CategoryCreate()
   {
      return view('worker.views.add-new-category');
   }


   public function store_category(Request $request)
   {
         $request->validate([
            'category_name' => 'required|max:64|regex:/^[a-z\s]+$/i',
        ]);
   
         $addCategory = new Category();
           $addCategory->worker_id = $this->worker();
           $addCategory->name = request('category_name');
           $addCategory->save();
           Alert::success('Uspesno dodato!')->showCloseButton()->showConfirmButton('Zatvori');
           return redirect(route('worker.new.options'));  
      }
   //custom category create & store end

   //custom subcategory create & store start

   public function SubCategoryCreate()
   {
      $worker_id = $this->worker();
      $categories = DB::select('select * from categories');
      $custom_categories = DB::select('select * from custom_categories where worker_id = ?',[$worker_id]);
      return view('worker.views.add-new-subcategory',['categories' => $categories, 'custom_categories' => $custom_categories]);
   }

   public function store_subcategory(Request $request)
   {
         $request->validate([
            'subcategory_name' => 'required|max:64|regex:/^[a-z\s]+$/i',
            'category' => 'required|max:64|regex:/^[0-9\s]+$/i',
        ]);
   
         $addSubcategory = new Subcategory();
         $addSubcategory->worker_id = $this->worker();
         $addSubcategory->custom_category_id = request('category');
         $addSubcategory->name = request('subcategory_name');
         $addSubcategory->save();
         Alert::success('Uspesno dodato!')->showCloseButton()->showConfirmButton('Zatvori');
         return redirect(route('worker.new.options'));  
   }

   //custom subcategory create & store end

   //custom pozicija create & store start

   public function pozicijaCreate()
   {
      $worker_id = $this->worker();
      $categories = DB::select('select * from categories');
      $custom_categories = DB::select('select * from custom_categories where worker_id = ?',[$worker_id]);
      $subcategories = DB::select('select * from subcategories');
      $units = DB::select('select * from units');
      $custom_subcategories = DB::select('select * from custom_subcategories where worker_id = ?',[$worker_id]);
      return view('worker.views.add-new-pozicija',['categories' => $categories, 'custom_categories' => $custom_categories, 'subcategories' => $subcategories, 'custom_subcategories' => $custom_subcategories, 'units'=> $units]);
   }

   public function store_pozicija(Request $request)
   {
         $request->validate([
            // 'title' => 'required|string|max:255',
        ]);
        $description = request('poz_des');
        $subcategory = request('subcategory');
        $unit_id = request('unit_id');
        $title = request('poz_title');
        if(empty($description)){
          $description = "";
        }
        if(!empty($subcategory) && !empty($unit_id) && !empty($title))
        {
        $addPozicija = new Pozicija();
        $addPozicija->worker_id = $this->worker();
        $addPozicija->custom_subcategory_id = $subcategory;
        $addPozicija->unit_id = $unit_id;
        $addPozicija->custom_title = $title;
        $addPozicija->custom_description = $description;
        $addPozicija->save();
         Alert::success('Uspesno dodato!')->showCloseButton()->showConfirmButton('Zatvori');
         return redirect(route('worker.new.options'));  
        }
        else{
        Alert::error('Niste uneli podatak')->showCloseButton()->showConfirmButton('Zatvori');
         return redirect()->back();  
        }
   }

   //custom pozicija create & store start
}
