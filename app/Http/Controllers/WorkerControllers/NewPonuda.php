<?php

namespace App\Http\Controllers\WorkerControllers;

use Exception;
use App\Models\Ponuda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Pozicija;
use App\Models\Default_category;
use App\Models\Default_subcategory;
use App\Models\Default_pozicija;
use App\Models\Swap;
use App\Models\Title_Temporary;
use App\Models\Pozicija_Temporary;
use App\Models\Ponuda_Date;
use App\Models\Worker;

class NewPonuda extends Controller
{
   private function worker()
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
      $mergedData = $this->mergedData($worker_id);
      $subTotal = 0;
      foreach($mergedData as $mData){
         $subTotal += $mData->overall_price;
      }
      
      list($categories, $subcategories, $pozicija, $custom_categories, $custom_subcategories, $custom_pozicija, $swap) = $this->selectData($worker_id);

      return view('worker.views.create-ponuda', ['categories' => $categories, 'subcategories' => $subcategories, 'pozicija' => $pozicija, 'custom_categories' => $custom_categories, 'custom_subcategories' => $custom_subcategories, 'custom_pozicija' => $custom_pozicija, 'mergedData' => $mergedData, 'subTotal' => $subTotal, 'swap' => $swap]);
      }
      else
      {
         return view('worker.views.create-ponuda');
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

      $swap = Swap::join('workers', 'swap_ponuda.worker_id', '=', 'workers.id')
         ->where('workers.id', $worker_id)
         ->get();  

      return array($categories, $subcategories, $pozicija, $custom_categories, $custom_subcategories, $custom_pozicija, $swap);
   }

   private function mergedData($worker_id)
   {
      $worker = Worker::select('id', 'ponuda_counter')
         ->where('id', $worker_id)
         ->first();      
      $counter = $worker->ponuda_counter;

      $ponuda = Ponuda::select(
         'ponuda.id',
         'ponuda.worker_id',
         'ponuda.ponuda_id',
         'ponuda.categories_id',
         'ponuda.subcategories_id',
         'ponuda.pozicija_id',
         'ponuda.service_id',
         'ponuda.quantity',
         'ponuda.unit_price',
         'ponuda.overall_price',
         'c.id AS id_category',
         'c.name AS name_category',
         's.id AS id_subcategory',
         's.name AS name_subcategory',
         'poz.id AS id_pozicija',
         'poz.unit_id',
         'u.id_unit',
         'u.name AS unit_name',
         'poz.title',
         'poz.description',
         'temp.id_of_ponuda AS id_of_ponuda_temp',
         'temp.temporary_description',
         'title.id_of_ponuda AS id_of_ponuda_title',
         'title.temporary_title',
         'serv.id_service',
         'serv.name_service'
     )
     ->join('categories as c', 'ponuda.categories_id', '=', 'c.id')
     ->join('subcategories as s', 'ponuda.subcategories_id', '=', 's.id')
     ->join('pozicija as poz', 'ponuda.pozicija_id', '=', 'poz.id')
     ->join('units as u', 'poz.unit_id', '=', 'u.id_unit')
     ->leftJoin('pozicija_temporary as temp', 'ponuda.id', '=', 'temp.id_of_ponuda')
     ->leftJoin('title_temporary as title', 'ponuda.id', '=', 'title.id_of_ponuda')
     ->join('services as serv', 'ponuda.service_id', '=', 'serv.id_service')
     ->where('ponuda.ponuda_id', $counter)
     ->where('ponuda.worker_id', $worker_id)
     ->get();
     $custom_ponuda = Ponuda::select(
      'ponuda.id',
      'ponuda.worker_id',
      'ponuda.ponuda_id',
      'ponuda.categories_id',
      'ponuda.subcategories_id',
      'ponuda.pozicija_id',
      'ponuda.service_id',
      'ponuda.quantity',
      'ponuda.unit_price',
      'ponuda.overall_price',
      'c.id AS id_category',
      'c.name AS name_custom_category',
      's.id AS id_subcategory',
      's.name AS name_custom_subcategory',
      'poz.id AS id_pozicija',
      'poz.unit_id',
      'u.id_unit',
      'u.name AS unit_name',
      'poz.custom_title',
      'poz.custom_description',
      's.is_subcategory_deleted',
      'c.is_category_deleted',
      'poz.is_pozicija_deleted',
      'temp.id_of_ponuda AS id_of_ponuda_temp',
      'temp.temporary_description',
      'title.id_of_ponuda AS id_of_ponuda_title',
      'title.temporary_title',
      'serv.id_service',
      'serv.name_service'
  )
      ->join('custom_categories as c', 'ponuda.categories_id', '=', 'c.id')
      ->join('custom_subcategories as s', 'ponuda.subcategories_id', '=', 's.id')
      ->join('custom_pozicija as poz', 'ponuda.pozicija_id', '=', 'poz.id')
      ->join('units as u', 'poz.unit_id', '=', 'u.id_unit')
      ->leftJoin('pozicija_temporary as temp', 'ponuda.id', '=', 'temp.id_of_ponuda')
      ->leftJoin('title_temporary as title', 'ponuda.id', '=', 'title.id_of_ponuda')
      ->join('services as serv', 'ponuda.service_id', '=', 'serv.id_service')
      ->where('ponuda.ponuda_id', $counter)
      ->where('ponuda.worker_id', $worker_id)
      ->whereNull('s.is_subcategory_deleted')
      ->whereNull('c.is_category_deleted')
      ->whereNull('poz.is_pozicija_deleted')
      ->get();

      $mergedData = $ponuda->concat($custom_ponuda);
      return $mergedData;
   }

   public function storePonuda(Request $request)
   {
      // dd($request);
      try {
         $request->validate([
            'category' => 'required|regex:/^[0-9\s]+$/i',
            'subcategory' => 'required|regex:/^[0-9\s]+$/i',
            'quantity' => 'required|regex:/^[0-9\s]+$/i',
            'pozicija_id' => 'required|regex:/^[0-9\s]+$/i',
            'price' => 'required|regex:/^[0-9\s]+$/i',
            'radioButton' => 'required|in:1,2',
        ]);
         // dd($request);
         if(request('quantity') > 0 && request('price') > 0)
         {
         $this->successPonuda($request);
         // Alert::success('Uspesno dodato!')->showCloseButton()->showConfirmButton('Zatvori');
         return redirect(route("worker.new.ponuda"))->with('msg', 'added'); 
         }
         else
         {
            Alert::error('Nešto nije u redu!')->showCloseButton()->showConfirmButton('Zatvori');
            return redirect(route("worker.new.ponuda"));
         }
       } catch (Exception $e) {
            Alert::error('Nešto nije u redu!')->showCloseButton()->showConfirmButton('Zatvori');
            return redirect(route("worker.new.ponuda"));
       }
   }

   private function successPonuda($request){
      $worker_id = $this->worker();
      $worker = Worker::select('id', 'ponuda_counter')
         ->where('id', $worker_id)
         ->first();
      $swap = Swap::join('workers', 'swap_ponuda.worker_id', '=', 'workers.id')
         ->where('workers.id', $worker_id)
         ->first();  
      $counter = $swap!==null?$swap->swap_id:$worker->ponuda_counter;
      $des = $request->edit_des;
      $title = $request->edit_title;

      $addPonuda = new Ponuda();
      $addPonuda->worker_id = $worker_id;
      $addPonuda->ponuda_id = $counter; //request('ponuda_id');
      $addPonuda->categories_id = $request->category;
      $addPonuda->subcategories_id = $request->subcategory;
      $addPonuda->pozicija_id = $request->pozicija_id;
      $addPonuda->service_id = $request->radioButton;
      $addPonuda->quantity = $request->quantity;
      $addPonuda->unit_price = $request->price; //request('unit_price');
      $addPonuda->overall_price = $addPonuda->quantity*$addPonuda->unit_price;
      $addPonuda->save();

      $db = Default_pozicija::select('id', 'description', 'title')
         ->where('id', $request->pozicija_id)
         ->first();      
      $custom_db = Pozicija::select('id', 'custom_description', 'custom_title')
         ->where('id', $request->pozicija_id)
         ->first();      
      $id_of_ponuda = Ponuda::where('worker_id', $worker_id)->max('id');      
      $default_desc = $db!==null?$db->description:$custom_db->custom_description;
      $default_title = $db!==null?$db->title:$custom_db->custom_title;
      // dd($request);
      if(empty($des))
         $des="";
      if(empty($title))
         $title = "";
      if($des != $default_desc && $title != $default_title)
      {
         Pozicija_Temporary::create([
            'id_of_ponuda' => $id_of_ponuda,
            'temporary_description' => $des,
        ]);      
      }
      if($title != $default_title)
      {
         Title_Temporary::create([
            'id_of_ponuda' => $id_of_ponuda,
            'temporary_title' => $title,
        ]);
      }
   }

   public function updateDescription(Request $request)
   {
      $temp = $request->new_description;
      $title = $request->new_title;
      $id = $request->real_id;
      if(empty($temp))
         $temp="";
      if(empty($title))
         $title ="";
      $this->updateDesc($temp,$id);
      $this->updateTitle($title,$id);
      Ponuda::where('id', $id)->update([
         'service_id' => $request->new_radioButton,
         'quantity' => $request->new_quantity,
         'unit_price' => $request->new_unit_price,
         'overall_price' => $request->new_quantity * $request->new_unit_price,
      ]);
      return redirect()->intended(route('worker.new.ponuda'));
   }

   private function updateDesc($temp_desc,$real_id)
   {
      $ponuda = Ponuda::join('pozicija_temporary as temp', 'ponuda.id', '=', 'temp.id_of_ponuda')
         ->where('ponuda.id', $real_id)
         ->get();
      if($ponuda->isNotEmpty())
      {
         Pozicija_Temporary::where('id_of_ponuda', $real_id)->update([
            'temporary_description' => $temp_desc,
         ]);
      }
      else
      {
         Pozicija_Temporary::create([
            'id_of_ponuda' => $real_id,
            'temporary_description' => $temp_desc,
         ]);
      }
   }

   private function updateTitle($temp_title,$real_id)
   {
      $ponuda = Ponuda::join('title_temporary as temp', 'ponuda.id', '=', 'temp.id_of_ponuda')
         ->where('ponuda.id', $real_id)
         ->get();
      if($ponuda->isNotEmpty())
      {
         Title_Temporary::where('id_of_ponuda', $real_id)->update([
            'temporary_title' => $temp_title,
         ]);
      }
      else
      {
         Title_Temporary::create([
            'id_of_ponuda' => $real_id,
            'temporary_title' => $temp_title,
         ]);
      }
   }

   public function ponudaDone(Request $request)
   {
      
      $validator =  Validator::make($request->all(), [
         'ponuda_name' => 'required|min:3|max:64|regex:/^[a-zA-Z0-9\s\-\/_]+$/',
         'opis' => 'nullable',
         'note' => 'nullable|max:64'
     ]);
 
     if ($validator->fails()) {
      Alert::error('Ime ponude mora imati najmanje 3 znaka. Ime ponude i napomena ne sme biti duže od 64 karaktera, dozvoljava: slova (velika i mala slova) od a do z, brojeve od 0 do 9, razmake između reči, specijalne znakove: -, /, _')->showCloseButton()->showConfirmButton('Zatvori');
      return redirect(route("worker.new.ponuda"));
     } else {
      $worker_id = $this->worker();
      if(!empty($this->checkPonudaDone($worker_id))){
         $this->successsponudaDone($request, $worker_id);
         Alert::success('Ponuda uspesno dodato, mozete videti u arhivu!')->showCloseButton()->showConfirmButton('Zatvori');
         return redirect(route("worker.new.ponuda"));
      }
      else
      {
         Alert::error('Niste uneli podatke')->showCloseButton()->showConfirmButton('Zatvori');
         return redirect(route("worker.new.ponuda"));  
      }
   }
   }

   private function ponudaCounter($worker){
      return Worker::where('id', $worker)->first();
   }

   private function checkPonudaDone($worker)
   {
      $swap = Swap::join('workers', 'swap_ponuda.worker_id', '=', 'workers.id')
         ->where('workers.id', $worker)
         ->first();

      if ($swap!==null) {
         return Ponuda::where('worker_id', $worker)
            ->where('ponuda_id', $swap->swap_id)
            ->get();
      } else {
         return Ponuda::where('worker_id', $worker)
            ->where('ponuda_id', $this->ponudaCounter($worker)->ponuda_counter)
            ->get();
      }
   }
   
   private function successsponudaDone($request, $worker){
      $ponuda_name = $request->ponuda_name;
      // dd($request);
      date_default_timezone_set('Europe/Belgrade');
      $date = date('Y-m-d H:i:s');
      $swap = Swap::join('workers', 'swap_ponuda.worker_id', '=', 'workers.id')
         ->where('workers.id', $worker)
         ->first();  
      if($swap!==null)
      {
         Worker::where('id', $worker)->update(['ponuda_counter' => $swap->original_id]);         
         Ponuda_Date::where('id_ponuda', $swap->swap_id)
            ->where('worker_id', $worker)
            ->delete();         
         Ponuda_Date::create([
            'worker_id' => $worker,
            'id_ponuda' => $swap->swap_id,
            'created_at' => $date,
            'ponuda_name' => $ponuda_name,
            'note' => $request->note,
            'opis' => $request->opis,
         ]);
         Swap::where('worker_id', $worker)->delete();
      }
      else
      {
         Ponuda_Date::create([
            'worker_id' => $worker,
            'id_ponuda' => $this->ponudaCounter($worker)->ponuda_counter,
            'created_at' => $date,
            'ponuda_name' => $ponuda_name,
            'note' => $request->note,
            'opis' => $request->opis,
         ]);         
         $this->ponudaCounter($worker)->increment('ponuda_counter');
         Worker::where('id', $worker)->update(['ponuda_counter' => $this->ponudaCounter($worker)->ponuda_counter]);
      }
   }
   
   public function deletePonuda($id){
      $this->delPonuda($id);
      Alert::success('Element ponude je uspešno obrisan!')->showCloseButton()->showConfirmButton('Zatvori');
      return redirect(route("worker.new.ponuda"));
   }

   private function delPonuda($id){
      return Ponuda::where('id', $id)
         ->where('worker_id', $this->worker())
         ->delete();
   }

   public function profile()
   {
    return view('profile');
   }

   public function postcreate()
   {
    return view('postcreate');
   }
}
