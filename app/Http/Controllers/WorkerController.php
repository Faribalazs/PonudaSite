<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Company_Data;
use App\Models\Fizicko_lice;
use App\Models\Pravno_lice;
use RealRashid\SweetAlert\Facades\Alert;

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
         $data = $request->validate([
            'company_name' => 'required | max:50 | regex:/\p{L}/u',
            'country' => 'required | max:20 | regex:/\p{L}/u',
            'city' => 'required | max:30 | regex:/\p{L}/u',
            'postcode' => 'required | max:10 | regex:/^[0-9]+$/',
            'address' => 'required | max:50 | regex:/\p{L}/u',
            'email' => 'required | email',
            'phone' => 'required | max:25 | regex:/^([0-9\s\-\+\(\)]*)$/',
            'pib' => 'required | max:20 | regex:/^[0-9\-]+$/',
            'maticni_broj' => 'required | max:25 | regex:/^[0-9\-]+$/',
            'bank_account' => 'required | max:30 | regex:/^[0-9\-]+$/',
            'tekuci_racun' => 'required | max:30 | regex:/^[0-9\-]+$/',
            'bank_name' => 'required | max:30 | regex:/\p{L}/u',
            'logo' => 'required | mimes:jpeg,png,jpg,webp | max:2048 ',
         ],
         [
            'naziv_firme' => trans("app.errors.profile-company"),
            '*.required' => trans("app.errors.profile-required"),
            'logo.mimes' => trans("app.errors.profile-image"),
            'logo.max' => trans("app.errors.profile-image-max"),
            'postcode.regex' => trans("app.errors.profile-only-numbers"),
            'pib.regex' => trans("app.errors.profile-only-numbers"),
            'maticni_broj.regex' => trans("app.errors.profile-only-numbers"),
            'bank_account.regex' => trans("app.errors.profile-only-numbers"),
            'tekuci_racun.regex' => trans("app.errors.profile-only-numbers"),
            'email.email' => trans("app.errors.profile-email"),
         ]);

      $user_id = Auth::guard('worker')->user()->id;

      $fileName = null;
      if ($data['logo'] != null) {
         $image = Image::make($data['logo'])->encode('webp', 90)->resize(360, 270);
         $name = uniqid().'.webp';
         Storage::disk('public')->put('images/worker/'.$user_id .'/logo'. '/' . $name, $image);
         $path = 'images/worker/'.$user_id .'/logo'. '/' . $name;
     }

      $company_data = Company_Data::create([
         'worker_id' => $this->worker(),
         'company_name' => $data['company_name'],
         'country' => $data['country'],
         'city' => $data['city'],
         'zip_code' => $data['postcode'],
         'address' => $data['address'],
         'phone' => $data['phone'],
         'email' => $data['email'],
         'pib' => $data['pib'],
         'maticni_broj' => $data['maticni_broj'],
         'tekuci_racun' => $data['tekuci_racun'],
         'bank_account' => $data['bank_account'],
         'bank_name' => $data['bank_name'],
         'logo' => $path,
      ]);

      if($company_data->save()){
         alert()->success('Uspesno dodato!')->showCloseButton()->showConfirmButton('Zatvori');
         return redirect()->intended(route('worker.personal.data'));
      }

      alert()->error('Podaci nisu sacuvane')->showCloseButton()->showConfirmButton('Zatvori');
      return redirect()->intended(route('worker.personal.data'));
   }

   public function companyDelete()
   {
      $company_data = Company_Data::where('worker_id', $this->worker())->first();
      Storage::disk('public')->delete($company_data->logo);
      $company_data->delete();
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
      $data = $request->validate([
            'f_name' => 'required | max:30 | regex:/\p{L}/u',
            'l_name' => 'required | max:30 | regex:/\p{L}/u',
            'city' => 'required | max:30 | regex:/\p{L}/u',
            'postcode' => 'required | max:10 | regex:/^[0-9]+$/',
            'address' => 'required | max:50 | regex:/\p{L}/u',
            'email' => 'required | email',
            'worker_id' => 'max:10 | regex:/^[0-9]+$/',
            'id' => 'max:10 | regex:/^[0-9]+$/',
            'phone' => 'required | max:25 | regex:/^([0-9\s\-\+\(\)]*)$/'
         ],
         [
            '*.required' => trans("app.errors.profile-required"),
            'postcode.regex' => trans("app.errors.profile-only-numbers"),
            'email.email' => trans("app.errors.profile-email"),
         ]);
      $user_id = Auth::guard('worker')->user()->id;

      if(isset($data['id']) && isset($data['worker_id'])){
         $id = $data['id'];
         $worker_id = $data['worker_id'];
      } else {
         $id = null;
         $worker_id = null;
      }

      $fizicko_lice = Fizicko_lice::updateOrCreate(
         [
            'id' => $id,
            'worker_id' => $worker_id
         ],
         [
         'worker_id' => $user_id,
         'first_name' => $data['f_name'],
         'last_name' => $data['l_name'],
         'city' => $data['city'],
         'zip_code' => $data['postcode'],
         'address' => $data['address'],
         'email' => $data['email'],
         'phone' => $data['phone']
      ]);

      if($fizicko_lice->save()){
         if(isset($data['id']) && isset($data['worker_id'])){
            alert()->success('Podaci uspesno promenjeni!')->showCloseButton()->showConfirmButton('Zatvori');
         } else {
            alert()->success('Uspesno dodato!')->showCloseButton()->showConfirmButton('Zatvori');
         }
         return redirect()->intended(route('worker.personal.contacts'));
      }
      alert()->error('Podaci nisu sacuvane')->showCloseButton()->showConfirmButton('Zatvori');
      return redirect()->intended(route('worker.personal.contacts'));
   }

   public function editContactFizicka($id)
   {
      $contact = Fizicko_lice::where('id', $id)->where('worker_id', $this->worker())->first();
      return view('worker.views.profile.add-fizicko-lice', ['contact' => $contact]);
   }

   public function deleteContactFizicka(Request $request)
   {
      $id = $request->id;
      $delete = Fizicko_lice::where('id', $id)->where('worker_id', $this->worker())->delete();
      if($delete != 0){
         alert()->success('Kontakt je izbrisan')->showCloseButton()->showConfirmButton('Zatvori');
      } else {
         alert()->error('Kontakt nije izbrisan')->showCloseButton()->showConfirmButton('Zatvori');
         return redirect()->back();
      }
      return redirect()->intended(route('worker.personal.contacts'));
   }

   public function addPravnoIndex()
   {
      return view('worker.views.profile.add-pravno-lice');
   }

   public function savePravnoLice(Request $request)
   {
      $data = $request->validate([
         'company_name' => 'required | max:50 | regex:/\p{L}/u',
         'city' => 'required | max:30 | regex:/\p{L}/u',
         'postcode' => 'required | max:10 | regex:/^[0-9]+$/',
         'address' => 'required | max:50 | regex:/\p{L}/u',
         'email' => 'required | email',
         'worker_id' => 'max:10 | regex:/^[0-9]+$/',
         'id' => 'max:10 | regex:/^[0-9]+$/',
         'phone' => 'required | max:25 | regex:/^([0-9\s\-\+\(\)]*)$/',
         'pib' => 'max:30 | regex:/^[0-9\-]+$/',
      ],
      [
         '*.required' => trans("app.errors.profile-required"),
         'postcode.regex' => trans("app.errors.profile-only-numbers"),
         'email.email' => trans("app.errors.profile-email"),
         'pib.regex' => trans("app.errors.profile-only-numbers"),
      ]);

   $user_id = Auth::guard('worker')->user()->id;

   if(isset($data['id']) && isset($data['worker_id'])){
      $id = $data['id'];
      $worker_id = $data['worker_id'];
   } else {
      $id = null;
      $worker_id = null;
   }

   $pravno_lice = Pravno_lice::updateOrCreate(
      [
         'id' => $id,
         'worker_id' => $worker_id
      ],
      [
      'worker_id' => $user_id,
      'company_name' => $data['company_name'],
      'city' => $data['city'],
      'zip_code' => $data['postcode'],
      'address' => $data['address'],
      'email' => $data['email'],
      'phone' => $data['phone'],
      'pib' => $data['pib'],
   ]);

   if($pravno_lice->save()){
      if(isset($data['id']) && isset($data['worker_id'])){
         alert()->success('Podaci uspesno promenjeni!')->showCloseButton()->showConfirmButton('Zatvori');
      } else {
         alert()->success('Uspesno dodato!')->showCloseButton()->showConfirmButton('Zatvori');
      }
      return redirect()->intended(route('worker.personal.contacts'));
   }
      alert()->error('Podaci nisu sacuvane')->showCloseButton()->showConfirmButton('Zatvori');
      return redirect()->intended(route('worker.personal.contacts'));
   }

   public function editContactPravno($id)
   {
      $contact = Pravno_lice::where('id', $id)->where('worker_id', $this->worker())->first();
      return view('worker.views.profile.add-pravno-lice', ['contact' => $contact]);
   }

   public function deleteContactPravno(Request $request)
   {
      $id = $request->id;
      $delete = Pravno_lice::where('id', $id)->where('worker_id', $this->worker())->delete();
      if($delete != 0){
         alert()->success('Kontakt je izbrisan')->showCloseButton()->showConfirmButton('Zatvori');
      } else {
         alert()->error('Kontakt nije izbrisan')->showCloseButton()->showConfirmButton('Zatvori');
         return redirect()->back();
      }
      return redirect()->intended(route('worker.personal.contacts'));
   }
}
