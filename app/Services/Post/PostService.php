<?php

namespace App\Services\Post;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Database\Eloquent\Collection;


class PostService {

    public function getAll(): Collection
    {

        return Post::with('category')
            ->orderBy('Nombre_Producto')
            ->get();
    }

    public function find (int $id): Post {
        return Post::findOrFail($id);
    }

    public function create(array $data): Post
    {
        return Post::create($data);
    }

    public function update(Post $post, array $data): bool
    {
        return $post->update($data);
    }

    public function delete(Post $post): bool
    {
        return $post->delete();
    }

    public function getStats(): array
    {
        return [
            'total_products' => Post::count(),
            'low_stock' => Post::whereColumn('Cantidad', '<=', 'stock_minimo')->count(),
            'out_of_stock' => Post::where('Cantidad', 0)->count(),
            'about_to_expire' => Post::whereNotNull('fecha_vencimiento')
                ->whereBetween('fecha_vencimiento', [now(), now()->addDays(30)])
                ->count(),
            'expired' => Post::whereNotNull('fecha_vencimiento')
                ->where('fecha_vencimiento', '<', now())
                ->count(),
            'total_value' => Post::selectRaw('SUM(Precio_por_unidad * Cantidad) as total')
                ->value('total') ?? 0,
        ];
    }

    /**
     * Productos que requieren atención
     */
    public function getAlerts(): Collection
    {
        return Post::with('category')
            ->where(function ($query) {
                $query->whereColumn('Cantidad', '<=', 'stock_minimo')
                    ->orWhere(function ($q) {
                        $q->whereNotNull('fecha_vencimiento')
                            ->where('fecha_vencimiento', '<=', now()->addDays(30));
                    });
            })
            ->get();
    }
}
