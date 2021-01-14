<?php

namespace App\Imports;

use App\Models\Person;
use App\Imports\PhonesImport;

class PeopleImport
{
    private $rowCount = 0;
    private $rows = [];
    private $phonesImport;

    public function import(array $array)
    {
        foreach($array['person'] as $person){
            $model = $this->model((array)$person);
            $model::query()->upsert($model->toArray(), $this->uniqueBy());
            $this->aggregate((array) $person, $model->id);
        }
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
                'user_id'       => request()->user()->id,
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

    public function getRowCount(): int
    {
        return $this->rowCount;
    }

    public function getRows(): array
    {
        return $this->rows;
    }

    public function aggregate(array $row, $id)
    {
        $this->phonesImport = new PhonesImport;
        $this->phonesImport->setId($id);
        $this->phonesImport->import((array) $row);
    }
}
