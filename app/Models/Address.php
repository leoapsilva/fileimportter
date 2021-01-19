<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Model\ShipOrder;

class Address extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [];

    protected $fillable = [
        'name',
        'address_1',
        'address_2',
        'number',
        'city',
        'state',
        'zipcode',
        'reference',
        'country',
        'ship_order_id',
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%')
                ->orWhere('address_1', 'like', '%'.$query.'%')   
                ->orWhere('address_2', 'like', '%'.$query.'%')
                ->orWhere('number', 'like', '%'.$query.'%')
                ->orWhere('city', 'like', '%'.$query.'%')
                ->orWhere('state', 'like', '%'.$query.'%')
                ->orWhere('zipcode', 'like', '%'.$query.'%')
                ->orWhere('reference', 'like', '%'.$query.'%')
                ->orWhere('country', 'like', '%'.$query.'%');
    }                

    public function shipOrder()
    {
        return $this->belongsTo(ShipOrder::class);
    }

}
