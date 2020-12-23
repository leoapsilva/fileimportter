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
        $ret = $this->validateImport();
            
        if (!$ret){
            return $ret;
        }
        else{
            $this->importCustomerArray['user_id'] = $request->user_id;
            $this->importCustomerArray['path'] = $request->file('csv_file')->getRealPath();
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
     * validateImport function
     *
     * @return void
     */
    protected function validateImport()
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImportCustomer  $importCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(ImportCustomer $importCustomer)
    {
        return view('import-customers.edit', [
            'importCustomer' => $importCustomer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImportCustomer  $importCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImportCustomer $importCustomer)
    {
        $importCustomer->update($this->validateImport());

        return redirect('/import-customers');
    }
    
    /**
     * Delete the specified resource in storage
     *
     * @param ImportCustomer $importCustomer
     * @return void
     */
    public function delete(ImportCustomer $importCustomer)
    {
        return view('import-customers.delete', [
            'importCustomer' => $importCustomer,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImportCustomer  $importCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImportCustomer $importCustomer)
    {
        $importCustomer->delete();
        
        return redirect('/import-customers');
    }
}
