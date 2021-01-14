<?php

namespace App\Imports;

use App\Models\Item;
use App\Imports\TableImportable;

class ItemsImport
{
    use TableImportable;

    public function __construct()
    {
        $this->key = 'items';
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

        return new Item([
                'title'         => $row['title'],
                'note'          => $row['note'],
                'quantity'      => $row['quantity'],
                'price'         => $row['price'],
                'ship_order_id' => $this->id,
                ]);
    }

    public function uniqueBy()
    {
        return ['ship_order_id', 'title', 'note', 'quantity', 'price'];
    }
    
    public function chunkSize(): int
    {
        return 250;
    }

}
