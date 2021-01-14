<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\Item;
use App\Models\Person;
use App\Models\User;

class ShipOrder extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [];

    protected $fillable = [
        'id',
        'person_id',
        'user_id',
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%')
                ->orWhere('phone', 'like', '%'.$query.'%');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function shipTo()
    {
        return $this->hasOne(Address::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

}
