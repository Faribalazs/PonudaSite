<?php

namespace App\Http\Controllers\WorkerControllers;

use Exception;
use App\Models\Ponuda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
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
      usort($mergedData, function($a, $b) {
          return $a->id - $b->id;
      });
      
      list($categories, $subcategories, $pozicija, $custom_categories, $custom_subcategories, $custom_pozicija) = $this->selectData($worker_id);

      return view('worker.views.create-ponuda', ['categories' => $categories, 'subcategories' => $subcategories, 'pozicija' => $pozicija, 'custom_categories' => $custom_categories, 'custom_subcategories' => $custom_subcategories, 'custom_pozicija' => $custom_pozicija, 'mergedData' => $mergedData, 'subTotal' => $subTotal]);
      }
      else
      {
         return view('worker.views.create-ponuda');
      }
   }
   private function selectData($worker_id)
   {
      //default
      $categories = DB::select('select * from categories');
      $subcategories = DB::select('select * from subcategories');
      $pozicija = DB::select('select * from pozicija p JOIN units u WHERE p.unit_id = u.id_unit');
      //custom
      $custom_categories = DB::select('select * from custom_categories where worker_id = ? and is_category_deleted IS NULL',[$worker_id]);
      $custom_subcategories = DB::select('select * from custom_subcategories where worker_id = ? and is_subcategory_deleted IS NULL',[$worker_id]);
      $custom_pozicija = DB::select('SELECT * FROM custom_pozicija p JOIN units u ON u.id_unit= p.unit_id WHERE p.worker_id = ? and is_pozicija_deleted IS NULL', [$worker_id]);
      return array($categories, $subcategories, $pozicija, $custom_categories, $custom_subcategories, $custom_pozicija);
   }
   private function mergedData($worker_id)
   {
      $worker = DB::select('select id, ponuda_counter from workers where id = ?',[$worker_id]);
      $counter = $worker[0]->ponuda_counter;
      
      $ponuda = DB::select('SELECT p.id, p.worker_id, p.ponuda_id, p.categories_id, p.subcategories_id, p.pozicija_id, p.quantity, p.unit_price, p.overall_price, c.id 
      AS id_category, c.name AS name_category, s.id AS
      id_subcategory, s.name AS name_subcategory, poz.id 
      AS id_pozicija, poz.unit_id, u.id_unit, u.name AS unit_name, poz.title, poz.description, temp.id_of_ponuda, temp.temporary_description,
      serv.id_service, serv.name_service
      FROM ponuda p JOIN categories c ON p.categories_id = c.id 
      JOIN subcategories s ON p.subcategories_id = s.id 
      JOIN pozicija poz ON p.pozicija_id = poz.id
      JOIN units u ON poz.unit_id = u.id_unit 
      LEFT JOIN pozicija_temporary temp ON p.id = temp.id_of_ponuda
      JOIN services serv ON p.service_id = serv.id_service
      where p.ponuda_id = ? and p.worker_id = ?',[$counter,$worker_id]);
      $custom_ponuda = DB::select('SELECT p.id, p.worker_id, p.ponuda_id, p.categories_id, p.subcategories_id, p.pozicija_id, p.service_id, p.quantity, p.unit_price, p.overall_price, c.id 
      AS id_category, c.name AS name_custom_category, s.id AS
      id_subcategory, s.name AS name_custom_subcategory, poz.id 
      AS id_pozicija, poz.unit_id, u.id_unit, u.name AS unit_name, poz.custom_title, poz.custom_description, 
      s.is_subcategory_deleted, c.is_category_deleted, poz.is_pozicija_deleted, temp.id_of_ponuda, temp.temporary_description,
      serv.id_service, serv.name_service
      FROM ponuda p JOIN custom_categories c ON p.categories_id = c.id 
      JOIN custom_subcategories s ON p.subcategories_id = s.id 
      JOIN custom_pozicija poz ON p.pozicija_id = poz.id 
      JOIN units u ON poz.unit_id = u.id_unit
      LEFT JOIN pozicija_temporary temp ON p.id = temp.id_of_ponuda
      JOIN services serv ON p.service_id = serv.id_service
      where p.ponuda_id = ? and p.worker_id = ? and s.is_subcategory_deleted IS NULL and c.is_category_deleted IS NULL and poz.is_pozicija_deleted IS NULL',[$counter,$worker_id]);
      return $mergedData = array_merge($ponuda, $custom_ponuda);
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

         if(request('quantity') > 0 && request('price') > 0)
         {
         $this->successPonuda($request);
         Alert::success('Uspesno dodato!')->showCloseButton()->showConfirmButton('Zatvori');
         return redirect(route("worker.new.ponuda")); 
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
      $worker = DB::select('select id, ponuda_counter from workers where id = ?',[$worker_id]);
      $counter = $worker[0]->ponuda_counter;
      $des = $request->edit_des;
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

      $db = DB::select('select id,description from pozicija where id = ?', [$request->pozicija_id]);
      $custom_db = DB::select('select id,custom_description from custom_pozicija where id = ?', [$request->pozicija_id]);
      $id_of_ponuda = DB::table('ponuda')->where('worker_id',$worker_id)->max('id');
      $default_desc = count($db)>0?$db[0]->description:$custom_db[0]->custom_description;
      if(empty($des))
         $des="";
      if($des != $default_desc)
      {
         DB::insert('insert into pozicija_temporary (id_of_ponuda, temporary_description) values (?, ?)', [$id_of_ponuda,$des]);
      }
   }
   public function updateDescription(Request $request)
   {
      $temp = $request->new_description;
      $id = $request->real_id;
      if(empty($temp))
         $temp="";
      $this->updateDesc($temp,$id);
      return $this->create();
   }
   private function updateDesc($temp_desc,$real_id)
   {
      $ponuda = DB::select('select * from ponuda p JOIN pozicija_temporary temp ON p.id = temp.id_of_ponuda where p.id = ?', [$real_id]);
      if(count($ponuda)>0)
      {
         DB::update('update pozicija_temporary set temporary_description = ? where id_of_ponuda = ?', [$temp_desc, $real_id]);
      }
      else
      {
         DB::insert('insert into pozicija_temporary (id_of_ponuda, temporary_description) values (?, ?)', [$real_id, $temp_desc]);
      }
   }
   public function ponudaDone(Request $request)
   {
      $validator =  Validator::make($request->all(), [
         'ponuda_name' => 'required|min:3|max:64|regex:/^[a-zA-Z0-9\s\-\/_]+$/',
         'note' => 'nullable|max:64|regex:/^[a-zA-Z0-9\s\-\/_]+$/'
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
      return DB::select('select * from ponuda where worker_id = ? and ponuda_id = ?', [$worker, $this->ponudaCounter($worker)->ponuda_counter]);
   }
   private function successsponudaDone($request, $worker){
      $ponuda_name = $request->ponuda_name;
      date_default_timezone_set('Europe/Belgrade');
      $date = date('Y-m-d H:i:s');
      DB::insert('insert into ponuda_date (worker_id, id_ponuda,created_at,ponuda_name, note) values (?, ?, ?, ?, ?)', [$worker, $this->ponudaCounter($worker)->ponuda_counter, $date, $ponuda_name, $request->note]);
      $this->ponudaCounter($worker)->increment('ponuda_counter');
      DB::update('update workers set ponuda_counter = ? where id = ?', [$this->ponudaCounter($worker)->ponuda_counter,$worker]);
   }
   
   public function deletePonuda($id){
      $this->delPonuda($id);
      Alert::success('Element ponude je uspešno obrisan!')->showCloseButton()->showConfirmButton('Zatvori');
      return redirect(route("worker.new.ponuda"));
   }

   private function delPonuda($id){
      return DB::table('ponuda')->where('id', $id)->where('worker_id',$this->worker())->delete();
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
