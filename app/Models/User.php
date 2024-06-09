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

    public function carts()
    {
        return $this->hasMany(Cart::class, "user_id", "user_id");
    }
}
