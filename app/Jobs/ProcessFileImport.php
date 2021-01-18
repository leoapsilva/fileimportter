<?php

namespace App\Jobs;

use App\Imports\FileImporter;
use App\Models\ImportFile;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessFileImport implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $importFile;
    protected $importFileArray; 
    protected $importableModels;
    protected $fileImporter;
    protected $importFileJob;
    protected $importFileResult;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($importFileArray, $importableModels)
    {
        $this->importFileArray = $importFileArray;
        $this->importableModels = $importableModels;
        $this->fileImporter = new FileImporter;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->started();

        $this->processing();

        $this->finished();
    }

    protected function started()
    {
        $this->importFileJob = ImportFile::create($this->importFileArray);   
    }

    protected function processing()
    {
        $this->importFileJob->status = 'processing';
        
        $this->importFileJob->process = 'job-asynch';

        $this->importFileJob->save();

        $this->importFileResult = $this->fileImporter->import($this->importFileArray, $this->importableModels);
    }
    
    protected function finished()
    {
        $this->importFileJob->count = $this->importFileResult['count'];
        
        $this->importFileJob->data = $this->importFileResult['data'];

        if ($this->importFileJob->count == 0)  
        {
            $this->importFileJob->status = 'failed' ;
        }
        else 
        {
            $this->importFileJob->status = 'finished';
        }

        $this->importFileJob->save();
    }
}
