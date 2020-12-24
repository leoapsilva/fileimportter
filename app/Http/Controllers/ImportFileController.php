<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImportFile;
use App\Imports\ImportCSVFile;

class ImportFileController extends Controller
{
    use ImportCSVFile;
    
    private $importableModels = ['Customers'];

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

        ImportFile::create($this->import($request));

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
