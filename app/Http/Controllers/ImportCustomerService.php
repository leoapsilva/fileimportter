<?php

namespace App\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomersImport;
use Illuminate\Http\Request;

class ImportCustomerService
{
    private $importCustomerArray;

    /**
     * Import Customers and return a array result to summary the import
     *
     * @return array
     */
    public function import(Request $request): array
    {
        $this->importCustomerArray->user_id = $request->user_id;
        $this->importCustomerArray->path = $request->file('csv_file')->getRealPath();
        $this->importCustomerArray->header = '1';
        $this->importCustomerArray->filename = $request->file('csv_file')->getClientOriginalName();
        $this->customerImport = new CustomersImport;
        
        Excel::import($this->customerImport, $this->importCustomerArray->path);
        
        $this->importCustomerArray->data = json_encode($this->customerImport->getRows());
        $this->importCustomerArray->count = $this->customerImportimport->getRowCount();

        return $this->importCustomerArray;
    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
