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
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getAll()
    {
        $perfil = auth()->user()->perfil();
        return $perfil === 'Admin' ? self::all() : self::where('user_id', '=', auth()->id())->get();
    }
}
