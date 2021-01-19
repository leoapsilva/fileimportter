<?php

namespace App\Imports;

use App\Models\Phone;
use App\Imports\TableImportable;

class PhonesImport
{
    use TableImportable;

    public function __construct()
    {
        $this->key = 'phones';
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ++$this->rowCount;
        
        $this->rows[] = $row;

        return new Phone([
                'number'    => $row[0],
                'person_id' => $this->id,
                ]);
    }

    public function uniqueBy()
    {
        return ['person_id', 'number'];
    }
    
    public function chunkSize(): int
    {
        return 250;
    }
}
