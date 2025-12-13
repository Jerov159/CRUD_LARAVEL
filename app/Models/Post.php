<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'codigo_barras',
        'Nombre_Producto',
        'Descripcion_Producto',
        'lote',
        'fecha_vencimiento',
        'Precio_por_unidad',
        'Cantidad',
        'stock_minimo',
        'ubicacion',
        'proveedor',
        'requiere_receta',
        'Estado',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function isAboutToExpire(): bool
    {
        if (!$this->fecha_vencimiento) {
            return false;
        }

        return $this->fecha_vencimiento->diffInDays(now()) <= 30;
    }

    /**
     * Verifica si el producto ya venció
     */
    public function isExpired(): bool
    {
        if (!$this->fecha_vencimiento) {
            return false;
        }

        return $this->fecha_vencimiento->isPast();
    }

    /**
     * Verifica si el stock está bajo
     */
    public function isLowStock(): bool
    {
        return $this->Cantidad <= $this->stock_minimo;
    }

    /**
     * Scope: Productos con stock bajo
     */
    public function scopeLowStock($query)
    {
        return $query->whereColumn('Cantidad', '<=', 'stock_minimo');
    }

    /**
     * Scope: Productos próximos a vencer
     */
    public function scopeAboutToExpire($query, int $days = 30)
    {
        return $query->whereNotNull('fecha_vencimiento')
            ->whereBetween('fecha_vencimiento', [now(), now()->addDays($days)]);
    }

    /**
     * Scope: Productos vencidos
     */
    public function scopeExpired($query)
    {
        return $query->whereNotNull('fecha_vencimiento')
            ->where('fecha_vencimiento', '<', now());
    }
}
