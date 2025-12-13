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
}
