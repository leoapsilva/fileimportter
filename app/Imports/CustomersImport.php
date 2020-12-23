<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class CustomersImport implements ToModel, WithHeadingRow, WithUpserts, WithChunkReading
{
    private $rowCount = 0;
    private $rows = [];
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ++$this->rowCount;
        array_push($this->rows, $row);

        return new Customer([
            'first_name'    => $row['first_name'],
            'last_name'     => $row['last_name'],
            'email'         => $row['email'],
            'gender'        => $row['gender'],
            'ip_address'    => $row['ip_address'],
            'company'       => $row['company'],
            'city'          => $row['city'],
            'title'         => $row['title'],
            'website'       => $row['website'],
            ]);
    }

    public function uniqueBy()
    {
        return ['first_name', 'last_name', 'email', 'gender', 'ip_address', 'company', 'city', 'title', 'website'];
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
