<?php

namespace App\Services\Post;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService {

    public function getAll(): LengthAwarePaginator
    {

        $query = Post::query();

        return $query->paginate(Post::PAGINATE);
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
