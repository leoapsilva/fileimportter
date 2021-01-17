<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\ShipOrder;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [];

    protected $fillable = [
        'title',
        'note',
        'quantity',
        'price',
        'ship_order_id',
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('title', 'like', '%'.$query.'%')
                ->orWhere('note', 'like', '%'.$query.'%');
    }                

    public function shipOrder()
    {
        return $this->belongsTo(ShipOrder::class);
    }

}
