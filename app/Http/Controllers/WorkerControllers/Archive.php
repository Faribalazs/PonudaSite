<?php

namespace App\Http\Controllers\WorkerControllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $worker_id = $this->worker();
        $data = $this->showPrivate($worker_id);
        
        return view('worker.views.archive',['data' => $data]);
    }
    private function orderByDate($worker, $search, $order)
    {
        return DB::select("SELECT * FROM ponuda_date WHERE worker_id = ? AND ponuda_name LIKE ? ORDER BY created_at $order", [$worker, $search]);
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
    private function ponudaInfo($id, $worker_id){
        return DB::table('ponuda')->where('ponuda_id', $id)->where('worker_id',$worker_id);
    }
    private function ponudaDate($id, $worker_id){
        return DB::table('ponuda_date')->where('id_ponuda', $id)->where('worker_id',$worker_id);
    }
    private function temporaryDesc($id){
        return DB::table('pozicija_temporary')->where('id_of_ponuda', $id)->delete();
    }
    private function ponudaId($worker, $id){
        return DB::select('select id, worker_id, ponuda_id from ponuda where worker_id = ? and ponuda_id = ?',[$worker,$id]);
    }
    public function delete($id)
    {
        $worker_id = $this->worker();
        foreach($this->ponudaId($worker_id,$id) as $toDel)
        {
            $this->temporaryDesc($toDel->id);
        }
        $this->ponudaDate($id, $worker_id)->delete();
        $this->ponudaInfo($id, $worker_id)->delete();
        return $this->show();
    }

    public function deleteElement($id,$ponuda_id)
    {
        $worker_id = $this->worker();
        $this->ponudaInfo($ponuda_id,$worker_id)->where('id', $id)->delete();
        $this->temporaryDesc($id);
        if($this->ponudaInfo($ponuda_id,$worker_id)->count()<1)
        {
            $this->ponudaDate($ponuda_id,$worker_id)->delete();
            return $this->show();
        }
        return $this->selectedArchive($ponuda_id);
    }
    
    private function mergedData(){
        $worker_id = $this->worker();
        $ponuda = DB::select('SELECT p.id, p.worker_id, p.ponuda_id, p.categories_id, p.subcategories_id, p.pozicija_id, p.quantity, p.unit_price, p.overall_price, c.id 
        AS id_category, c.name AS name_category, s.id AS
        id_subcategory, s.name AS name_subcategory, poz.id 
        AS id_pozicija, poz.unit_id, poz.title, poz.description, pd.worker_id, pd.id_ponuda, pd.created_at, u.id_unit, u.name AS unit_name,
        temp.id_of_ponuda, temp.temporary_description,
        serv.id_service, serv.name_service
        FROM ponuda p JOIN categories c ON p.categories_id = c.id 
        JOIN subcategories s ON p.subcategories_id = s.id 
        JOIN pozicija poz ON p.pozicija_id = poz.id 
        JOIN ponuda_date pd ON pd.id_ponuda = p.ponuda_id
        JOIN units u ON poz.unit_id = u.id_unit
        LEFT JOIN pozicija_temporary temp ON p.id = temp.id_of_ponuda
        JOIN services serv ON p.service_id = serv.id_service
        WHERE p.worker_id = ?',[$worker_id]);
        $custom_ponuda = DB::select('SELECT p.id, p.worker_id, p.ponuda_id, p.categories_id, p.subcategories_id, p.pozicija_id, p.quantity, p.unit_price, p.overall_price, c.id 
        AS id_category, c.name AS name_custom_category, s.id AS
        id_subcategory, s.name AS name_custom_subcategory, poz.id 
        AS id_pozicija, poz.unit_id, poz.custom_title, poz.custom_description, pd.worker_id, pd.id_ponuda, pd.created_at, u.id_unit, u.name AS unit_name,
        s.is_subcategory_deleted, c.is_category_deleted, poz.is_pozicija_deleted, temp.id_of_ponuda, temp.temporary_description,
        serv.id_service, serv.name_service
        FROM ponuda p JOIN custom_categories c ON p.categories_id = c.id 
        JOIN custom_subcategories s ON p.subcategories_id = s.id 
        JOIN custom_pozicija poz ON p.pozicija_id = poz.id 
        JOIN ponuda_date pd ON pd.id_ponuda = p.ponuda_id
        JOIN units u ON poz.unit_id = u.id_unit
        LEFT JOIN pozicija_temporary temp ON p.id = temp.id_of_ponuda
        JOIN services serv ON p.service_id = serv.id_service
        WHERE p.worker_id = ?',[$worker_id]);
        $mergedData = array_merge($ponuda, $custom_ponuda);

        return $mergedData;
    }

    public function selectedArchive($id)
    {
        $worker_id = $this->worker();
        $mergedData = $this->mergedData();
        usort($mergedData, function($a, $b) {
            return $a->id - $b->id;
        });
        $collection = collect($mergedData);
        $selected_ponuda = $collection->where('ponuda_id', intval($id));
        $selectedWorkerPonuda = $selected_ponuda->where('worker_id', $worker_id);

        
        return view('worker.views.archive-selected',['mergedData' => $selectedWorkerPonuda->all()]);
    }
    private function PDFname($id, $worker)
    {
        return DB::select('select ponuda_name from ponuda_date where id_ponuda = ? and worker_id = ?', [$id, $worker]);
    }
    public function createPDF($id) {
        
        $worker_id = $this->worker();
        $mergedData = $this->mergedData();
        $collection = collect($mergedData);
        $selected_ponuda = $collection->where('ponuda_id', intval($id));
        $selectedWorkerPonuda = $selected_ponuda->where('worker_id', $worker_id);
        $pdf_name = $this->PDFname($id,$worker_id);

        $pdf = PDF::loadView('worker.views.archive-pdf',['mergedData' => $selectedWorkerPonuda->all(), 'ponuda_name' => $pdf_name[0]->ponuda_name ]);
        return $pdf->download($pdf_name[0]->ponuda_name . '.pdf');
    }
}
