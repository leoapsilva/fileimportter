<?php

namespace App\Imports;

use App\Models\ShipOrder;
use App\Imports\TableImportable;

class ShipOrdersImport
{
    use TableImportable;
    
    public function __construct()
    {
        $this->key = 'shiporder';
        $this->composites = ['Addresses', 'Items'];
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
                'user_id'       => $this->user_id,
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
}
