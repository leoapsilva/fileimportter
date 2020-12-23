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
}
