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

class Archive extends Controller
{
    private function worker()
    {
        if (Auth::guard('worker')->check()) {
            return Auth::guard('worker')->user()->id;
        }
        return null;
    }
    
    private function showPrivate($worker){
        return Ponuda_Date::where('worker_id', $worker)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function show()
    {
        $worker_id = $this->worker();
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
        $worker_id = $this->worker();
        $sortOrder = $request->input('sort_order', 'asc');
        $searchQuery = '%'.$request->input('query').'%';
        $search_data = $request->input('query');
        $data = $this->orderByDate($worker_id,$searchQuery,$sortOrder);
  
        return view('worker.views.archive',['data' => $data, 'sort' => $sortOrder, 'search_data' => $search_data]);
    }

    public function searchNapomena(Request $request)
    {
        $worker_id = $this->worker();
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
        $worker_id = $this->worker();
        foreach($this->ponudaId($worker_id,$id) as $toDel)
        {
            $this->temporaryDesc($toDel->id);
            $this->temporaryTitle($toDel->id);
        }
        $this->ponudaDate($id, $worker_id)->delete();
        $this->ponudaInfo($id, $worker_id)->delete();
        return redirect()->intended(route('worker.archive'));
    }

    public function deleteElement(Request $request)
    {
        $worker_id = $this->worker();
        $id = $request->input('id');
        $ponuda_id = $request->input('real_id');
        $this->ponudaInfo($ponuda_id,$worker_id)->where('id', $id)->delete();
        $this->temporaryDesc($id);
        if($this->ponudaInfo($ponuda_id,$worker_id)->count()<1)
        {
            $this->ponudaDate($ponuda_id,$worker_id)->delete();
            return redirect()->intended(route('worker.archive'));
        }
        return $this->selectedArchive($ponuda_id);
    }
    
    private function mergedData(){
        $worker_id = $this->worker();
        $ponuda = Ponuda::select(
            'ponuda.id', 'ponuda.worker_id', 'ponuda.ponuda_id', 'ponuda.categories_id', 'ponuda.subcategories_id',
            'ponuda.pozicija_id', 'ponuda.quantity', 'ponuda.unit_price', 'ponuda.overall_price',
            'c.id AS id_category', 'c.name AS name_category', 's.id AS id_subcategory',
            's.name AS name_subcategory', 'poz.id AS id_pozicija', 'poz.unit_id',
            'poz.title', 'poz.description', 'pd.worker_id', 'pd.id_ponuda',
            'pd.note', 'pd.opis', 'pd.created_at', 'pd.updated_at', 'u.id_unit', 'u.name AS unit_name',
            'temp.id_of_ponuda', 'temp.temporary_description', 'title.id_of_ponuda',
            'title.temporary_title', 'serv.id_service', 'serv.name_service'
        )
        ->join('categories as c', 'ponuda.categories_id', '=', 'c.id')
        ->join('subcategories as s', 'ponuda.subcategories_id', '=', 's.id')
        ->join('pozicija as poz', 'ponuda.pozicija_id', '=', 'poz.id')
        ->join('ponuda_date as pd', 'pd.id_ponuda', '=', 'ponuda.ponuda_id')
        ->join('units as u', 'poz.unit_id', '=', 'u.id_unit')
        ->leftJoin('pozicija_temporary as temp', 'ponuda.id', '=', 'temp.id_of_ponuda')
        ->leftJoin('title_temporary as title', 'ponuda.id', '=', 'title.id_of_ponuda')
        ->join('services as serv', 'ponuda.service_id', '=', 'serv.id_service')
        ->where('ponuda.worker_id', $worker_id)
        ->get();
        $custom_ponuda = Ponuda::select(
            'ponuda.id', 'ponuda.worker_id', 'ponuda.ponuda_id', 'ponuda.categories_id', 'ponuda.subcategories_id',
            'ponuda.pozicija_id', 'ponuda.quantity', 'ponuda.unit_price', 'ponuda.overall_price',
            'c.id AS id_category', 'c.name AS name_custom_category', 's.id AS id_custom_subcategory',
            's.name AS name_custom_subcategory', 'poz.id AS id_custom_pozicija', 'poz.unit_id',
            'poz.custom_title', 'poz.custom_description', 'pd.worker_id', 'pd.id_ponuda',
            'pd.note', 'pd.opis', 'pd.created_at', 'u.id_unit', 'u.name AS unit_name',
            's.is_subcategory_deleted', 'c.is_category_deleted', 'poz.is_pozicija_deleted',
            'temp.id_of_ponuda', 'temp.temporary_description', 'title.id_of_ponuda',
            'title.temporary_title', 'serv.id_service', 'serv.name_service'
        )
        ->join('custom_categories as c', 'ponuda.categories_id', '=', 'c.id')
        ->join('custom_subcategories as s', 'ponuda.subcategories_id', '=', 's.id')
        ->join('custom_pozicija as poz', 'ponuda.pozicija_id', '=', 'poz.id')
        ->join('ponuda_date as pd', 'pd.id_ponuda', '=', 'ponuda.ponuda_id')
        ->join('units as u', 'poz.unit_id', '=', 'u.id_unit')
        ->leftJoin('pozicija_temporary as temp', 'ponuda.id', '=', 'temp.id_of_ponuda')
        ->leftJoin('title_temporary as title', 'ponuda.id', '=', 'title.id_of_ponuda')
        ->join('services as serv', 'ponuda.service_id', '=', 'serv.id_service')
        ->where('ponuda.worker_id', $worker_id)
        ->get();

        $mergedData = $ponuda->concat($custom_ponuda);

        return $mergedData;
    }

    public function selectedArchive($id)
    {
        $worker_id = $this->worker();
        $mergedData = $this->mergedData();
        // usort($mergedData, function($a, $b) {
        //     return $a->id - $b->id;
        // });
        $collection = collect($mergedData);
        $selected_ponuda = $collection->where('ponuda_id', intval($id));
        $selectedWorkerPonuda = $selected_ponuda->where('worker_id', $worker_id);
        $ponuda_name = Ponuda_Date::select('ponuda_name')->where('id_ponuda', $id)->first();
        
        return view('worker.views.archive-selected',['mergedData' => $selectedWorkerPonuda->all(), 'ponuda_name' => $ponuda_name]);
    }

    private function PDFname($id, $worker)
    {
        return Ponuda_Date::select('ponuda_name')->where('id_ponuda', $id)->where('worker_id', $worker)->first();
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
        return view('worker.views.fizicka_lica',['id' => $id, 'fizicka_lica' => $this->fizickaLica($this->worker())]);
    }

    public function showPravna($id)
    {
        return view('worker.views.pravna_lica',['id' => $id, 'pravna_lica' => $this->pravnaLica($this->worker())]);
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

            $data = Validator::make([
                'f_name' => $f_name,
                'l_name' => $l_name,
                'grad' => $grad,
                'adresa' => $adresa,
                'postcode' => $postcode,
                'email' => $email,
                'tel' => $tel,
            ],[
                'f_name' => 'required|regex:/^[a-zA-Z\s ]*$/',
                'l_name' => 'required|regex:/^[a-zA-Z\s ]*$/',
                'grad' => 'required|regex:/^[a-zA-Z\s ]*$/',
                'adresa' => 'required|regex:/^[a-zA-Z0-9\s ]*$/',
                'postcode' => 'required|regex:/^[0-9\s]+$/i',
                'email' => 'required|email',
                'tel' => 'required|regex:/^[0-9\s]+$/i',
            ]);
    
            if ($data->fails()) {
                $error = implode("\n", $data->errors()->all());
                alert()->error($error)->showCloseButton()->showConfirmButton('Zatvori');
                return redirect()->back();
            }

            if(isset($request->save))
            {
                $client = Fizicko_lice::create(
                    [
                        'worker_id' => $this->worker(),
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
                    ['worker_id' => $this->worker()],
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

            $data = Validator::make([
                'company' => $company_name,
                'grad' => $grad,
                'adresa' => $adresa,
                'postcode' => $postcode,
                'email' => $email,
                'tel' => $tel,
                'pib' => $pib,
            ],[
                //majd meg kell csinalni rendesen a validacot ahogy a workercontrollerbe csak most quick fix kent kivettem higy a Zorannak ne dobjon errort
                'company' => 'required',
                'grad' => 'required',
                'adresa' => 'required',
                'postcode' => 'required',
                'email' => 'required|email',
                'tel' => 'required',
                'pib' => 'required',
            ]);
    
            if ($data->fails()) {
                $error = implode("\n", $data->errors()->all());
                alert()->error($error)->showCloseButton()->showConfirmButton('Zatvori');
                return redirect()->back();
            }

            if(isset($request->save))
            {
                $client = Pravno_lice::create(
                    [
                        'worker_id' => $this->worker(),
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
                    ['worker_id' => $this->worker()],
                    [
                        'worker_id' => $this->worker(),
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
        $worker_id = $this->worker();
        $company_data = $this->company_data($worker_id) ?? null;
        $template = $request->temp;
        if($company_data === null && $template == "template-one")
            return redirect()->intended(route('worker.personal.data'));
        $pdf_blade = 'worker.pdf.'. $template;
        $id = $request->ponuda_id;
        $selectedWorkerPonuda = null;
        if(is_numeric($id) && $id > 0)
            $selectedWorkerPonuda = $this->mergedData()->where('ponuda_id', $id)->where('worker_id', $worker_id)->all();
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
            $pdf = PDF::loadView($pdf_blade,['mergedData' => $selectedWorkerPonuda, 'ponuda_name' => $pdf_name->ponuda_name ?? "Ponuda", 'company' => $company_data, 'client' => $foundClient, 'type' => $type_id]);
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
        $worker_id = $this->worker();
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
            $selectedWorkerPonuda = $this->mergedData()->where('ponuda_id', $id)->where('worker_id', $worker_id)->all();
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
        $pdf = PDF::loadView($pdf_blade,['mergedData' => $selectedWorkerPonuda, 'ponuda_name' => $pdf_name->ponuda_name ?? "Ponuda", 'company' => $company_data, 'client' => $foundClient, 'type' => $type_id]);
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
            Alert::success('Uspesno poslato!')->showCloseButton()->showConfirmButton('Zatvori');
            return redirect()->intended(route('worker.archive'));
        }
        Alert::error('Max 10 MB')->showCloseButton()->showConfirmButton('Zatvori');
        return redirect()->intended(route('worker.archive'));
    }

    private function PDFdata($id)
    {
        $worker_id = $this->worker();
        if(is_numeric($id) && $id > 0)
        {
            $selectedWorkerPonuda = $this->mergedData()->where('ponuda_id', $id)->where('worker_id', $worker_id)->all() ?? null;
            $pdf_name = $this->PDFname($id,$worker_id);
            $pdf = PDF::loadView('worker.pdf.default',['mergedData' => $selectedWorkerPonuda, 'ponuda_name' => $pdf_name->ponuda_name ]);
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
        $workerId = $this->worker();
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
