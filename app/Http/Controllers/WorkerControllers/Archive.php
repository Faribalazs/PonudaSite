<?php

namespace App\Http\Controllers\WorkerControllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Mail;

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
        return DB::select('select * from ponuda_date where worker_id = ? ORDER BY created_at DESC', [$worker]);
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
        return DB::select("SELECT * FROM ponuda_date WHERE worker_id = ? AND ponuda_name LIKE ? ORDER BY created_at $order", [$worker, $search]);
    }

    private function orderByDateNapomena($worker, $search, $order)
    {
        return DB::select("SELECT * FROM ponuda_date WHERE worker_id = ? AND note LIKE ? ORDER BY created_at $order", [$worker, $search]);
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
        return DB::table('ponuda')->where('ponuda_id', $id)->where('worker_id',$worker_id);
    }

    private function ponudaDate($id, $worker_id){
        return DB::table('ponuda_date')->where('id_ponuda', $id)->where('worker_id',$worker_id);
    }

    private function temporaryDesc($id){
        return DB::table('pozicija_temporary')->where('id_of_ponuda', $id)->delete();
    }

    private function temporaryTitle($id){
        return DB::table('title_temporary')->where('id_of_ponuda', $id)->delete();
    }
    private function ponudaId($worker, $id){
        return DB::select('select id, worker_id, ponuda_id from ponuda where worker_id = ? and ponuda_id = ?',[$worker,$id]);
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
        $ponuda = DB::select('SELECT p.id, p.worker_id, p.ponuda_id, p.categories_id, p.subcategories_id, p.pozicija_id, p.quantity, p.unit_price, p.overall_price, c.id 
        AS id_category, c.name AS name_category, s.id AS
        id_subcategory, s.name AS name_subcategory, poz.id 
        AS id_pozicija, poz.unit_id, poz.title, poz.description, pd.worker_id, pd.id_ponuda, pd.note, pd.opis, pd.created_at, u.id_unit, u.name AS unit_name,
        temp.id_of_ponuda, temp.temporary_description, title.id_of_ponuda, title.temporary_title,
        serv.id_service, serv.name_service
        FROM ponuda p JOIN categories c ON p.categories_id = c.id 
        JOIN subcategories s ON p.subcategories_id = s.id 
        JOIN pozicija poz ON p.pozicija_id = poz.id 
        JOIN ponuda_date pd ON pd.id_ponuda = p.ponuda_id
        JOIN units u ON poz.unit_id = u.id_unit
        LEFT JOIN pozicija_temporary temp ON p.id = temp.id_of_ponuda
        LEFT JOIN title_temporary title ON p.id = title.id_of_ponuda
        JOIN services serv ON p.service_id = serv.id_service
        WHERE p.worker_id = ?',[$worker_id]);
        $custom_ponuda = DB::select('SELECT p.id, p.worker_id, p.ponuda_id, p.categories_id, p.subcategories_id, p.pozicija_id, p.quantity, p.unit_price, p.overall_price, c.id 
        AS id_category, c.name AS name_custom_category, s.id AS
        id_subcategory, s.name AS name_custom_subcategory, poz.id 
        AS id_pozicija, poz.unit_id, poz.custom_title, poz.custom_description, pd.worker_id, pd.id_ponuda, pd.note, pd.opis, pd.created_at, u.id_unit, u.name AS unit_name,
        s.is_subcategory_deleted, c.is_category_deleted, poz.is_pozicija_deleted, temp.id_of_ponuda, temp.temporary_description, title.id_of_ponuda, title.temporary_title,
        serv.id_service, serv.name_service
        FROM ponuda p JOIN custom_categories c ON p.categories_id = c.id 
        JOIN custom_subcategories s ON p.subcategories_id = s.id 
        JOIN custom_pozicija poz ON p.pozicija_id = poz.id 
        JOIN ponuda_date pd ON pd.id_ponuda = p.ponuda_id
        JOIN units u ON poz.unit_id = u.id_unit
        LEFT JOIN pozicija_temporary temp ON p.id = temp.id_of_ponuda
        LEFT JOIN title_temporary title ON p.id = title.id_of_ponuda
        JOIN services serv ON p.service_id = serv.id_service
        WHERE p.worker_id = ?',[$worker_id]);
        $mergedData = array_merge($ponuda, $custom_ponuda);

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
        usort($mergedData, function($a, $b) {
            return $a->id - $b->id;
        });
        $collection = collect($mergedData);
        $selected_ponuda = $collection->where('ponuda_id', intval($id));
        $selectedWorkerPonuda = $selected_ponuda->where('worker_id', $worker_id);
        $ponuda_name = DB::select('select ponuda_name from ponuda_date where id_ponuda = ?',[$id]);

        
        return view('worker.views.archive-selected',['mergedData' => $selectedWorkerPonuda->all(), 'ponuda_name' => $ponuda_name]);
    }

    private function PDFname($id, $worker)
    {
        return DB::select('select ponuda_name from ponuda_date where id_ponuda = ? and worker_id = ?', [$id, $worker]);
    }

    public function createMAIL($id)
    {
        if(count($this->returnBack())>0)
        {
            return redirect()->intended(route('worker.new.ponuda'));
        }
        $name = DB::select('select ponuda_name from ponuda_date where id_ponuda = ?', [$id]);
        return view('worker.views.mail-send',['id_archive' => $id , 'name' => $name]);
    }

    public function createPDF($id) {
        if(count($this->returnBack())>0)
        {
            return redirect()->intended(route('worker.new.ponuda'));
        }
        list($pdf, $pdf_name) = $this->PDFdata($id);
        return $pdf->download($pdf_name[0]->ponuda_name . '.pdf');
    }

    public function viewPDF($id) {
        if(count($this->returnBack())>0)
        {
            return redirect()->intended(route('worker.new.ponuda'));
        }
        list($pdf, $pdf_name) = $this->PDFdata($id);
        return $pdf->stream($pdf_name[0]->ponuda_name);
    }

    public function selectTamplate($id) {

        return view('worker.views.select-tamplate',['ponuda_id' => $id]);
    }

    public function tamplateGeneratePdf(Request $request) {

        $template = $request->temp;
        $pdf_blade = 'worker.pdf.'. $template;
        $id = $request->ponuda_id;
        $worker_id = $this->worker();
        $mergedData = $this->mergedData();
        $collection = collect($mergedData);
        $selected_ponuda = $collection->where('ponuda_id', intval($id));
        $selectedWorkerPonuda = $selected_ponuda->where('worker_id', $worker_id);
        $pdf_name = $this->PDFname($id,$worker_id);
        $pdf = PDF::loadView($pdf_blade,['mergedData' => $selectedWorkerPonuda->all(), 'ponuda_name' => $pdf_name[0]->ponuda_name ]);

        return $pdf->download($pdf_name[0]->ponuda_name . '.pdf');
    }

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
        $data["mailFrom"] = DB::select('select email from workers where id = ?', [$this->worker()])[0]->email;
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
                $message->attachData($pdfContent,$pdf_name[0]->ponuda_name . '.pdf', [
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
        $pdf = PDF::loadView('worker.pdf.default',['mergedData' => $selectedWorkerPonuda->all(), 'ponuda_name' => $pdf_name[0]->ponuda_name ]);
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
        $worker = DB::select('select id, ponuda_counter from workers where id = ?', [$this->worker()]);
        $ponuda_date = DB::select('select * from ponuda_date where worker_id = ? and id_ponuda = ?', [$this->worker(), $ponuda_id]);
        $swap = DB::select('select * from swap_ponuda where worker_id = ?', [$this->worker()]);
        if(count($swap)>1)
            DB::table('swap_ponuda')->where('worker_id', $this->worker())->delete();

        DB::insert('insert into swap_ponuda (worker_id, original_id, swap_id, temp_ponuda_name, temp_opis, temp_note) values (?, ?, ?, ?, ?, ?)', [$this->worker(), $worker[0]->ponuda_counter, $ponuda_id, $ponuda_date[0]->ponuda_name, $ponuda_date[0]->opis, $ponuda_date[0]->note]);
        DB::update('update workers set ponuda_counter = ? where id = ?', [$ponuda_id, $this->worker()]);
    }
    private function returnBack(){
        return DB::select('select * from swap_ponuda s JOIN workers w ON s.worker_id = w.id where w.id = ?', [$this->worker()]);
    }
}
