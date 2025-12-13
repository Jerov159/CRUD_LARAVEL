<x-layout>
    <x-slot:title>Inventario de Productos</x-slot:title>

    <x-slot:styles>
        <link rel="stylesheet" href="{{ asset('css/posts/post.css') }}">
    </x-slot:styles>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>📦 Inventario de Productos</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-success">
            ➕ Nuevo Producto
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="products-table" class="table table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>
                                <strong>{{ $post->Nombre_Producto }}</strong>
                                <br>
                                <small class="text-muted">{{ Str::limit($post->Descripcion_Producto, 50) }}</small>
                            </td>
                            <td>{{ $post->category->name ?? 'Sin categoría' }}</td>
                            <td data-order="{{ $post->Precio_por_unidad }}">
                                ${{ number_format($post->Precio_por_unidad, 2) }}
                            </td>
                            <td data-order="{{ $post->Cantidad }}">
                                <span class="badge {{ $post->Cantidad <= 10 ? 'bg-danger' : 'bg-info' }}">
                                    {{ $post->Cantidad }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $post->Estado === 'disponible' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($post->Estado) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('posts.edit', $post) }}"
                                       class="btn btn-sm btn-warning"
                                       title="Editar">
                                        ✏️
                                    </a>
                                    <form action="{{ route('posts.destroy', $post) }}"
                                          method="POST"
                                          class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Eliminar">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @vite ('resources/js/posts/index.js')
</x-layout>
