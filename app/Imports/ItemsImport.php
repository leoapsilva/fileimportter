<?php

namespace App\Imports;

use App\Models\Item;

class ItemsImport
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
        foreach($array['items'] as $item){
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

        return new Item([
                'title'     => $row['title'],
                'note'      => $row['note'],
                'quantity'  => $row['quantity'],
                'price'     => $row['price'],
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

    public function getRowCount(): int
    {
        return $this->rowCount;
    }

    public function getRows(): array
    {
        return $this->rows;
    }

}
