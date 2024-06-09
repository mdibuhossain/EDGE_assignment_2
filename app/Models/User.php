<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];
    protected $primaryKey = "user_id";

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
