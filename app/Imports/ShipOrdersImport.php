<?php

namespace App\Imports;

use App\Models\ShipOrder;
use App\Imports\ItemsImport;
use App\Imports\AddressesImport;

class ShipOrdersImport
{
    private $rowCount = 0;
    private $rows = [];
    private $addressesImport;
    private $itemsImport;

    public function import(array $array)
    {
        if(!array_key_exists('shiporder', $array))
        {
            return;
        }

        foreach($array['shiporder'] as $item){
            $model = $this->model((array)$item);
            $model::query()->upsert($model->toArray(), $this->uniqueBy());
            $this->composite((array) $item, $model->id);
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

        return  new ShipOrder([
                'id'            => $row['orderid'],
                'person_id'     => $row['orderperson'] ,
                'user_id'       => request()->user()->id,
            ]);
        
    }

    public function uniqueBy()
    {
        return ['id', 'person_id'];
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

    public function composite(array $row, $id)
    {
        //dd((array)$row['shipto']);

        $this->addressesImport = new AddressesImport;
        $this->addressesImport->setId($id);
        $this->addressesImport->import($row);

        $this->itemsImport = new ItemsImport;
        $this->itemsImport->setId($id);
        $this->itemsImport->import($row);

    }
}
