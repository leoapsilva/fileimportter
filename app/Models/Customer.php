<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'gender',
        'ip_address',
        'company',
        'city',
        'title',
        'website',
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('first_name', 'like', '%'.$query.'%')
                ->orWhere('last_name', 'like', '%'.$query.'%')
                ->orWhere('email', 'like', '%'.$query.'%')
                ->orWhere('title', 'like', '%'.$query. '%')
                ->orWhere('city', 'like', '%'.$query.'%')
                ->orWhere('company', 'like', '%'.$query.'%');
    }

    public function buildDashboard()
    {
        $customers = $this->all();
        $total = count($customers);
        $unique = count($customers->unique(function ($item) { return $item['first_name'].$item['last_name'].$item['email'].$item['company'].$item['city'].$item['gender']; }));
        $no_email = count($customers->filter(function ($item) { return empty($item->email);}));
        $no_last_name = count($customers->filter(function ($item) { return empty($item->last_name);}));
        $no_gender = count($customers->filter(function ($item) { return empty($item->gender);}));
        $duplicated = $total - $unique;
        $per_unique = $total == 0 ? 0 : floor($unique/$total*100);
        $per_duplicated = $total == 0 ? 0 : floor($duplicated/$total*100);
        $per_no_email = $total == 0 ? 0 : floor($no_email/$total*100);
        $per_no_last_name = $total == 0 ? 0 : floor($no_last_name/$total*100);
        $per_no_gender = $total == 0 ? 0 : floor($no_gender/$total*100);

        $dashboard = collect([ 	'total' => $total,
                                'unique' => $unique,
                                'duplicated' => $duplicated,
                                'no_email' =>  $no_email,
                                'no_last_name' => $no_last_name,	
                                'no_gender' => $no_gender,
                                'per_unique' => $per_unique,
                                'per_duplicated' => $per_duplicated,
                                'per_no_email' =>  $per_no_email,
                                'per_no_last_name' => $per_no_last_name,	
                                'per_no_gender' => $per_no_gender,
                                
        ]);	

        return $dashboard;
    }

}
