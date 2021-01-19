<?php

namespace App\Imports;

use App\Models\Person;
use App\Imports\TableImportable;

class PeopleImport
{
    use TableImportable;

    public function __construct()
    {
        $this->key = 'person';
        $this->composites = ['Phones'];
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

        return  new Person([
                'id'            => $row['personid'] ,
                'first_name'    => $row['personname'],
                'user_id'       => $this->user_id,
            ]);
        
    }

    public function uniqueBy()
    {
        return ['personid', 'first_name'];
    }
    
    public function chunkSize(): int
    {
        return 250;
    }
}
