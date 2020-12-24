<?php

namespace App\Http\Controllers;

use App\Models\ImportCustomer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomersImport;

class ImportCustomerController extends Controller
{
    private $importCustomerArray;
    private $customerImport;

    /**
     * Import Customers and return a array result to summary the import
     *
     * @return array
     */
    protected function import(Request $request): array
    {
        $ret = $this->validateImportFile();
            
        if (!$ret){
            return $ret;
        }
        else{
            $this->importCustomerArray['store'] = $request->file('csv_file')->store('csv');
            $this->importCustomerArray['path']=storage_path('app/public').'/'.$this->importCustomerArray['store'];
            $this->importCustomerArray['user_id'] = $request->user_id;
            $this->importCustomerArray['header'] = '1';
            $this->importCustomerArray['filename'] = $request->file('csv_file')->getClientOriginalName();
            $this->customerImport = new CustomersImport;
            
            Excel::import($this->customerImport, $this->importCustomerArray['path']);
            
            $this->importCustomerArray['data'] = json_encode($this->customerImport->getRows());
            $this->importCustomerArray['count'] = $this->customerImport->getRowCount();
    
            return $this->importCustomerArray;
        }
    }

    /**
     * validateImportFile function
     *
     * @return void
     */
    protected function validateImportFile()
    {
        return request()->validate([
            'csv_file' => ['required', 'mimes:csv,txt'],
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('import-customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('import-customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ImportCustomer::create($this->import($request));

        return redirect('/import-customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImportCustomer  $importCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(ImportCustomer $importCustomer)
    {
        return view('import-customers.show', [
            'importCustomer' => $importCustomer,
        ]);
    }
}
