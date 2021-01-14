<?php

namespace App\Http\Controllers;

use App\Imports\FileImportable;
use Illuminate\Http\Request;
use App\Models\ImportFile;

class ImportFileController extends Controller
{
    /**
     * Offers import method
     */
    use FileImportable;
    
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
        $this->modelName = "App\\Imports\\" . $request->model .'Import';
        $this->modelImport = new $this->modelName;

        ImportFile::create($this->import($request, $this->importableModels));

        return redirect('/import-files');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImportCustomer  $importFile
     * @return \Illuminate\Http\Response
     */
    public function show(ImportFile $importFile)
    {
        return view('import-file.show', [
            'importFile' => $importFile,
        ]);
    }

}
