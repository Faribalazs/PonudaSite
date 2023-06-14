<?php

namespace App\Http\Controllers\WorkerControllers;

use Exception;
use App\Models\Ponuda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

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
      //ponuda
      $worker = DB::select('select id, ponuda_counter from workers where id = ?',[$worker_id]);
      $counter = $worker[0]->ponuda_counter;
      $ponuda = DB::select('SELECT p.id, p.worker_id, p.ponuda_id, p.categories_id, p.subcategories_id, p.pozicija_id, p.quantity, p.unit_price, p.overall_price, c.id 
      AS id_category, c.name AS name_category, s.id AS
      id_subcategory, s.name AS name_subcategory, poz.id 
      AS id_pozicija, poz.unit_id, poz.title, poz.description 
      FROM ponuda p JOIN categories c ON p.categories_id = c.id 
      JOIN subcategories s ON p.subcategories_id = s.id 
      JOIN pozicija poz ON p.pozicija_id = poz.id 
      where p.ponuda_id = ? and p.worker_id = ?',[$counter,$worker_id]);
      $custom_ponuda = DB::select('SELECT p.id, p.worker_id, p.ponuda_id, p.categories_id, p.subcategories_id, p.pozicija_id, p.quantity, p.unit_price, p.overall_price, c.id 
      AS id_category, c.name AS name_custom_category, s.id AS
      id_subcategory, s.name AS name_custom_subcategory, poz.id 
      AS id_pozicija, poz.unit_id, poz.custom_title, poz.custom_description 
      FROM ponuda p JOIN custom_categories c ON p.categories_id = c.id 
      JOIN custom_subcategories s ON p.subcategories_id = s.id 
      JOIN custom_pozicija poz ON p.pozicija_id = poz.id 
      where p.ponuda_id = ? and p.worker_id = ?',[$counter,$worker_id]);
      $mergedData = array_merge($ponuda, $custom_ponuda);
      $subTotal = 0;
      foreach($mergedData as $mData){
         $subTotal += $mData->overall_price;
      }
      usort($mergedData, function($a, $b) {
          return $a->id - $b->id;
      });
      //default
      $categories = DB::select('select * from categories');
      $subcategories = DB::select('select * from subcategories');
      $pozicija = DB::select('select * from pozicija p JOIN units u WHERE p.unit_id = u.id_unit');
      //custom
      $custom_categories = DB::select('select * from custom_categories where worker_id = ?',[$worker_id]);
      $custom_subcategories = DB::select('select * from custom_subcategories where worker_id = ?',[$worker_id]);
      $custom_pozicija = DB::select('SELECT * FROM custom_pozicija p JOIN units u ON u.id_unit= p.unit_id WHERE p.worker_id = ?', [$worker_id]);

      return view('worker.views.create-ponuda', ['categories' => $categories, 'subcategories' => $subcategories, 'pozicija' => $pozicija, 'custom_categories' => $custom_categories, 'custom_subcategories' => $custom_subcategories, 'custom_pozicija' => $custom_pozicija, 'mergedData' => $mergedData, 'subTotal' => $subTotal]);
      }
      else
      {
         return view('worker.views.create-ponuda');
      }
   }

   public function storePonuda(Request $request)
   {

      try {
         $request->validate([
            'category' => 'required|regex:/^[0-9\s]+$/i',
            'subcategory' => 'required|regex:/^[0-9\s]+$/i',
            'quantity' => 'required|regex:/^[0-9\s]+$/i',
            'pozicija-id' => 'required|regex:/^[0-9\s]+$/i',
            'price' => 'required|regex:/^[0-9\s]+$/i',
        ]);

         $worker_id = $this->worker();
         $worker = DB::select('select * from workers where id = ?',[$worker_id]);
         $counter = $worker[0]->ponuda_counter;
         if(request('quantity') > 0 && request('price') > 0)
         {
         $addPonuda = new Ponuda();
         $addPonuda->worker_id = $worker_id;
         $addPonuda->ponuda_id = $counter; //request('ponuda_id');
         $addPonuda->categories_id = request('category');
         $addPonuda->subcategories_id = request('subcategory');
         $addPonuda->pozicija_id = request('pozicija-id');
         $addPonuda->quantity = request('quantity');
         $addPonuda->unit_price = request('price'); //request('unit_price');
         $addPonuda->overall_price = $addPonuda->quantity*$addPonuda->unit_price;
         $addPonuda->save();
         Alert::success('Uspesno dodato!')->showCloseButton()->showConfirmButton('Zatvori');
         return redirect(route("worker.new.ponuda")); 
         }
         else
         {
            Alert::error('Nešto nije u redu')->showCloseButton()->showConfirmButton('Zatvori');
            return redirect(route("worker.new.ponuda"));
         }
       } catch (Exception $e) {
            Alert::error('Nešto nije u redu')->showCloseButton()->showConfirmButton('Zatvori');
            return redirect(route("worker.new.ponuda"));
       }
   }

   public function ponudaDone(Request $request)
   {
      $validator =  Validator::make($request->all(), [
         'ponuda_name' => 'required|max:64|regex:/^[a-z\s]+$/i'
     ]);
 
     if ($validator->fails()) {
      Alert::error('Mora imati vrednost i ne sme biti prazno. Ne sme biti duže od 64 karaktera. Može sadržati samo slova (i velika i mala) i razmake. ')->showCloseButton()->showConfirmButton('Zatvori');
      return redirect(route("worker.new.ponuda"));
     } else {
      $ponuda_name = $request->ponuda_name;
      $worker_id = $this->worker();
      date_default_timezone_set('Europe/Belgrade');
      $date = date('Y-m-d H:i:s');
      $ponuda_counter = DB::select('select ponuda_counter from workers where id = ?', [$worker_id]);
      $result = DB::select('select * from ponuda where worker_id = ? and ponuda_id = ?', [$worker_id, $ponuda_counter[0]->ponuda_counter]);
      if(!empty($result)){
         DB::insert('insert into ponuda_date (worker_id, id_ponuda,created_at,ponuda_name) values (?, ?, ?, ?)', [$worker_id, $ponuda_counter[0]->ponuda_counter, $date, $ponuda_name]);
         DB::update('update workers set ponuda_counter = ? where id = ?', [++$ponuda_counter[0]->ponuda_counter,$worker_id]);
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

   public function deletePonuda($id){
      DB::table('ponuda')->where('id', $id)->where('worker_id',$this->worker())->delete();
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
