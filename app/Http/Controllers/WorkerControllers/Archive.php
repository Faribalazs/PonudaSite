<?php

namespace App\Http\Controllers\WorkerControllers;

use App\Models\{Swap, Ponuda, Ponuda_Date, Pozicija_Temporary, Title_Temporary, Worker, Fizicko_lice, Pravno_lice, Company_Data, Fizicko_lice_Temporary, Pravno_lice_Temporary};
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\Helper;

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
        $sortOrder = $request->input('sort_order', 'asc');
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

    private function company_data($worker)
    {
        return Company_Data::where('worker_id', $worker)->first();
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

        return view('worker.views.select-contact',['id' => $id]);
    }

    public function showFizicka($id)
    {
        return view('worker.views.fizicka_lica',['id' => $id, 'fizicka_lica' => $this->fizickaLica(Helper::worker())]);
    }

    public function showPravna($id)
    {
        return view('worker.views.pravna_lica',['id' => $id, 'pravna_lica' => $this->pravnaLica(Helper::worker())]);
    }

    public function submitContact(Request $request){
        if(isset($request->selectedFizicko)) {

            return view('worker.views.select-tamplate',['client_id' => $request->selectedFizicko, 'ponuda_id' => $request->ponuda_id, 'type' => 1]);

        } else {
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
                $client = Fizicko_lice::create(
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
            }
            else{
                $client = Fizicko_lice_Temporary::updateOrCreate(
                    ['worker_id' => Helper::worker()],
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

            return view('worker.views.select-tamplate',
                    [   
                        'ponuda_id' => $request->ponuda_id,
                        'client_id' => $client->id ?? null,  
                        'temporary' => $temporary,
                        'type' => 1,
                    ]);
        }
        return redirect()->back();
    }

    public function submitContactPravna(Request $request){
        if(isset($request->selectedPravno) && isset($request->ponuda_id)) {
            return view('worker.views.select-tamplate',['client_id' => $request->selectedPravno, 'ponuda_id' => $request->ponuda_id, 'type' => 2]);
        } else {
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
                $client = Pravno_lice::create(
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
            }
            else{
                $client = Pravno_lice_Temporary::updateOrCreate(
                    ['worker_id' => Helper::worker()],
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

            return view('worker.views.select-tamplate',
                    [ 
                        'ponuda_id' => $request->ponuda_id,
                        'type' => 2,
                        'client_id' => $client->id ?? null,  
                        'temporary' => $temporary,
                    ]);
        }
    }

    public function tamplateGeneratePdf(Request $request) 
    {
        $worker_id = Helper::worker();
        $company_data = $this->company_data($worker_id) ?? null;
        $template = $request->temp;
        if($company_data === null && $template == "template-one")
            return redirect()->route('worker.personal.data');
        $pdf_blade = 'worker.pdf.'. $template;
        $id = $request->ponuda_id;
        $selectedWorkerPonuda = null;
        if(is_numeric($id) && $id > 0)
            $selectedWorkerPonuda = $this->mergedData()->where('ponuda_id', $id)->get();
        else
            return redirect()->back();
        $foundClient = null;
        $type_id = $request->type ?? null;
        $client_id = $request->client_id ?? null;
        $pdf_name = $this->PDFname($id,$worker_id);
        if($request->skini)
        {
            if ($type_id && $client_id) {
                if(is_numeric($type_id) && is_numeric($client_id))
                {
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
                else
                    return redirect()->back();
            }
            $pdf = PDF::loadView($pdf_blade,['mergedData' => $selectedWorkerPonuda, 'ponuda_name' => $pdf_name->ponuda_name ?? "Ponuda", 'company' => $company_data, 'client' => $foundClient, 'type' => $type_id, 'opis' => $pdf_name->opis]);
            if(auth('worker')->user()->send_email_on_download)
            {
                Mail::send('worker.emails.send_pdf',['mailSubject' => $pdf_name->ponuda_name ?? "Ponudamajstora"], function ($message) use ($pdf, $pdf_name) {
                    $message->from('ponudamajstora@gmail.com');
                    $message->to(auth('worker')->user()->email);
                    $message->subject($pdf_name->ponuda_name ?? "Ponudamajstora");
                    $message->attachData($pdf->output(),$pdf_name->ponuda_name . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
                });
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
            return view('worker.views.mail-send',['name' => $pdf_name->ponuda_name ?? "ponuda", 'id' => $id, 'client_id' => $client_id, 'type' => $type_id, 'temporary' => $request->temporary, 'pdf_blade' => $pdf_blade]);
        }
    }
    // redirektelni kell miutan letoti a pdf a sucessra
    public function generatePdfSuccess(Request $request){
        return view('worker.views.generate-pdf-success');
    }
    // redirektelni kell miutan letoti a pdf a sucessra end
    public function sendPDF(Request $request)
    {
        $request->validate([
            'mailTo' => 'required|string|email:rfc|max:255',
            'mailSubject' => 'nullable|string|max:64',
            'mailBody' => 'nullable|string|max:1024',
        ]);
        $worker_id = Helper::worker();
        $data["mailFrom"] = auth('worker')->user()->email;
        $data["mailTo"] = $request->mailTo;
        $data["mailSubject"] = $request->mailSubject;
        $data["mailBody"] = $request->mailBody;
        $company_data = $this->company_data($worker_id) ?? null;
        $pdf_blade = $request->pdf;
        $id = $request->id;
        $pdf_name = $this->PDFname($id,$worker_id);
        $selectedWorkerPonuda = null;
        if(is_numeric($id) && $id > 0)
            $selectedWorkerPonuda = $this->mergedData()->where('ponuda_id', $id)->get();
        else
            return redirect()->back();
        $foundClient = null;
        $type_id = $request->type ?? null;
        $client_id = $request->client ?? null;
        if ($type_id && $client_id) {
            if(is_numeric($type_id) && is_numeric($client_id))
            {
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
            else
                return redirect()->back();
        }
        $pdf = PDF::loadView($pdf_blade,['mergedData' => $selectedWorkerPonuda, 'ponuda_name' => $pdf_name->ponuda_name ?? "Ponuda", 'company' => $company_data, 'client' => $foundClient, 'type' => $type_id, 'opis' => $pdf_name->opis]);
        $pdfContent = $pdf->output();
        $pdfSize = strlen($pdfContent);
        if($pdfSize < 10485760)
        {
            Mail::send('worker.emails.send_pdf', $data, function ($message) use ($data,$pdfContent, $pdf_name) {
                $message->from($data["mailFrom"]);
                $message->to($data["mailTo"]);
                $message->subject($data["mailSubject"] ?? 'PDF ponuda');
                $message->attachData($pdfContent,$pdf_name->ponuda_name . '.pdf', [
                    'mime' => 'application/pdf',
                ]);
            });
            if(auth('worker')->user()->send_email_on_send)
            {
                Mail::send('worker.emails.send_pdf', $data, function ($message) use ($data,$pdfContent, $pdf_name) {
                    $message->from('ponudamajstora@gmail.com');
                    $message->to(auth('worker')->user()->email);
                    $message->subject($data["mailSubject"] ?? 'PDF ponuda');
                    $message->attachData($pdfContent,$pdf_name->ponuda_name . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
                });
            }
            Alert::success('Uspesno poslato!')->showCloseButton()->showConfirmButton('Zatvori');
            return redirect()->route('worker.archive');
        }
        Alert::error('Max 10 MB')->showCloseButton()->showConfirmButton('Zatvori');
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
}
