<?php

namespace App\Imports;

trait TableImportable
{
    private $rowCount = 0;
    private $rows = [];
    private $key;
    private $compositeImport = [];
    private $composites = [];
    private $isSingleElement = false;

    public function import(array $array)
    {
        if (array_key_exists($this->key, $array)) {
            if ($this->isSingleElement) {
                $model = $this->model((array)$array[$this->key]);
                $model::query()->upsert($model->toArray(), $this->uniqueBy());
            }
            else {
                foreach ($array[$this->key] as $item) {
                    $model = $this->model((array)$item);
                    $model::query()->upsert($model->toArray(), $this->uniqueBy());
                    $this->composite((array) $item, $model->id);
                }
            }
        }
    }

    protected function composite(array $row, $id)
    {
        foreach ($this->composites as $composite) {
            $modelImport = "App\\Imports\\" . $composite .'Import';
            $this->compositeImport[] = new $modelImport;
            last($this->compositeImport)->setId($id);
            last($this->compositeImport)->import($row);
        }
    }

    public function setId($id)
    {
        $this->id = $id;
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