<?php

namespace App\Imports;

use App\Models\Address;
use App\Imports\TableImportable;

class AddressesImport
{
    use TableImportable;

    public function __construct()
    {
        $this->key = 'shipto';
        $this->isSingleElement = true;
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

}
