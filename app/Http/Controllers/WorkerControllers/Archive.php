<?php

namespace App\Http\Controllers\WorkerControllers;

use Mail;
use App\Models\Swap;
use App\Models\Ponuda;
use App\Models\Ponuda_Date;
use App\Models\Pozicija_Temporary;
use App\Models\Title_Temporary;
use App\Models\Worker;
use App\Models\Fizicko_lice;
use App\Models\Pravno_lice;
use App\Models\Company_Data;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use RealRashid\SweetAlert\Facades\Alert;

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
        if(count($this->returnBack())>0)
        {
            return redirect()->intended(route('worker.new.ponuda'));
        }
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
        if(count($this->returnBack())>0)
        {
            return redirect()->intended(route('worker.new.ponuda'));
        }
        $worker_id = $this->worker();
        $sortOrder = $request->input('sort_order', 'asc');
        $searchQuery = '%'.$request->input('query').'%';
        $search_data = $request->input('query');
        $data = $this->orderByDate($worker_id,$searchQuery,$sortOrder);
  
        return view('worker.views.archive',['data' => $data, 'sort' => $sortOrder, 'search_data' => $search_data]);
    }

    public function searchNapomena(Request $request)
    {
        if(count($this->returnBack())>0)
        {
            return redirect()->intended(route('worker.new.ponuda'));
        }
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

    public function delete($id)
    {
        if(count($this->returnBack())>0)
        {
            return redirect()->intended(route('worker.new.ponuda'));
        }
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

    public function deleteElement($id,$ponuda_id)
    {
        if(count($this->returnBack())>0)
        {
            return redirect()->intended(route('worker.new.ponuda'));
        }
        $worker_id = $this->worker();
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
            'pd.note', 'pd.opis', 'pd.created_at', 'u.id_unit', 'u.name AS unit_name',
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

        $mergedData = $ponuda->concat($custom_ponuda);;

        return $mergedData;
    }

    public function selectedArchive($id)
    {
        if(count($this->returnBack())>0)
        {
            return redirect()->intended(route('worker.new.ponuda'));
        }
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

    public function createMAIL($id)
    {
        if(count($this->returnBack())>0)
        {
            return redirect()->intended(route('worker.new.ponuda'));
        }
        $name = Ponuda_Date::select('ponuda_name')->where('id_ponuda', $id)->get();
        return view('worker.views.mail-send',['id_archive' => $id , 'name' => $name]);
    }

    public function createPDF($id) {
        if(count($this->returnBack())>0)
        {
            return redirect()->intended(route('worker.new.ponuda'));
        }
        list($pdf, $pdf_name) = $this->PDFdata($id);
        return $pdf->download($pdf_name->ponuda_name . '.pdf');
    }

    public function viewPDF($id) {
        if(count($this->returnBack())>0)
        {
            return redirect()->intended(route('worker.new.ponuda'));
        }
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
    private function selectedPravna($worker, $id)
    {
        return Pravno_lice::where('worker_id', $worker)->where('id', $id)->first();
    }

    public function selectContact($id){

        return view('worker.views.select-contact',['ponuda_id' => $id]);
    }

    public function showFizicka($id)
    {
        return view('worker.views.fizicka_lica',['ponuda_id' => $id, 'fizicka_lica' => $this->fizickaLica($this->worker())]);
    }

    public function showPravna($id)
    {
        return view('worker.views.pravna_lica',['ponuda_id' => $id, 'pravna_lica' => $this->pravnaLica($this->worker())]);
    }

    public function submitContact(Request $request){
        if(isset($request->selectedFizicko)) {

            return view('worker.views.select-tamplate',['client_id' => $request->selectedFizicko, 'ponuda_id' => $request->ponuda_id, 'type' => 1]);

        } else {
            $f_name = $request->f_name;
            $l_name = $request->l_name;
            $grad = $request->grad;
            $postcode = $request->postcode;
            $adresa = $request->adresa;
            $email = $request->email;
            $tel = $request->tel; 

            $ifexist = Fizicko_lice::where('worker_id', $this->worker())
                ->where('first_name', $f_name)
                ->where('last_name', $l_name)
                ->where('city', $grad)
                ->where('zip_code', $postcode)
                ->where('address', $adresa)
                ->where('email', $email)
                ->where('tel', $tel)
                ->get();

            if(isset($request->save) && $ifexist->isEmpty()) { 
                $client = new Fizicko_lice();
                $client->worker_id = $this->worker();
                $client->first_name = $f_name;
                $client->last_name = $l_name;
                $client->city = $grad;
                $client->zip_code = $postcode;
                $client->address = $adresa;
                $client->email = $email;
                $client->tel = $tel;
                $client->save();
            }

            return view('worker.views.select-tamplate',
                    [ 'ponuda_id' => $request->ponuda_id,
                      'f_name' => $f_name,
                      'l_name' => $l_name,
                      'city' => $grad,
                      'zip' => $postcode,
                      'adresa' => $adresa,
                      'email' => $email,
                      'tel' => $tel,
                      'type' => 1,
                      'new' => "custom",  
                    ]);
        }
    }

    public function submitContactPravna(Request $request){
        if(isset($request->selectedPravno)) {
            return view('worker.views.select-tamplate',['client_id' => $request->selectedPravno, 'ponuda_id' => $request->ponuda_id, 'type' => 2]);

        } else {
            $company_name = $request->company;
            $grad = $request->grad;
            $postcode = $request->postcode;
            $adresa = $request->adresa;
            $email = $request->email;
            $tel = $request->tel; 
            $pib = $request->pib; 

            $ifexist = Pravno_lice::where('worker_id', $this->worker())
                ->where('company_name', $company_name)
                ->where('city', $grad)
                ->where('zip_code', $postcode)
                ->where('address', $adresa)
                ->where('email', $email)
                ->where('tel', $tel)
                ->where('pib', $pib)
                ->get();

            if(isset($request->save) && $ifexist->isEmpty()) { 
                $client = new Pravno_lice();
                $client->worker_id = $this->worker();
                $client->company_name = $company_name;
                $client->city = $grad;
                $client->zip_code = $postcode;
                $client->address = $adresa;
                $client->email = $email;
                $client->tel = $tel;
                $client->pib = $pib;
                $client->save();
            }

            return view('worker.views.select-tamplate',
                    [ 'ponuda_id' => $request->ponuda_id,
                      'company_name' => $company_name,
                      'city' => $grad,
                      'zip' => $postcode,
                      'adresa' => $adresa,
                      'email' => $email,
                      'tel' => $tel,
                      'pib' => $pib,
                      'type' => 2,
                      'new' => "custom",  
                    ]);
        }
    }

    public function tamplateGeneratePdf(Request $request) 
    {
        // dd($request->temp);
        $worker_id = $this->worker();
        $company_data = empty($this->company_data($worker_id))?null:$this->company_data($worker_id);
        $template = $request->temp;
        if($company_data === null && $template == "template-one")
            return redirect()->intended(route('worker.personal.data'));
        $pdf_blade = 'worker.pdf.'. $template;
        $id = $request->ponuda_id;
        $mergedData = $this->mergedData();
        $collection = collect($mergedData);
        $selected_ponuda = $collection->where('ponuda_id', intval($id));
        $selectedWorkerPonuda = $selected_ponuda->where('worker_id', $worker_id);
        $foundClient = null;
        if (isset($request->client_id) && isset($request->type)) {
            if($request->type == 1)
                $foundClient = $this->selectedFizicka($worker_id, $request->client_id);
            elseif($request->type == 2)
                $foundClient = $this->selectedPravna($worker_id, $request->client_id);
            else
                return redirect()->intended(route('home'));
        }
        $pdf_name = $this->PDFname($id,$worker_id);
        if(isset($request->new)) {
            $pdf = PDF::loadView($pdf_blade,
                ['mergedData' => $selectedWorkerPonuda->all(), 
                'ponuda_name' => $pdf_name->ponuda_name, 
                'company' => $company_data,
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'city' => $request->city,
                'zip' => $request->zip,
                'adresa' => $request->adresa,
                'email' => $request->email,
                'tel' => $request->tel,
                'new' => "custom",
                ]);
        } else {
            $pdf = PDF::loadView($pdf_blade,['mergedData' => $selectedWorkerPonuda->all(), 'ponuda_name' => $pdf_name->ponuda_name, 'company' => $company_data, 'client' => $foundClient, 'type' => isset($request->type)?$request->type:null]);
        }

        return $pdf->download($pdf_name->ponuda_name . '.pdf');
    }
    // redirektelni kell miutan letoti a pdf a sucessra
    public function generatePdfSuccess(Request $request){
        return view('worker.views.generate-pdf-success');
    }
    // redirektelni kell miutan letoti a pdf a sucessra end
    public function sendPDF(Request $request, $id)
    {
        if(count($this->returnBack())>0)
        {
            return redirect()->intended(route('worker.new.ponuda'));
        }
        $request->validate([
            'mailTo' => 'required|string|email:rfc|max:255',
            'mailSubject' => 'nullable|string|max:64',
            'mailBody' => 'nullable|string|max:1024',
        ]);
        list($pdf, $pdf_name) = $this->PDFdata($id);
        $data["mailFrom"] = Worker::select('email')->where('id', $this->worker())->first()->email;
        $data["mailTo"] = $request->mailTo;
        $data["mailSubject"] = $request->mailSubject;
        $data["mailBody"] = $request->mailBody;
        $pdfContent = $pdf->output();
        $pdfSize = strlen($pdfContent);
        if($pdfSize < 10485760)
        {
            Mail::send('worker.emails.send_pdf', $data, function ($message) use ($data,$pdfContent, $pdf_name) {
                $message->from($data["mailFrom"]);
                $message->to($data["mailTo"]);
                $message->subject($data["mailSubject"] ?: 'PDF ponuda');
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
        $mergedData = $this->mergedData();
        $collection = collect($mergedData);
        $selected_ponuda = $collection->where('ponuda_id', intval($id));
        $selectedWorkerPonuda = $selected_ponuda->where('worker_id', $worker_id);
        $pdf_name = $this->PDFname($id,$worker_id);
        $pdf = PDF::loadView('worker.pdf.default',['mergedData' => $selectedWorkerPonuda->all(), 'ponuda_name' => $pdf_name->ponuda_name ]);
        return array($pdf, $pdf_name);
    }

    public function editPonuda($ponuda_id){
        if(count($this->returnBack())>0)
        {
            return redirect()->intended(route('worker.new.ponuda'));
        }
        $this->editPonudaCheck($ponuda_id);
        return redirect()->intended(route('worker.new.ponuda'));
    }

    private function editPonudaCheck($ponuda_id)
    {
        $workerId = $this->worker();
        $worker = Worker::select('id', 'ponuda_counter')->where('id', $workerId)->first();
        $ponuda_date = Ponuda_Date::where('worker_id', $workerId)->where('id_ponuda', $ponuda_id)->first();
        $swap = Swap::where('worker_id', $workerId)->get();
        if(count($swap)>1)
            Swap::where('worker_id', $workerId)->delete();

        Swap::insert([
            'worker_id' => $workerId,
            'original_id' => $worker->ponuda_counter,
            'swap_id' => $ponuda_id,
            'temp_ponuda_name' => $ponuda_date->ponuda_name,
            'temp_opis' => $ponuda_date->opis,
            'temp_note' => $ponuda_date->note,
        ]);
        Worker::where('id', $workerId)->update(['ponuda_counter' => $ponuda_id]);
    }
    private function returnBack(){
        return Swap::join('workers', 'swap_ponuda.worker_id', '=', 'workers.id')
            ->where('workers.id', $this->worker())
            ->get();
    }
}
