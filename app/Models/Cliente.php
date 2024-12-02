<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Cliente extends Model
{
    //
    use HasFactory;
    protected $fillable = ['name', 'lastname', 'address'];
    protected $hidden = ['created_at', 'updated_at'];

}
