<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Post\CrearPostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Services\Post\PostService;
use App\Models\Category;

class PostController extends Controller
{

    public function __construct(protected PostService $service)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->service->getAll();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::orderBy('name')->get();

        return view('posts.form', compact('post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CrearPostRequest $request)
    {

        $this->service->create($request->validated());

        return redirect()->route('posts.index')->with('success', 'Producto created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->service->update($post, $request->validated());

        return redirect()->route('posts.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->service->delete($post);

        return redirect()->route('posts.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
