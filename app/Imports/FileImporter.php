<?php

namespace App\Imports;

use Maatwebsite\Excel\Facades\Excel;
use ACFBentveld\XML\XML;
use App\Rules\IsModelAndFileMimeEquals;
use App\Rules\IsParsedFileImported;
use Illuminate\Support\Facades\Log;

class FileImporter
{
    private $importedFileArray;
    private $importableModels;
    private $modelImport;
    private $returnedImportedFileArray;

    /**
     * Import File and return a array result to log the import
     *
     * @return array
     */
    public function import(array $importFileArray, array $importableModels): array
    {
        $this->setImportedFileArray($importFileArray);

        $this->setImportableModels($importableModels);

        $this->isModelAndFileMimeEquals();

        $this->setModelClassNamespace();

        $this->createModelImportInstance();

        $this->importIfExcel();

        $this->importIfXML();

        $this->setReturnImportFileArray();

        return $this->importedFileArray;
    }

    protected function setImportedFileArray(array $importFileArray)
    {
        $this->importedFileArray = $importFileArray;
    }

    protected function setImportableModels(array $importableModels)
    {
        $this->importableModels = $importableModels;
    }

    protected function setModelClassNamespace()
    {
        $this->modelName = "App\\Imports\\" . $this->importedFileArray['model'] .'Import';
    }

    protected function createModelImportInstance()
    {
        $this->modelImport = new $this->modelName;
    }

    protected function importIfExcel()
    {
        if (str_contains($this->importedFileArray['mime'], 'excel')) 
        {
            $this->validateImportFile();

            Excel::import($this->modelImport, $this->importedFileArray['path']);
        } 
    }

    protected function importIfXML()
    {
        if (str_contains($this->importedFileArray['mime'], 'xml')) 
        {
            $this->checkForParseErrors();

            $xml = XML::import($this->importedFileArray['path'])->get()->toArray();
            
            $this->modelImport->setUserId($this->importedFileArray['user_id']);
            $this->modelImport->import($xml);
        }
    }

    protected function setReturnImportFileArray()
    { 
        $this->importedFileArray['data'] = json_encode($this->modelImport->getRows());
        $this->importedFileArray['count'] = $this->modelImport->getRowCount();
        $this->importedFileArray['status'] = "finished";
    }

    /**
     * validateImportFile function
     *
     * @return void
     */
    protected function validateImportFile()
    {
        // Looks like the same issue here and tests with uploads files.
        // Turning off the validation...

        if ($this->importedFileArray['process'] === "synch") {
            return request()->validate([
            'csv_file' => ['required', $this->getAcceptedMimes()],
            ]);
        }
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
        // Looks like the same issue here and tests with uploads files.
        // Turning off the validation...

        if ($this->importedFileArray['process'] === "synch") {
            return request()->validate([
            'csv_file' => ['required', new IsParsedFileImported($this->importedFileArray['path']) ],
            ]);
        }
    }

    /**
     * isModelAndFileMimeEquals function
     *
     * @param [type] $importableModels
     * @return boolean
     */
    protected function isModelAndFileMimeEquals()
    {
        // Looks like the same issue here and tests with uploads files.
        // Turning off the validation...

        if ($this->importedFileArray['process'] === "synch") {
            return request()->validate([
            'csv_file' => ['required', new IsModelAndFileMimeEquals(
                $this->importableModels,
                $this->importedFileArray['model'],
                $this->importedFileArray['mime']
            ) ]
        ]);
        }        
    }

}
