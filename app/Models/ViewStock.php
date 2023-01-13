<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewStock extends Model
{
    use HasFactory;

    protected $table = 'view_stocks';

    protected $fillable = [
        'id', 'nombreProducto', 'categoria', 'name', 'cantidad', 'vendida', 'disponible'
    ];
}
