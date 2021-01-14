<?php

namespace App\Imports;

use App\Models\Phone;

class PhonesImport
{
    private $rowCount = 0;
    private $rows = [];
    private $id;
    
    public function setId($id)
    {
        $this->id = $id;
    }

    public function import(array $array)
    {
        foreach($array['phones'] as $item){
            $model = $this->model((array)$item);
            $model::query()->upsert($model->toArray(), $this->uniqueBy());
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

    public function getRowCount(): int
    {
        return $this->rowCount;
    }

    public function getRows(): array
    {
        return $this->rows;
    }

}
