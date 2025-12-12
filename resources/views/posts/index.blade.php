<x-layout>
    <h1 class="my-4">📦 Inventario de Farmacia</h1>

    {{-- Mensajes de éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Botón crear --}}
    <div class="mb-3">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            ➕ Nuevo Producto
        </a>
    </div>

    {{-- Tabla de productos --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->Nombre_Producto }}</td>
                        <td>{{ Str::limit($post->Descripcion_Producto, 50) }}</td>
                        <td>${{ number_format($post->Precio_por_unidad, 2) }}</td>
                        <td>
                            <span class="badge {{ $post->Cantidad <= 5 ? 'bg-danger' : 'bg-success' }}">
                                {{ $post->Cantidad }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $post->Estado === 'disponible' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($post->Estado) }}
                            </span>
                        </td>
                        <td>{{ $post->category->name ?? 'Sin categoría' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">
                                    ✏️ Editar
                                </a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar este producto?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            No hay productos registrados. ¡Agrega el primero!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</x-layout>
