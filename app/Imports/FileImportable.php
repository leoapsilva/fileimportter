<?php

namespace App\Imports;

use Maatwebsite\Excel\Facades\Excel;
use ACFBentveld\XML\XML;
use App\Rules\IsModelAndFileMimeEquals;
use App\Rules\IsParsedFileImported;

trait FileImportable
{
    private $importedFileArray;
    private $modelImport;
    private $importedModel;
    private $importedMime;

    /**
     * Import File and return a array result to log the import
     *
     * @return array
     */
    protected function import(array $importFileArray, array $importableModels): array
    {
        $this->modelName = "App\\Imports\\" . $importFileArray['model'] .'Import';
        $this->modelImport = new $this->modelName;

        $this->validateImportFile();

        $this->isModelAndFileMimeEquals($importableModels, 
                                        $importFileArray['model'], 
                                        $importFileArray['mime']);

        if (str_contains($importFileArray['mime'], 'excel')) 
        {
            Excel::import($this->modelImport, $importFileArray['path']);
        } 
        elseif (str_contains($importFileArray['mime'], 'xml')) 
        {
            $this->checkForParseErrors();

            $xml = XML::import($importFileArray['path'])->get()->toArray();

            $this->modelImport->import($xml);
        }

        $importFileArray['data'] = json_encode($this->modelImport->getRows());
        $importFileArray['count'] = $this->modelImport->getRowCount();
        
        return $importFileArray;
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
    /**
     * getAcceptedMimes function
     *
     * @return void
     */
    protected function getAcceptedMimes()
    {
        return 'mimes:csv,txt,xml';
    }

    /**
     * checkForParseErrors function
     *
     * @return void
     */
    protected function checkForParseErrors()
    {
         return request()->validate([
            'csv_file' => ['required', new IsParsedFileImported ],
            ]);
    }

    /**
     * isModelAndFileMimeEquals function
     *
     * @param [type] $importableModels
     * @return boolean
     */
    protected function isModelAndFileMimeEquals($importableModels, $importedModel, $importedMime)
    {
        return request()->validate([
            'csv_file' => ['required', new IsModelAndFileMimeEquals($importableModels, 
                                                                    $importedModel,
                                                                    $importedMime) ],
            ]);
    }

}
