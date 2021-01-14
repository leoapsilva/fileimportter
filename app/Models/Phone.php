<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Model\Person;

class Phone extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [];

    protected $fillable = [
        'country',
        'area',
        'number',
        'person_id',
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('country', 'like', '%'.$query.'%')
                ->orWhere('area', 'like', '%'.$query.'%')
                ->orWhere('number', 'like', '%'.$query.'%');
    }                

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

}
