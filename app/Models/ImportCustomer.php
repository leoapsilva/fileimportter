<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ImportCustomer extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [];

    protected $fillable = [
        'filename',
        'header',
        'count',
        'data',
        'user_id',
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::join('users', 'import_customers.user_id', '=', 'users.id')
                ->orwhere('users.name', 'like', '%'.$query.'%')
                ->orWhere('filename', 'like', '%'.$query.'%');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
