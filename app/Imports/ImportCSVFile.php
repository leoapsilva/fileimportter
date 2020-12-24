<?php

namespace App\Imports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

trait ImportCSVFile
{
    private $importFileArray;
    private $modelImport;

    /**
     * Import Customers and return a array result to summary the import
     *
     * @return array
     */
    protected function import(Request $request): array
    {
        $ret = $this->validateImportFile();
            
        if (!$ret)
        {
            return $ret;
        }
        else
        {
            $this->ImportFileArray['store'] = $request->file('csv_file')->store('csv');
            $this->ImportFileArray['path'] = storage_path('app/public') . '/' . $this->ImportFileArray['store'];
            $this->ImportFileArray['user_id'] = $request->user_id;
            $this->ImportFileArray['model'] = $request->model;
            $this->ImportFileArray['filename'] = $request->file('csv_file')->getClientOriginalName();
            
            Excel::import($this->modelImport, $this->ImportFileArray['path']);
            
            $this->ImportFileArray['data'] = json_encode($this->modelImport->getRows());
            $this->ImportFileArray['count'] = $this->modelImport->getRowCount();
    
            return $this->ImportFileArray;
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
}
