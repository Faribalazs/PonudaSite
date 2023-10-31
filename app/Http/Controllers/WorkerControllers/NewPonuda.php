<?php

namespace App\Http\Controllers\WorkerControllers;

use App\Models\{Ponuda, Category, Subcategory, Pozicija, Default_category, Default_subcategory, Default_pozicija, Swap, Title_Temporary, Pozicija_Temporary, Ponuda_Date, Worker};
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\Helper;

class NewPonuda extends Controller
{
   public function create()
   {  
      if(Auth::guard('worker'))
      {
      $worker_id = Helper::worker();
      $mergedData = $this->mergedData($worker_id);
      
      list($categories, $subcategories, $pozicija, $custom_categories, $custom_subcategories, $custom_pozicija, $swap) = $this->selectData($worker_id);

      return view('worker.views.create-ponuda', ['categories' => $categories, 'subcategories' => $subcategories, 'pozicija' => $pozicija, 'custom_categories' => $custom_categories, 'custom_subcategories' => $custom_subcategories, 'custom_pozicija' => $custom_pozicija, 'mergedData' => $mergedData, 'swap' => $swap]);
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
      $counter = auth('worker')->user()->ponuda_counter ?? -1;

      $ponuda = Ponuda::select(
               'ponuda.id',
               'ponuda.service_id',
               'ponuda.quantity',
               'ponuda.unit_price',
               'ponuda.overall_price',
               'ponuda.categories_id',
               'c.name AS name_category',
               'c_c.name AS name_custom_category',
               'u.name AS unit_name',
               'poz.title',
               'poz.description',
               'c_poz.custom_title',
               'c_poz.custom_description',
               'temp.temporary_description',
               'title.temporary_title',
               'serv.name_service'
         )
         ->leftJoin('categories as c', 'ponuda.categories_id', '=', 'c.id')
         ->leftJoin('pozicija as poz', 'ponuda.pozicija_id', '=', 'poz.id')
         ->leftJoin('custom_categories as c_c', 'ponuda.categories_id', '=', 'c_c.id')
         ->leftJoin('custom_pozicija as c_poz', 'ponuda.pozicija_id', '=', 'c_poz.id')
         ->join('units as u', function ($join) {
            $join->on('poz.unit_id', '=', 'u.id_unit')
               ->orWhere(function ($query) {
                     $query->on('c_poz.unit_id', '=', 'u.id_unit');
               });
         })
         ->leftJoin('pozicija_temporary as temp', 'ponuda.id', '=', 'temp.id_of_ponuda')
         ->leftJoin('title_temporary as title', 'ponuda.id', '=', 'title.id_of_ponuda')
         ->join('services as serv', 'ponuda.service_id', '=', 'serv.id_service')
         ->where('ponuda.ponuda_id', $counter)
         ->where('ponuda.worker_id', $worker_id)
         ->whereNull('c_c.is_category_deleted')
         ->whereNull('c_poz.is_pozicija_deleted')
         ->get();
      return $ponuda;
   }

   public function storePonuda(Request $request)
   {
      try {
         $request->validate([
            'category' => 'required|regex:/^[0-9\s]+$/i',
            'subcategory' => 'required|regex:/^[0-9\s]+$/i',
            'quantity' => 'required|regex:/^[0-9\s]+$/i',
            'pozicija_id' => 'required|regex:/^[0-9\s]+$/i',
            'price' => 'required|regex:/^[0-9\s]+$/i',
            'radioButton' => 'required|in:1,2',
            'opis' => 'nullable|regex:/\p{L}/u',
        ]);

         if($request->input('quantity') > 0 && $request->input('price') > 0)
         {
            $worker_id = Helper::worker();
            $swap = Swap::join('workers', 'swap_ponuda.worker_id', '=', 'workers.id')
               ->where('workers.id', $worker_id)
               ->first();  
            $counter = $swap!==null?$swap->swap_id:auth('worker')->user()->ponuda_counter;
            $des = $request->input('edit_des') ?? "";
            $title = $request->input('edit_title') ?? "";
            $pozicija_id = $request->input('pozicija_id');

            Ponuda::create([
               'worker_id' => $worker_id,
               'ponuda_id' => $counter,
               'categories_id' => $request->input('category'),
               'subcategories_id' => $request->input('subcategory'),
               'pozicija_id' => $request->input('pozicija_id'),
               'service_id' => $request->input('radioButton'),
               'quantity' => $request->input('quantity'),
               'unit_price' => $request->input('price'),
               'overall_price' => $request->input('quantity') * $request->input('price')
            ]);

            $db = Default_pozicija::select('id', 'description', 'title')
               ->where('id', $pozicija_id)
               ->first();      
            $custom_db = Pozicija::select('id', 'custom_description', 'custom_title')
               ->where('id', $pozicija_id)
               ->first();      
            $id_of_ponuda = Ponuda::where('worker_id', $worker_id)->max('id');      
            $default_desc = $db!==null?$db->description:$custom_db->custom_description;
            $default_title = $db!==null?$db->title:$custom_db->custom_title;

            if($des != $default_desc)
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
            
            session()->forget('opis_ponude');
            session()->put('opis_ponude', $request->input('opis'));

            return redirect(route("worker.new.ponuda"))->with('msg', 'added'); 
         }
         else
         {
            Alert::error('Količina i cena moraju biti više od 0!')->showCloseButton()->showConfirmButton('Zatvori');
            return redirect(route("worker.new.ponuda"));
         }
       } catch (Exception $e) {
            Alert::error('Nešto nije u redu!'.$e)->showCloseButton()->showConfirmButton('Zatvori');
            return redirect(route("worker.new.ponuda"));
       }
   }

   public function updateDescription(Request $request)
   {
      $request->validate([
         'real_id' => ['required'],
         'new_radioButton' => ['required','in:1,2'],
         'new_quantity' => ['required'],
         'new_unit_price' => ['required'],
         'new_title' => ['required'],
         'new_description' => ['nullable'],
      ]);

      $temp = $request->input('new_description') ?? "";
      $title = $request->input('new_title');
      $id = $request->input('real_id');

      $ponuda = Ponuda::where('id', $id)->where('worker_id', Helper::worker())->first();

      $ponuda_desc = Ponuda::join('pozicija_temporary as temp', 'ponuda.id', '=', 'temp.id_of_ponuda')
         ->where('ponuda.id', $id)
         ->where('ponuda.worker_id', Helper::worker())
         ->first();

      if($ponuda_desc)
      {
         Pozicija_Temporary::where('id_of_ponuda', $id)->update([
            'temporary_description' => $temp,
         ]);
      }
      else
      {
         Pozicija_Temporary::create([
            'id_of_ponuda' => $id,
            'temporary_description' => $temp,
         ]);
      }

      $ponuda_title = Ponuda::join('title_temporary as temp', 'ponuda.id', '=', 'temp.id_of_ponuda')
         ->where('ponuda.id', $id)
         ->where('ponuda.worker_id', Helper::worker())
         ->first();

      if($ponuda_title)
      {
         Title_Temporary::where('id_of_ponuda', $id)->update([
            'temporary_title' => $title,
         ]);
      }
      else
      {
         Title_Temporary::create([
            'id_of_ponuda' => $id,
            'temporary_title' => $title,
         ]);
      }

      Ponuda::where('id', $id)->update([
         'service_id' => $request->input('new_radioButton'),
         'quantity' => $request->input('new_quantity'),
         'unit_price' => $request->input('new_unit_price'),
         'overall_price' => $request->input('new_quantity') * $request->input('new_unit_price'),
      ]);
      return redirect()->route('worker.new.ponuda');
   }

   public function ponudaDone(Request $request)
   {
      
      $request->validate([
         'ponuda_name' => 'required|min:3|max:64|regex:/^[a-zA-Z0-9\s\-\/_]+$/',
         'opis' => 'nullable',
         'note' => 'nullable|max:64'
      ]);

      $worker_id = Helper::worker();
      if($this->checkPonudaDone($worker_id) !== null){
         $ponuda_name = $request->input('ponuda_name');
         $swap = Swap::join('workers', 'swap_ponuda.worker_id', '=', 'workers.id')
            ->where('workers.id', $worker_id)
            ->first();  
         if($swap!==null)
         {
            Worker::where('id', $worker_id)->update(['ponuda_counter' => $swap->original_id]);        
            $p_date = Ponuda_Date::updateOrCreate(
            [
               'worker_id' => $worker_id,
               'id_ponuda' => $swap->swap_id
            ],
            [
               'worker_id' => $worker_id,
               'id_ponuda' => $swap->swap_id,
               'ponuda_name' => $ponuda_name,
               'note' => $request->input('note'),
               'opis' => $request->input('opis'),
            ]);
   
            if (!$p_date->wasRecentlyCreated) {
               $p_date->updated_at = now();
               $p_date->save();
            }
   
            Swap::where('worker_id', $worker_id)->delete();
         }
         else
         {
            Ponuda_Date::create([
               'worker_id' => $worker_id,
               'id_ponuda' => auth('worker')->user()->ponuda_counter,
               'ponuda_name' => $ponuda_name,
               'note' => $request->input('note'),
               'opis' => $request->input('opis'),
            ]);         
            auth('worker')->user()->increment('ponuda_counter');
            Worker::where('id', $worker_id)->update(['ponuda_counter' => auth('worker')->user()->ponuda_counter]);
         }

         if ($request->input('edit')) {
            Alert::success('Ponuda je uspešno izmenjena!')->showCloseButton()->showConfirmButton('Zatvori');
            return redirect(route("worker.new.ponuda"));
         }

         session()->forget('opis_ponude');
         
         Alert::success('Ponuda je uspešno kreirana. Možete je pronaći u arhivi!')->showCloseButton()->showConfirmButton('Zatvori');
         return redirect(route("worker.new.ponuda"));
      }
      else
      {
         Alert::error('Niste uneli podatke')->showCloseButton()->showConfirmButton('Zatvori');
         return redirect(route("worker.new.ponuda"));  
      }
   }

   private function checkPonudaDone($worker)
   {
      $swap = Swap::join('workers', 'swap_ponuda.worker_id', '=', 'workers.id')
         ->where('workers.id', $worker)
         ->first();

      if ($swap!==null) {
         return Ponuda::where('worker_id', $worker)
            ->where('ponuda_id', $swap->swap_id)
            ->first();
      } else {
         return Ponuda::where('worker_id', $worker)
            ->where('ponuda_id', auth('worker')->user()->ponuda_counter)
            ->first();
      }

      return null;
   }
   
   public function deletePonuda(Request $request){
      $request->validate([
         'id' => ['required']
      ]);
      Ponuda::where('id', $request->input('id'))
         ->where('worker_id', Helper::worker())
         ->delete();
      Alert::success('Element ponude je uspešno obrisan!')->showCloseButton()->showConfirmButton('Zatvori');
      return redirect(route("worker.new.ponuda"));
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
