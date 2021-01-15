<?php

namespace App\Jobs;

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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ImportFile $importFile)
    {
        $this->importFile = $importFile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->batch()->cancelled()) {
            
            // Update state of batch to user
            return;
        }
        // FileImportable->import   
    }
}
