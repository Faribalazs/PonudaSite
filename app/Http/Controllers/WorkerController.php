<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Company_Data;
use App\Models\Fizicko_lice;
use App\Models\Pravno_lice;
use RealRashid\SweetAlert\Facades\Alert;
use \Exception;

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
    return view('worker.views.profile.profile-page');
   }

   public function personalData()
   {
      $company_data = Company_Data::where('worker_id', $this->worker())->first();
      return view('worker.views.profile.personal-data', ['company_data' => empty($company_data)?null:$company_data]);
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
      $user_id = Auth::guard('worker')->user()->id;

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
         Storage::disk('public')->put('worker/'.$user_id .'/logo'. '/' . $fileName, $img, 'public');
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
      $fizicka_lica = Fizicko_Lice::where('worker_id', $this->worker())->get();
      $pravna_lica = Pravno_Lice::where('worker_id', $this->worker())->get();
      return view('worker.views.profile.profile-contacts', ['fizicka_lica' => $fizicka_lica, 'pravna_lica'=> $pravna_lica]);
   }

   public function addFizickoIndex()
   {
      return view('worker.views.profile.add-fizicko-lice');
   }

   public function saveFizickoLice(Request $request)
   {
      try {
         $data = $request->validate([
            'f_name' => 'required|regex:/^[a-zA-Z\s ]*$/',
            'l_name' => 'required|regex:/^[a-zA-Z\s ]*$/',
            'grad' => 'required|regex:/^[a-zA-Z\s ]*$/',
            'adresa' => 'required|regex:/^[a-zA-Z0-9\s ]*$/',
            'postcode' => 'required|regex:/^[0-9\s]+$/i',
            'email' => 'required|email',
            'tel' => 'required|regex:/^[0-9\s]+$/i',
        ]);

      $fizicko_lice = new Fizicko_lice();
      $fizicko_lice->worker_id = $request->worker_id;
      $fizicko_lice->first_name = $data['f_name'];
      $fizicko_lice->last_name = $request->l_name;
      $fizicko_lice->city = $request->grad;
      $fizicko_lice->zip_code = $request->postcode;
      $fizicko_lice->address = $request->adresa;
      $fizicko_lice->email = $request->email;
      $fizicko_lice->tel = $request->tel;
      $fizicko_lice->save();

      alert()->success('Uspesno dodato!')->showCloseButton()->showConfirmButton('Zatvori');
      return redirect()->intended(route('worker.personal.contacts'));
        
       } catch (\Exception $e) {
            alert()->error('Nešto nije u redu!')->showCloseButton()->showConfirmButton('Zatvori');
            return redirect()->back();
       }
   }

   public function addPravnoIndex()
   {
      return view('worker.views.profile.add-pravno-lice');
   }

   public function savePravnoLice(Request $request)
   {
      try {
         $data = $request->validate([
            'company' => 'required|regex:/^[a-zA-Z\s ]*$/',
            'grad' => 'required|regex:/^[a-zA-Z\s ]*$/',
            'adresa' => 'required|regex:/^[a-zA-Z0-9\s ]*$/',
            'postcode' => 'required|regex:/^[0-9\s]+$/i',
            'email' => 'required|email',
            'tel' => 'required|regex:/^[0-9\s]+$/i',
            'pib' => 'required|regex:/^[0-9\s]+$/i',
        ]);

      $pravno_lice = new Pravno_lice();
      $pravno_lice->worker_id = $request->worker_id;
      $pravno_lice->company_name = $data['company'];
      $pravno_lice->city = $data['grad'];
      $pravno_lice->zip_code = $data['postcode'];
      $pravno_lice->address = $data['adresa'];
      $pravno_lice->email = $data['email'];
      $pravno_lice->tel = $data['tel'];
      $pravno_lice->pib = $data['pib'];
      $pravno_lice->save();

      alert()->success('Uspesno dodato!')->showCloseButton()->showConfirmButton('Zatvori');
      return redirect()->intended(route('worker.personal.contacts'));
        
       } catch (\Exception $e) {
            alert()->error('Nešto nije u redu!')->showCloseButton()->showConfirmButton('Zatvori');
            return redirect()->back();
       }
   }

   public function companyDelete()
   {
      Company_Data::where('worker_id', $this->worker())->delete();
      return redirect()->intended(route('worker.personal.data'));
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
         $client = new Fizicko_lice();
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
         Fizicko_lice::where('id', $id)
         ->where('worker_id', $workerId)
         ->update([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'city' => $city,
            'zip_code' => $zip,
            'address' => $address,
            'email' => $email,
            'tel' => $tel
         ]);      
      }

      return redirect()->intended(route('worker.personal.contacts'));
   }

   public function updateContact($id)
   {
      $updateClient = Fizicko_lice::where('id', $id)->where('worker_id', $this->worker())->get()->first();
      if ($updateClient) {
         Session::flash('updateClient', $updateClient);
      }

      return redirect()->intended(route('worker.personal.contacts'));
   }

   public function deleteContact($id)
   {
      Fizicko_lice::where('id', $id)->where('worker_id', $this->worker())->delete();

      return redirect()->intended(route('worker.personal.contacts'));
   }

   public function postcreate()
   {
    return view('postcreate');
   }
}
