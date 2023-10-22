<?php

namespace App\Http\Controllers\WorkerControllers;

use App\Models\{Swap, Ponuda, Ponuda_Date, Pozicija_Temporary, Title_Temporary, Worker, Fizicko_lice, Pravno_lice, Company_Data, Fizicko_lice_Temporary, Pravno_lice_Temporary};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\Helper;
use App\Jobs\SendEmail;

class Archive extends Controller
{
    private function showPrivate($worker){
        return Ponuda_Date::where('worker_id', $worker)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function show()
    {
        $worker_id = Helper::worker();
        $data = $this->showPrivate($worker_id);
        
        return view('worker.views.archive',['data' => $data]);
    }

    private function orderByDate($worker, $search, $order)
    {
        return Ponuda_Date::where('worker_id', $worker)
            ->where('ponuda_name', 'LIKE', $search)
            ->orderBy('created_at', $order)
            ->get();
    }

    private function orderByDateNapomena($worker, $search, $order)
    {
        return Ponuda_Date::where('worker_id', $worker)
            ->where('note', 'LIKE', $search)
            ->orderBy('created_at', $order)
            ->get();
    }

    public function search(Request $request)
    {
        $worker_id = Helper::worker();
        $sortOrder = $request->input('sort_order', 'desc');
        $searchQuery = '%'.$request->input('query').'%';
        $search_data = $request->input('query');
        $data = $this->orderByDate($worker_id,$searchQuery,$sortOrder);
  
        return view('worker.views.archive',['data' => $data, 'sort' => $sortOrder, 'search_data' => $search_data]);
    }

    public function searchNapomena(Request $request)
    {
        $worker_id = Helper::worker();
        $sortOrder = $request->input('sort_order', 'asc');
        $searchQuery = '%'.$request->input('query').'%';
        $search_data = $request->input('query');
        $data = $this->orderByDateNapomena($worker_id,$searchQuery,$sortOrder);
  
        return view('worker.views.archive',['data' => $data, 'sort' => $sortOrder, 'search_data_napomena' => $search_data]);
    }

    private function ponudaInfo($id, $worker_id){
        return Ponuda::where('ponuda_id', $id)->where('worker_id',$worker_id);
    }

    private function ponudaDate($id, $worker_id){
        return Ponuda_Date::where('id_ponuda', $id)->where('worker_id',$worker_id);
    }

    private function temporaryDesc($id){
        return Pozicija_Temporary::where('id_of_ponuda', $id)->delete();
    }

    private function temporaryTitle($id){
        return Title_Temporary::where('id_of_ponuda', $id)->delete();
    }
    private function ponudaId($worker, $id){
        return Ponuda::select('id', 'worker_id', 'ponuda_id')->where('worker_id', $worker)->where('ponuda_id', $id)->get();
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $worker_id = Helper::worker();
        foreach($this->ponudaId($worker_id,$id) as $toDel)
        {
            $this->temporaryDesc($toDel->id);
            $this->temporaryTitle($toDel->id);
        }
        $this->ponudaDate($id, $worker_id)->delete();
        $this->ponudaInfo($id, $worker_id)->delete();
        return redirect()->route('worker.archive');
    }

    public function deleteElement(Request $request)
    {
        $worker_id = Helper::worker();
        $id = $request->input('id');
        $ponuda_id = $request->input('real_id');
        $this->ponudaInfo($ponuda_id,$worker_id)->where('id', $id)->delete();
        $this->temporaryDesc($id);
        if($this->ponudaInfo($ponuda_id,$worker_id)->count()<1)
        {
            $this->ponudaDate($ponuda_id,$worker_id)->delete();
            return redirect()->route('worker.archive');
        }
        return $this->selectedArchive($ponuda_id);
    }
    
    private function mergedData(){
        $worker_id = Helper::worker();
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
                    'serv.name_service',
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
            ->where('ponuda.worker_id', $worker_id);
            
            return $ponuda;
    }

    public function selectedArchive($id)
    {
        $worker_id = Helper::worker();
        $mergedData = $this->mergedData()->where('ponuda.ponuda_id', intval($id))->get()->sortBy('ponuda.id');
        $ponuda_name = Ponuda_Date::select('ponuda_name', 'created_at', 'updated_at', 'opis', 'id_ponuda')->where('worker_id', $worker_id)->where('id_ponuda', $id)->first();
        
        return view('worker.views.archive-selected',['mergedData' => $mergedData, 'ponuda_name' => $ponuda_name]);
    }

    private function PDFname($id, $worker)
    {
        return Ponuda_Date::select('ponuda_name', 'opis')->where('worker_id', $worker)->where('id_ponuda', $id)->first();
    }

    public function viewPDF($id) {
        list($pdf, $pdf_name) = $this->PDFdata($id);
        return $pdf->stream($pdf_name->ponuda_name);
    }

    private function company_data($worker_id)
    {
        return Company_Data::where('worker_id', $worker_id)->first();
    }

    private function fizickaLica($worker)
    {
        return Fizicko_lice::where('worker_id', $worker)->get();
    }

    private function pravnaLica($worker)
    {
        return Pravno_lice::where('worker_id', $worker)->get();
    }

    private function selectedFizicka($worker, $id)
    {
        return Fizicko_lice::where('worker_id', $worker)->where('id', $id)->first();
    }
    private function selectedFizickaTemporary($worker, $id)
    {
        return Fizicko_lice_Temporary::where('worker_id', $worker)->where('id', $id)->first();
    }
    private function selectedPravna($worker, $id)
    {
        return Pravno_lice::where('worker_id', $worker)->where('id', $id)->first();
    }
    private function selectedPravnaTemporary($worker, $id)
    {
        return Pravno_lice_Temporary::where('worker_id', $worker)->where('id', $id)->first();
    }

    public function selectContact($id){

        return view('worker.views.generate-pdf.select-contact',['id' => $id]);
    }

    public function showLice($lice,$id)
    {
        if ($lice == 'individual') {
            return view('worker.views.generate-pdf.add-new-or-select-contact',['id' => $id, 'lice' => $lice, 'fizicka_lica' => $this->fizickaLica(Helper::worker())]);
        }

        if ($lice == 'legal-entity') {
            return view('worker.views.generate-pdf.add-new-or-select-contact',['id' => $id, 'lice' => $lice, 'pravna_lica' => $this->pravnaLica(Helper::worker())]);
        }
    }

    public function contactOrForm($lice,$method,$id)
    {
        if ($lice == 'individual' && $method == 'contact') {
            return view('worker.views.generate-pdf.fizicka-lica',['id' => $id, 'lice' => $lice, 'method' => $method, 'fizicka_lica' => $this->fizickaLica(Helper::worker())]);
        } elseif ($lice == 'individual' && $method == 'add_new') {
            return view('worker.views.generate-pdf.fizicka-lica',['id' => $id, 'lice' => $lice, 'method' => $method]);
        }

        if ($lice == 'legal-entity' && $method == 'contact') {
            return view('worker.views.generate-pdf.pravna-lica',['id' => $id, 'lice' => $lice, 'method' => $method, 'pravna_lica' => $this->pravnaLica(Helper::worker())]);
        } elseif ($lice == 'legal-entity' && $method == 'add_new') {
            return view('worker.views.generate-pdf.pravna-lica',['id' => $id, 'lice' => $lice, 'method' => $method]);
        }
    }

    public function submitContact(Request $request){
        if(isset($request->method) && $request->method == 'contact') {

            return view('worker.views.generate-pdf.select-tamplate',['client_id' => $request->fizicko_id, 'ponuda_id' => $request->ponuda_id, 'type' => 1]);

        } elseif(isset($request->method) && $request->method == 'add_new') {
            $f_name = $request->input('f_name');
            $l_name = $request->input('l_name');
            $grad = $request->input('grad');
            $postcode = $request->input('postcode');
            $adresa = $request->input('adresa');
            $email = $request->input('email');
            $tel = $request->input('tel'); 

            $data = $request->validate([
                'f_name' => 'required | max:30 | regex:/\p{L}/u',
                'l_name' => 'required | max:30 | regex:/\p{L}/u',
                'grad' => 'required | max:30 | regex:/\p{L}/u',
                'postcode' => 'required | max:10 | regex:/^[0-9]+$/',
                'adresa' => 'required | max:50 | regex:/\p{L}/u',
                'email' => 'required | email',
                'tel' => 'required | max:25 | regex:/^([0-9\s\-\+\(\)]*)$/'
            ],
            [
                '*.required' => trans("app.errors.profile-required"),
                'postcode.regex' => trans("app.errors.profile-only-numbers"),
                'email.email' => trans("app.errors.profile-email"),
            ]);

            if(isset($request->save))
                {
                    $client = Fizicko_lice::updateOrCreate(
                        [
                            'worker_id' => Helper::worker(),
                            'email' => $email
                        ],
                        [
                            'worker_id' => Helper::worker(),
                            'first_name' => $f_name,
                            'last_name' => $l_name,
                            'city' => $grad,
                            'zip_code' => $postcode,
                            'address' => $adresa,
                            'email' => $email,
                            'phone' => $tel,
                        ]
                    );
                    $temporary = false;
                    Alert::success('Uspešno dodato!')->showCloseButton()->showConfirmButton('Zatvori');
                }
            else{
                $client = Fizicko_lice_Temporary::updateOrCreate(
                    [
                        'worker_id' => Helper::worker()
                    ],
                    [
                        'first_name' => $f_name,
                        'last_name' => $l_name,
                        'city' => $grad,
                        'zip_code' => $postcode,
                        'address' => $adresa,
                        'email' => $email,
                        'tel' => $tel,
                    ]
                );
                $temporary = true;
            }
            return view('worker.views.generate-pdf.select-tamplate',
                    [   
                        'ponuda_id' => $request->ponuda_id,
                        'client_id' => $client->id ?? null,  
                        'temporary' => $temporary,
                        'type' => 1,
                    ]);
        }
        Alert::error('Nesto nije u redu')->showCloseButton()->showConfirmButton('Zatvori');
        return redirect()->back();
    }

    public function submitContactPravna(Request $request){
        if(isset($request->method) && $request->method == 'contact') {
            return view('worker.views.generate-pdf.select-tamplate',['client_id' => $request->pravno_id, 'ponuda_id' => $request->ponuda_id, 'type' => 2]);
        } elseif(isset($request->method) && $request->method == 'add_new') {
            $company_name = $request->input('company');
            $grad = $request->input('grad');
            $postcode = $request->input('postcode');
            $adresa = $request->input('adresa');
            $email = $request->input('email');
            $tel = $request->input('tel'); 
            $pib = $request->input('pib'); 

            $data = $request->validate([
                'company' => 'required | max:50 | regex:/\p{L}/u',
                'grad' => 'required | max:30 | regex:/\p{L}/u',
                'postcode' => 'required | max:10 | regex:/^[0-9]+$/',
                'adresa' => 'required | max:50 | regex:/\p{L}/u',
                'email' => 'required | email',
                'tel' => 'required | max:25 | regex:/^([0-9\s\-\+\(\)]*)$/',
                'pib' => 'max:30 | regex:/^[0-9\-]+$/',
             ],
             [
                '*.required' => trans("app.errors.profile-required"),
                'postcode.regex' => trans("app.errors.profile-only-numbers"),
                'email.email' => trans("app.errors.profile-email"),
                'pib.regex' => trans("app.errors.profile-only-numbers"),
             ]);

            if(isset($request->save))
            {
                $client = Pravno_lice::updateOrCreate(
                    [
                        'worker_id' => Helper::worker(),
                        'email' => $email
                    ],
                    [
                        'worker_id' => Helper::worker(),
                        'company_name' => $company_name,
                        'city' => $grad,
                        'zip_code' => $postcode,
                        'address' => $adresa,
                        'email' => $email,
                        'phone' => $tel,
                        'pib' => $pib,
                    ]
                );
                $temporary = false;
                Alert::success('Uspešno dodato!')->showCloseButton()->showConfirmButton('Zatvori');
            }
            else{
                $client = Pravno_lice_Temporary::updateOrCreate(
                    [
                        'worker_id' => Helper::worker()
                    ],
                    [
                        'worker_id' => Helper::worker(),
                        'company_name' => $company_name,
                        'city' => $grad,
                        'zip_code' => $postcode,
                        'address' => $adresa,
                        'email' => $email,
                        'tel' => $tel,
                        'pib' => $pib,
                    ]
                );
                $temporary = true;
            }

            return view('worker.views.generate-pdf.select-tamplate',
                    [ 
                        'ponuda_id' => $request->ponuda_id,
                        'type' => 2,
                        'client_id' => $client->id ?? null,  
                        'temporary' => $temporary,
                    ]);
        }
        Alert::error('Nesto nije u redu')->showCloseButton()->showConfirmButton('Zatvori');
        return redirect()->back();
    }

    public function redirctToGeneratePdf(Request $request) 
    {
        $request->validate([
            'ponuda_id' => 'required|numeric|gte:0',
            'client_id' => 'nullable|numeric|gte:0',
            'type' => 'required|in:1,2',
        ]);
        return view('worker.views.generate-pdf.generate-pdf-success',
                    [ 
                        'ponuda_id' => $request->ponuda_id,
                        'type' => $request->type,
                        'client_id' => $request->client_id,
                        'temp' => $request->temp ?? 'default',
                        'temporary' => $request->temporary,
                    ]);
    }

    public function tamplateGeneratePdf(Request $request) 
    {
        $request->validate([
            'ponuda_id' => 'required|numeric|gte:0',
            'client' => 'nullable|numeric|gte:0',
            'type' => 'required|in:1,2',
        ]);

        $worker_id = Helper::worker();
        $company_data = $this->company_data($worker_id) ?? null;
        $template = $request->temp ?? 'default';
        if($company_data === null && $template == "template-one")
            return redirect()->route('worker.personal.data');
        $pdf_blade = 'worker.pdf.'. $template;
        $id = $request->ponuda_id;
        $type_id = $request->type;
        $client_id = $request->client_id ?? null;
        $pdf_name = $this->PDFname($id,$worker_id);
        $selectedWorkerPonuda = $this->mergedData()->where('ponuda_id', $id)->get();
        $foundClient = null;
        if($request->skini)
        {
            if ($type_id && $client_id) {
                if($type_id == 1)
                {
                    if($request->temporary)
                    {
                        $foundClient = $this->selectedFizickaTemporary($worker_id, $client_id);
                    }
                    else
                    {
                        $foundClient = $this->selectedFizicka($worker_id, $client_id);
                    }
                }
                elseif($type_id == 2)
                {
                    if($request->temporary)
                    {
                        $foundClient = $this->selectedPravnaTemporary($worker_id, $client_id);
                    }
                    else
                    {
                        $foundClient = $this->selectedPravna($worker_id, $client_id);
                    }
                }
                else
                    return redirect()->route('worker.archive');
            }
            if(auth('worker')->user()->send_email_on_download)
            {
                //job
                $auto_msg = "This mail is autogenerated. Please do not respond.";
                $data = ['pdf_blade' => $pdf_blade, 'mergedData' => $selectedWorkerPonuda, 'ponuda_name' => $pdf_name->ponuda_name ?? "Ponuda", 'company' => $company_data, 'client' => $foundClient, 'type' => $type_id, 'opis' => $pdf_name->opis];
                $emailJob = (new SendEmail(auth('worker')->user()->email, null, null, $data, $pdf_name->ponuda_name, $auto_msg));
                dispatch($emailJob)->delay(\Carbon\Carbon::now()->addMinutes(1));
            }
            $pdf = PDF::loadView($pdf_blade,['mergedData' => $selectedWorkerPonuda, 'ponuda_name' => $pdf_name->ponuda_name ?? "Ponuda", 'company' => $company_data, 'client' => $foundClient, 'type' => $type_id, 'opis' => $pdf_name->opis]);
            if (isset($pdf_name->ponuda_name)) {
                return $pdf->download($pdf_name->ponuda_name . '.pdf');
            } else {
                return $pdf->download('Ponuda.pdf');
            }
        }
        elseif($request->posalji)
        {
            return view('worker.views.generate-pdf.send-with-mail',['name' => $pdf_name->ponuda_name ?? "Ponuda", 'id' => $id, 'client_id' => $client_id, 'type' => $type_id, 'temporary' => $request->temporary, 'pdf_blade' => $pdf_blade]);
        }
        elseif($request->ugovor)
        {
            $sum = 0;
            foreach($selectedWorkerPonuda as $ponuda)
            {
                $sum += $ponuda->overall_price;
            }
            if ($type_id && $client_id) {
                $type_lica = null;
                if($type_id == 1)
                {
                    if($request->temporary)
                    {
                        $foundClient = $this->selectedFizickaTemporary($worker_id, $client_id);
                        $type_lica = 'FT';
                    }
                    else
                    {
                        $foundClient = $this->selectedFizicka($worker_id, $client_id);
                        $type_lica = 'F';
                    }
                }
                elseif($type_id == 2)
                {
                    if($request->temporary)
                    {
                        $foundClient = $this->selectedPravnaTemporary($worker_id, $client_id);
                        $type_lica = 'PT';
                    }
                    else
                    {
                        $foundClient = $this->selectedPravna($worker_id, $client_id);
                        $type_lica = 'P';
                    }
                }
                else {
                    return redirect()->route('worker.archive');
                }

                if($company_data == null) {
                    return redirect()->route('worker.archive');
                }

                $pdv = $sum * 0.2;
                $sum += $pdv;
                $sum = ceil($sum);
                $digit = new \NumberFormatter('sr_Latn_RS', \NumberFormatter::SPELLOUT);
                $sum_in_words = $digit->format($sum);

                $pdf = PDF::loadView('worker.pdf.contract', compact(['foundClient', 'company_data', 'type_lica', 'id', 'sum', 'sum_in_words']));
                return $pdf->download('contract' . '.pdf');
            }
            return redirect()->route('worker.archive');
        }
    }

    public function sendPDF(Request $request)
    {
        $request->validate([
            'mailTo' => 'required|string|email:rfc|max:255',
            'mailSubject' => 'nullable|string|max:64',
            'mailBody' => 'nullable|string|max:1024',
            'id' => 'required|numeric|gte:0',
            'client' => 'nullable|numeric|gte:0',
            'type' => 'required|in:1,2',
        ]);

        $worker_id = Helper::worker();
        $company_data = $this->company_data($worker_id) ?? null;
        $pdf_blade = $request->pdf;
        $id = $request->id;
        $type_id = $request->type;
        $client_id = $request->client_id ?? null;
        $pdf_name = $this->PDFname($id,$worker_id);
        $selectedWorkerPonuda = $this->mergedData()->where('ponuda_id', $id)->get();
        $foundClient = null;

        if ($type_id && $client_id) {
            if($type_id == 1)
            {
                if($request->temporary)
                {
                    $foundClient = $this->selectedFizickaTemporary($worker_id, $client_id);
                }
                else
                {
                    $foundClient = $this->selectedFizicka($worker_id, $client_id);
                }
            }
            elseif($type_id == 2)
            {
                if($request->temporary)
                {
                    $foundClient = $this->selectedPravnaTemporary($worker_id, $client_id);
                }
                else
                {
                    $foundClient = $this->selectedPravna($worker_id, $client_id);
                }
            }
            else
                return redirect()->back();
        }

        $auto_msg = "This mail is autogenerated and has been sent by ".auth('worker')->user()->email." . Please do not respond.";
        $dataPDF = ['pdf_blade' => $pdf_blade, 'mergedData' => $selectedWorkerPonuda, 'ponuda_name' => $pdf_name->ponuda_name ?? "Ponuda", 'company' => $company_data, 'client' => $foundClient, 'type' => $type_id, 'opis' => $pdf_name->opis];
        $emailJobFirst = (new SendEmail($request->mailTo, $request->mailSubject, $request->mailBody, $dataPDF, $pdf_name->ponuda_name, $auto_msg));
        dispatch($emailJobFirst);
        if(auth('worker')->user()->send_email_on_send)
        {
            $auto_msg = "This mail is autogenerated. You sent this email to ".$request->mailTo." . Please do not respond.";
            $emailJobSecond = (new SendEmail(auth('worker')->user()->email, $request->mailSubject, $request->mailBody, $dataPDF, $pdf_name->ponuda_name, $auto_msg));
            dispatch($emailJobSecond);
        }
        Alert::success('Uspešno poslato!')->showCloseButton()->showConfirmButton('Zatvori');
        return redirect()->route('worker.archive');
    }

    private function PDFdata($id)
    {
        $worker_id = Helper::worker();
        if(is_numeric($id) && $id > 0)
        {
            $selectedWorkerPonuda = $this->mergedData()->where('ponuda_id', $id)->get() ?? null;
            $pdf_name = $this->PDFname($id,$worker_id);
            $pdf = PDF::loadView('worker.pdf.default',['mergedData' => $selectedWorkerPonuda, 'ponuda_name' => $pdf_name->ponuda_name, 'opis' => $pdf_name->opis]);
            return array($pdf, $pdf_name);
        }
        return redirect()->back();
    }

    public function editPonuda($ponuda_id){
        if($this->editPonudaCheck($ponuda_id))
        {
            return redirect()->route('worker.new.ponuda');
        }
        return redirect()->back();
    }

    private function editPonudaCheck($ponuda_id)
    {
        $workerId = Helper::worker();
        try {
            $worker = Worker::select('id', 'ponuda_counter')->where('id', $workerId)->firstOrFail();
            $ponuda_date = Ponuda_Date::where('worker_id', $workerId)->where('id_ponuda', $ponuda_id)->firstOrFail();
        } catch (ModelNotFoundException) {
            Alert::error('Ponuda nije pronađena ili niste prijavljeni.')->showCloseButton()->showConfirmButton('Zatvori');
            return false;
        }        
        Swap::where('worker_id', $workerId)->delete();

        Swap::create([
            'worker_id' => $workerId,
            'original_id' => $worker->ponuda_counter,
            'swap_id' => $ponuda_id,
            'temp_ponuda_name' => $ponuda_date->ponuda_name,
            'temp_opis' => $ponuda_date->opis,
            'temp_note' => $ponuda_date->note,
        ]);
        Worker::where('id', $workerId)->update(['ponuda_counter' => $ponuda_id]);
        return true;
    }

    public function FizickaLicaUgovor(Request $request)
    {
        $client_id = $request->client_id ?? null;
        $worker_id = Helper::worker();
        $company_data = $this->company_data($worker_id) ?? null;
        $type_id = $request->type;
        $id = $request->ponuda_id;
        $selectedWorkerPonuda = $this->mergedData()->where('ponuda_id', $id)->get();
        $foundClient = null;
        $sum = 0;
            foreach($selectedWorkerPonuda as $ponuda)
            {
                $sum += $ponuda->overall_price;
            }
            if ($type_id && $client_id) {
                $type_lica = null;
                if($type_id == 1)
                {
                    if($request->temporary)
                    {
                        $foundClient = $this->selectedFizickaTemporary($worker_id, $client_id);
                        $type_lica = 'FT';
                    }
                    else
                    {
                        $foundClient = $this->selectedFizicka($worker_id, $client_id);
                        $type_lica = 'F';
                    }
                }
                elseif($type_id == 2)
                {
                    if($request->temporary)
                    {
                        $foundClient = $this->selectedPravnaTemporary($worker_id, $client_id);
                        $type_lica = 'PT';
                    }
                    else
                    {
                        $foundClient = $this->selectedPravna($worker_id, $client_id);
                        $type_lica = 'P';
                    }
                }
                else {
                    return redirect()->route('worker.archive');
                }

                if($company_data == null) {
                    Alert::warning('Izpunite podate kompanije prvo')->showCloseButton()->showConfirmButton('Zatvori');
                    return redirect()->route('worker.personal.data');
                }

                $pdv = $sum * 0.2;
                $sum += $pdv;
                $sum = ceil($sum);
                $digit = new \NumberFormatter('sr_Latn_RS', \NumberFormatter::SPELLOUT);
                $sum_in_words = $digit->format($sum);
            }
        return view('worker.views.generate-pdf.fill-up-contract-fizicko-lice', compact(['foundClient', 'company_data', 'type_lica', 'id', 'sum', 'sum_in_words']));
    }

    public function FizickaLicaUgovorGeneratePDF(Request $request)
    {
        
        $ugovorBr = $request->br;
        $field1 = $request->field1;
        $field2 = $request->field2;
        $field3 = $request->field3;
        $field4 = $request->field4;
        $field5 = $request->field5;
        $field6 = $request->field6;
        $field7 = $request->field7;
        $field8 = $request->field8;
        $field9 = $request->field9;
        $field10 = $request->field10;
        $field11 = $request->field11;
        $field12 = $request->field12;
        $field13 = $request->field13;
        $field14 = $request->field14;
        $field15 = $request->field15;
        $field16 = $request->field16;
        $field17 = $request->field17;
        $field18 = $request->field18;
        $field19 = $request->field19;
        $field20 = $request->field20;
        $field21 = $request->field21;
        $field22 = $request->field22;
        $field23 = $request->field23;
        $field24 = $request->field24;
        $field25 = $request->field25;
        $field26 = $request->field26;

        $pdf = PDF::loadView('worker.pdf.contract-individual', 
        compact([
            'field1',
            'field2',
            'field3',
            'field4',
            'field5',
            'field6',
            'field7',
            'field8',
            'field9',
            'field10',
            'field11',
            'field12',
            'field13',
            'field14',
            'field15',
            'field16',
            'field17',
            'field18',
            'field19',
            'field20',
            'field21',
            'field22',
            'field23',
            'field24',
            'field25',
            'field26',
            'ugovorBr'
        ]));
        return $pdf->download('Ugovor.pdf');
    }
}
