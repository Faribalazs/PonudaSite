<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Company_Data;
use App\Models\Clients;

class WorkerController extends Controller
{
   private function worker()
   {
      if (Auth::guard('worker')->check()) {
         return Auth::guard('worker')->user()->id;
      }
      return null;
   }

   public function index()
   {
       if(Auth::user()->hasRole('user')){
          return view('userdash');
       } 
       else {
          return view('dashboard');
     }
   }

   public function profile()
   {
    return view('worker.views.profile-page');
   }

   public function personalData()
   {
      $company_data = DB::select('select * from company_data where worker_id = ?', [$this->worker()]);
      return view('worker.views.personal-data', ['company_data' => empty($company_data[0])?null:$company_data[0]]);
   }
   public function savePersonalData(Request $request)
   {
      $company_name = $request->naziv_firme;
      $country = $request->drzava;
      $city = $request->grad;
      $zip = $request->postcode;
      $address = $request->adresa;
      $email = $request->email;
      $tel = $request->tel;
      $pib = $request->pib;
      $maticni_broj = $request->maticni_broj;
      $tekuci_racun = $request->tekuci_racun;
      $bank_account = $request->bank_account;
      $bank_name = $request->naziv_banke;

      $fileName = null;
      if ($request->hasFile('logo')) {
         $image = $request->file('logo');
         $fileName = time() . $this->worker() . '.' . $image->getClientOriginalExtension();
         $img = Image::make($image->getRealPath());
         $img->resize(360, 270);
         // $img->resize(360, 360, function ($constraint) {
         //     $constraint->aspectRatio();                 
         // });
         $img->stream();
         Storage::disk('local')->put('logo/'.$fileName, $img, 'public');
     }

      $company_data = new Company_Data();
      $company_data->worker_id = $this->worker();
      $company_data->company_name = $company_name;
      $company_data->country = $country;
      $company_data->city = $city;
      $company_data->zip_code = $zip;
      $company_data->address = $address;
      $company_data->tel = $tel;
      $company_data->email = $email;
      $company_data->pib = $pib;
      $company_data->maticni_broj = $maticni_broj;
      $company_data->tekuci_racun = $tekuci_racun;
      $company_data->bank_account = $bank_account;
      $company_data->bank_name = $bank_name;
      $company_data->logo = $fileName;
      $company_data->save();

      return redirect()->intended(route('worker.personal.data'));
   }

   public function myContacts()
   {
      $clients = DB::select('select * from clients where worker_id = ?', [$this->worker()]);
      return view('worker.views.profile-contacts', ['clients' => $clients]);
   }

   public function saveContact(Request $request)
   {
      $id = $request->has('id') ? $request->id : null;      
      $first_name = $request->f_name;
      $last_name = $request->l_name;
      $city = $request->grad;
      $zip = $request->postcode;
      $address = $request->adresa;
      $email = $request->email;
      $tel = $request->tel;

      if($id === null)
      {
         $client = new Clients();
         $client->worker_id = $this->worker();
         $client->first_name = $first_name;
         $client->last_name = $last_name;
         $client->city = $city;
         $client->zip_code = $zip;
         $client->address = $address;
         $client->email = $email;
         $client->tel = $tel;
         $client->save();
      }
      else
      {
         DB::update('update clients set first_name = ? , last_name = ? , city = ? , zip_code = ? , address = ? , email = ? , tel = ? where id = ? AND worker_id = ?', [$first_name, $last_name, $city, $zip, $address, $email, $tel, $id, $this->worker()]);
      }

      return redirect()->intended(route('worker.personal.contacts'));
   }

   public function updateContact($id)
   {
      $updateClient = DB::select('select * from clients where id = ? AND worker_id = ?', [$id, $this->worker()]);
      if(!empty($updateClient))
         Session::flash('updateClient', $updateClient[0]);

      return redirect()->intended(route('worker.personal.contacts'));
   }

   public function deleteContact($id)
   {
      DB::table('clients')->where('id', $id)->where('worker_id', $this->worker())->delete();

      return redirect()->intended(route('worker.personal.contacts'));
   }

   public function postcreate()
   {
    return view('postcreate');
   }
}
