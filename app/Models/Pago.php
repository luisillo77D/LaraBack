<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'amount', 'date','status'];

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class);
    }
}
