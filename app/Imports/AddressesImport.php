<?php

namespace App\Imports;

use App\Models\Address;

class AddressesImport
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
        $model = $this->model((array) $array['shipto']);
        $model::query()->upsert($model->toArray(), $this->uniqueBy());
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

        return new Address([
                'name'          => $row['name'],
                'address_1'     => $row['address'],
                'city'          => $row['city'],
                'country'       => $row['country'],
                'ship_order_id' => $this->id,
                ]);
    }

    public function uniqueBy()
    {
        return ['ship_order_id', 'name'];
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
