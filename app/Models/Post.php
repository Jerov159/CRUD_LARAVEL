<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nombre_Producto',
        'Descripcion_Producto',
        'Precio_por_unidad',
        'Cantidad',
        'Estado',
        'category_id',
    ];

    public const PAGINATE = 5;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
