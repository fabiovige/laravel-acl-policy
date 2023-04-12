<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'created_by');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
