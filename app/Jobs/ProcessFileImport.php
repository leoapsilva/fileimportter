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
use Illuminate\Support\Facades\Log;

class ProcessFileImport implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $importFile;
    protected $importFileArray;
    protected $importableModels;
    protected $fileImporter;

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
        
/*          if($this->batch()->cancelled()) {
            
            // Update state of batch to user
            return redirect('/import-files',
                                ['errors' =>
                                    [
                                        'csv_files' => 'erro'
                                    ]
                                ]
            );
        }
 */     

        

        $importFileJob = ImportFile::create($this->importFileArray);   
/*         Log::emergency(__FILE__ . ' ' . __LINE__);
        Log::emergency(var_dump($importFileJob->id));
 */
        $importFileResult = $this->fileImporter->import($this->importFileArray, $this->importableModels);
        
        /* Log::emergency(__FILE__ . ':' . __LINE__);
        Log::emergency(var_dump($importFileResult));
        Log::emergency("======================================================");

        
        $importFileId = json_decode($importFileResult['data']);
        Log::emergency(var_dump($importFileId));
        ImportFile::find($importFileJob->id)->
         */
        $importFileJob->count = $importFileResult['count'];
        
        $importFileJob->data = $importFileResult['data'];

        $importFileJob->save();


    }
}
