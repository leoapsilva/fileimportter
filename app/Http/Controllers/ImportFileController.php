<?php

namespace App\Http\Controllers;

use App\Imports\FileImporter;
use App\Jobs\ProcessFileImport;
use Illuminate\Http\Request;
use App\Models\ImportFile;
use Illuminate\Support\Facades\Log;

class ImportFileController extends Controller
{
    /**
     * Offers import method
     */
    private $fileImporter;

    private $jobId;

    public function __construct()
    {
        $this->fileImporter = new FileImporter;
    }

    private $importableModels = [
                                        [   'model' => 'People',
                                            'name' => 'People',
                                            'format' => 'XML',
                                            'mime' => 'xml'],
                                        [   'model' => 'ShipOrders',
                                            'name' => 'Ship Orders',
                                            'format' => 'XML',
                                            'mime' => 'xml'],
                                        [   'model' => 'Customers',
                                            'name' => 'Customers',
                                            'format' => 'CSV',
                                            'mime' => 'excel'],
                                 ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('import-files.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('import-files.create', [ 'models' => $this->importableModels ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->prepareImportFileArray($request);

        $this->importSynch();
        
        $this->dispatchJobAsynch();

        return redirect('/import-files');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImportCustomer  $importFile
     * @return \Illuminate\Http\Response
     */
    public function show($importFile)
    {
        return view('import-files.show', [
            'importFile' => ImportFile::findOrFail($importFile),
        ]);
    }

    protected function importSynch()
    {
        if ($this->importFileArray['process'] === "synch")
        {   
            $importFileJob = ImportFile::create($this->fileImporter->import($this->importFileArray, $this->importableModels));   

            $importFileJob->status = 'finished';
            $importFileJob->process = 'synch';
            $importFileJob->save();
        }
    }

    protected function dispatchJobAsynch()
    {
        if ($this->importFileArray['process'] === "job-asynch")
        {
            // Dispatching Job
            $this->jobId = ProcessFileImport::dispatch($this->importFileArray, $this->importableModels);
        }
    }

    protected function prepareImportFileArray(Request $request)
    {
        $this->importFileArray['process']  = $request->process;
        $this->importFileArray['mime']  = $request->file('csv_file')->getClientMimeType();
        $this->importFileArray['store'] = $request->file('csv_file')->store('csv');
        $this->importFileArray['path'] = storage_path('app/public') . '/' . $this->importFileArray['store'];
        $this->importFileArray['user_id'] = $request->user_id;
        $this->importFileArray['model'] = $request->model;
        $this->importFileArray['filename'] = $request->file('csv_file')->getClientOriginalName();
        $this->importFileArray['data'] = "";
        $this->importFileArray['count'] = 0;
        $this->importFileArray['status'] = "started";
    }
}