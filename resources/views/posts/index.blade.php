<x-layout>
    <x-slot:title>Inventario de Productos</x-slot:title>

    <x-slot:styles>
        @vite(['resources/css/posts/post.css'])
    </x-slot:styles>

    {{-- Panel de Estadísticas --}}
    <div class="row mb-4">
        <div class="col-md-2">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h3>{{ $stats['total_products'] }}</h3>
                    <small>Total Productos</small>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card bg-warning text-dark">
                <div class="card-body text-center">
                    <h3>{{ $stats['low_stock'] }}</h3>
                    <small>Stock Bajo</small>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card bg-danger text-white">
                <div class="card-body text-center">
                    <h3>{{ $stats['out_of_stock'] }}</h3>
                    <small>Agotados</small>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card bg-orange text-white" style="background-color: #fd7e14;">
                <div class="card-body text-center">
                    <h3>{{ $stats['about_to_expire'] }}</h3>
                    <small>Por Vencer</small>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card bg-dark text-white">
                <div class="card-body text-center">
                    <h3>{{ $stats['expired'] }}</h3>
                    <small>Vencidos</small>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h3>${{ number_format($stats['total_value'], 2) }}</h3>
                    <small>Valor Total</small>
                </div>
            </div>
        </div>
    </div>

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
                        {{-- <th>ID</th> --}}
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Lote</th>
                        <th>Vencimiento</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr
                            class="{{ $post->isExpired() ? 'table-danger' : ($post->isAboutToExpire() ? 'table-warning' : '') }}">
                            <td>{{ $post->codigo_barras ?? '-' }}</td>
                            <td>
                                <strong>{{ $post->Nombre_Producto }}</strong>
                                @if ($post->requiere_receta)
                                    <span class="badge bg-info">Rx</span>
                                @endif
                            </td>
                            <td>{{ $post->category->name ?? 'Sin categoría' }}</td>
                            <td>{{ $post->lote ?? '-' }}</td>
                            <td>
                                @if ($post->fecha_vencimiento)
                                    {{ $post->fecha_vencimiento->format('d/m/Y') }}
                                    @if ($post->isExpired())
                                        <span class="badge bg-danger">Vencido</span>
                                    @elseif($post->isAboutToExpire())
                                        <span class="badge bg-warning text-dark">Pronto</span>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>${{ number_format($post->Precio_por_unidad, 2) }}</td>
                            <td>
                                <span class="badge {{ $post->isLowStock() ? 'bg-danger' : 'bg-success' }}">
                                    {{ $post->Cantidad }} / {{ $post->stock_minimo }}
                                </span>
                            </td>
                            <td>
                                <span
                                    class="badge {{ $post->Estado === 'disponible' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($post->Estado) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">✏️</a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                        class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-slot:scripts>
    @vite ('resources/js/posts/index.js')
    </x-slot:scripts>
</x-layout>
