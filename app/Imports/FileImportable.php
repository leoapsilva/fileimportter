<?php

namespace App\Imports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use ACFBentveld\XML\XML;
use App\Rules\IsModelAndFileMimeEquals;
use App\Rules\IsParsedFileImported;

trait FileImportable
{
    private $importFileArray;
    private $modelImport;
    private $importedModel;
    private $importedMime;

    /**
     * Import Customers and return a array result to summary the import
     *
     * @return array
     */
    protected function import(Request $request, array $importableModels): array
    {
        $this->importedModel = $request->model;
        $this->importedMime = $request->file('csv_file')->getClientMimeType();

        $this->validateImportFile();

        $this->isModelAndFileMimeEquals($importableModels);

        $this->checkForParseErrors();

        $this->importFileArray['mime']  = $this->importedMime;
        $this->importFileArray['store'] = $request->file('csv_file')->store('csv');
        $this->importFileArray['path'] = storage_path('app/public') . '/' . $this->importFileArray['store'];
        $this->importFileArray['user_id'] = $request->user_id;
        $this->importFileArray['model'] = $this->importedModel;
        $this->importFileArray['filename'] = $request->file('csv_file')->getClientOriginalName();

        if (str_contains($this->importFileArray['mime'], 'excel')) 
        {
            Excel::import($this->modelImport, $this->importFileArray['path']);
        } 
        elseif (str_contains($this->importFileArray['mime'], 'xml')) 
        {
            $xml = XML::import($this->importFileArray['path'])->get()->toArray();
            $this->modelImport->import($xml);
        }

        $this->importFileArray['data'] = json_encode($this->modelImport->getRows());
        $this->importFileArray['count'] = $this->modelImport->getRowCount();
        
        return $this->importFileArray;
    }

    /**
     * validateImportFile function
     *
     * @return void
     */
    protected function validateImportFile()
    {
        return request()->validate([
            'csv_file' => ['required', $this->getAcceptedMimes()],
            ]);
    }
    
    protected function getAcceptedMimes()
    {
        return 'mimes:csv,txt,xml';
    }

    protected function checkForParseErrors()
    {
         return request()->validate([
            'csv_file' => ['required', new IsParsedFileImported ],
            ]);
    }

    protected function isModelAndFileMimeEquals($importableModels)
    {
        return request()->validate([
            'csv_file' => ['required', new IsModelAndFileMimeEquals($importableModels, 
                                                                    $this->importedModel,
                                                                    $this->importedMime) ],
            ]);
    }

}
