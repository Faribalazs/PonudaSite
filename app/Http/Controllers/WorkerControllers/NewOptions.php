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
      $this->successCategory($request);
      Alert::success('Uspesno dodato!')->showCloseButton()->showConfirmButton('Zatvori');
      return redirect(route('worker.new.options'));  
   }
   private function successCategory($request){
      $addCategory = new Category();
      $addCategory->worker_id = $this->worker();
      $addCategory->name = $request->category_name;
      $addCategory->save();  
   }
   //custom category create & store end

   //custom subcategory create & store start
   private function Categories(){
      return DB::select('select * from categories');
   }
   private function custom_Categories($worker)
   {
      return DB::select('select * from custom_categories where worker_id = ? and is_category_deleted IS NULL',[$worker]);
   }
   private function Subcategories()
   {
      return DB::select('select * from subcategories');
   }
   private function custom_Subcategories($worker)
   {
      return DB::select('select * from custom_subcategories where worker_id = ? and is_subcategory_deleted IS NULL',[$worker]);
   }
   private function Units()
   {
      return DB::select('select * from units');
   }
   public function SubCategoryCreate()
   {
      $worker_id = $this->worker();
      return view('worker.views.add-new-subcategory',['categories' => $this->Categories(), 'custom_categories' => $this->custom_Categories($worker_id)]);
   }

   public function store_subcategory(Request $request)
   {
      $request->validate([
         'subcategory_name' => 'required|max:64|regex:/^[a-z\s]+$/i',
         'category' => 'required|max:64|regex:/^[0-9\s]+$/i',
      ]);
   
      $this->successSubcategory($request);
      Alert::success('Uspesno dodato!')->showCloseButton()->showConfirmButton('Zatvori');
      return redirect(route('worker.new.options'));  
   }
   private function successSubcategory($request){
      $addSubcategory = new Subcategory();
      $addSubcategory->worker_id = $this->worker();
      $addSubcategory->custom_category_id = $request->category;
      $addSubcategory->name = $request->subcategory_name;
      $addSubcategory->save();
   }
   //custom subcategory create & store end

   //custom pozicija create & store start

   public function pozicijaCreate()
   {
      $worker_id = $this->worker();
      return view('worker.views.add-new-pozicija',['categories' => $this->Categories(), 'custom_categories' => $this->custom_Categories($worker_id), 'subcategories' => $this->Subcategories(), 'custom_subcategories' => $this->custom_Subcategories($worker_id), 'units'=> $this->Units()]);
   }

   public function store_pozicija(Request $request)
   {
      $request->validate([
         // 'title' => 'required|string|max:255',
      ]);
      if(!empty($request->subcategory) && !empty($request->unit_id) && !empty($request->poz_title))
      {
         $this->successPozicija($request);
         Alert::success('Uspesno dodato!')->showCloseButton()->showConfirmButton('Zatvori');
         return redirect(route('worker.new.options'));  
      }
      else
      {
         Alert::error('Niste uneli podatak')->showCloseButton()->showConfirmButton('Zatvori');
         return redirect()->back();  
      }
   }
   private function successPozicija($request)
   {
      $description = $request->poz_des;
      $subcategory = $request->subcategory;
      $unit_id = $request->unit_id;
      $title = $request->poz_title;
      if(empty($description)){
         $description = "";
      }
      $addPozicija = new Pozicija();
      $addPozicija->worker_id = $this->worker();
      $addPozicija->custom_subcategory_id = $subcategory;
      $addPozicija->unit_id = $unit_id;
      $addPozicija->custom_title = $title;
      $addPozicija->custom_description = $description;
      $addPozicija->save();
   }

   //custom pozicija create & store start
}
