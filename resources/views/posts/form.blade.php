<x-layout>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        {{ $post->exists ? '✏️ Editar Producto' : '➕ Nuevo Producto' }}
                    </h4>
                </div>
                <div class="card-body">

                    {{-- Mostrar errores de validación --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ $post->exists ? route('posts.update', $post) : route('posts.store') }}" method="POST">
                        @csrf
                        @if($post->exists)
                            @method('PUT')
                        @endif

                        {{-- Nombre del producto --}}
                        <div class="mb-3">
                            <label for="Nombre_Producto" class="form-label">Nombre del Producto *</label>
                            <input type="text"
                                   class="form-control @error('Nombre_Producto') is-invalid @enderror"
                                   id="Nombre_Producto"
                                   name="Nombre_Producto"
                                   value="{{ old('Nombre_Producto', $post->Nombre_Producto) }}"
                                   placeholder="Ej: Paracetamol 500mg"
                                   required>
                            @error('Nombre_Producto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Descripción --}}
                        <div class="mb-3">
                            <label for="Descripcion_Producto" class="form-label">Descripción *</label>
                            <textarea class="form-control @error('Descripcion_Producto') is-invalid @enderror"
                                      id="Descripcion_Producto"
                                      name="Descripcion_Producto"
                                      rows="3"
                                      placeholder="Descripción del producto..."
                                      required>{{ old('Descripcion_Producto', $post->Descripcion_Producto) }}</textarea>
                            @error('Descripcion_Producto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            {{-- Precio --}}
                            <div class="col-md-6 mb-3">
                                <label for="Precio_por_unidad" class="form-label">Precio por Unidad *</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number"
                                           class="form-control @error('Precio_por_unidad') is-invalid @enderror"
                                           id="Precio_por_unidad"
                                           name="Precio_por_unidad"
                                           value="{{ old('Precio_por_unidad', $post->Precio_por_unidad) }}"
                                           step="0.01"
                                           min="0"
                                           placeholder="0.00"
                                           required>
                                    @error('Precio_por_unidad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Cantidad --}}
                            <div class="col-md-6 mb-3">
                                <label for="Cantidad" class="form-label">Cantidad en Stock *</label>
                                <input type="number"
                                       class="form-control @error('Cantidad') is-invalid @enderror"
                                       id="Cantidad"
                                       name="Cantidad"
                                       value="{{ old('Cantidad', $post->Cantidad ?? 0) }}"
                                       min="0"
                                       required>
                                @error('Cantidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            {{-- Estado --}}
                            <div class="col-md-6 mb-3">
                                <label for="Estado" class="form-label">Estado *</label>
                                <select class="form-select @error('Estado') is-invalid @enderror"
                                        id="Estado"
                                        name="Estado"
                                        required>
                                    <option value="">Seleccionar...</option>
                                    <option value="disponible" {{ old('Estado', $post->Estado) === 'disponible' ? 'selected' : '' }}>
                                        Disponible
                                    </option>
                                    <option value="agotado" {{ old('Estado', $post->Estado) === 'agotado' ? 'selected' : '' }}>
                                        Agotado
                                    </option>
                                </select>
                                @error('Estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Categoría --}}
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Categoría *</label>
                                <select class="form-select @error('category_id') is-invalid @enderror"
                                        id="category_id"
                                        name="category_id"
                                        required>
                                    <option value="">Seleccionar categoría...</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Botones --}}
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-success">
                                💾 {{ $post->exists ? 'Actualizar' : 'Guardar' }}
                            </button>
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                                ↩️ Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
