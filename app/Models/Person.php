<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Phone;
use App\Models\ShipOrder;

class Person extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [];

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'user_id'
        
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('first_name', 'like', '%'.$query.'%')
                ->orWhere('last_name', 'like', '%'.$query.'%')
                ->orWhere('phone', 'like', '%'.$query.'%');
    }

    public function buildDashboard()
    {
        $people = $this->all();
        $total = count($people);
        $unique = count($people->unique(function ($item) { return $item['first_name'].$item['last_name'].$item['email'].$item['company'].$item['city'].$item['gender']; }));
        $no_last_name = count($people->filter(function ($item) { return empty($item->last_name);}));
        $duplicated = $total - $unique;
        $per_unique = $total == 0 ? 0 : floor($unique/$total*100);
        $per_duplicated = $total == 0 ? 0 : floor($duplicated/$total*100);
        $per_no_last_name = $total == 0 ? 0 : floor($no_last_name/$total*100);

        $dashboard = collect([ 	'total' => $total,
                                'unique' => $unique,
                                'duplicated' => $duplicated,
                                'no_last_name' => $no_last_name,	
                                'per_unique' => $per_unique,
                                'per_duplicated' => $per_duplicated,
                                'per_no_last_name' => $per_no_last_name,	
                                
        ]);	

        return $dashboard;
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function shipOrders()
    {
        return $this->hasMany(ShipOrder::class);
    }

}
