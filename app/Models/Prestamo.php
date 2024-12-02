<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Prestamo extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'id',
        'amount',
        'date',
        'due_date',
        'status',
        'cliente_id',
    ];

    protected $casts = [
        'status' => 'boolean', // Para que Laravel lo maneje como booleano
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
