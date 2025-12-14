<x-layout>
    <x-slot:title>
        {{ $post->exists ? 'Editar Producto' : 'Nuevo Producto' }}
    </x-slot:title>

    {{-- <x-slot:styles>
        @vite(['resources/css/posts/post.css'])
    </x-slot:styles> --}}

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        {{ $post->exists ? '✏️ Editar Producto' : '➕ Nuevo Producto' }}
                    </h4>
                </div>
                <div class="card-body">

                    {{-- Errores de validación --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Por favor corrige los siguientes errores:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ $post->exists ? route('posts.update', $post) : route('posts.store') }}"
                          method="POST">
                        @csrf
                        @if ($post->exists)
                            @method('PUT')
                        @endif

                        {{-- Sección: Información Básica --}}
                        <fieldset class="mb-4">
                            <legend class="h5 text-primary border-bottom pb-2">
                                📋 Información Básica
                            </legend>

                            <div class="row">
                                {{-- Código de Barras --}}
                                <div class="col-md-4 mb-3">
                                    <label for="codigo_barras" class="form-label">Código de Barras</label>
                                    <input type="text"
                                           class="form-control @error('codigo_barras') is-invalid @enderror"
                                           id="codigo_barras"
                                           name="codigo_barras"
                                           value="{{ old('codigo_barras', $post->codigo_barras) }}"
                                           placeholder="Ej: 7501234567890">
                                    @error('codigo_barras')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Nombre del Producto --}}
                                <div class="col-md-8 mb-3">
                                    <label for="Nombre_Producto" class="form-label">
                                        Nombre del Producto <span class="text-danger">*</span>
                                    </label>
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
                            </div>

                            <div class="row">
                                {{-- Descripción --}}
                                <div class="col-12 mb-3">
                                    <label for="Descripcion_Producto" class="form-label">
                                        Descripción <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('Descripcion_Producto') is-invalid @enderror"
                                              id="Descripcion_Producto"
                                              name="Descripcion_Producto"
                                              rows="3"
                                              placeholder="Descripción del medicamento, indicaciones, etc."
                                              required>{{ old('Descripcion_Producto', $post->Descripcion_Producto) }}</textarea>
                                    @error('Descripcion_Producto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                {{-- Categoría --}}
                                <div class="col-md-6 mb-3">
                                    <label for="category_id" class="form-label">
                                        Categoría <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('category_id') is-invalid @enderror"
                                            id="category_id"
                                            name="category_id"
                                            required>
                                        <option value="">-- Seleccionar categoría --</option>
                                        @foreach ($categories as $category)
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

                                {{-- Proveedor --}}
                                <div class="col-md-6 mb-3">
                                    <label for="proveedor" class="form-label">Proveedor</label>
                                    <input type="text"
                                           class="form-control @error('proveedor') is-invalid @enderror"
                                           id="proveedor"
                                           name="proveedor"
                                           value="{{ old('proveedor', $post->proveedor) }}"
                                           placeholder="Ej: Laboratorios Bayer">
                                    @error('proveedor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        {{-- Sección: Control de Lote --}}
                        <fieldset class="mb-4">
                            <legend class="h5 text-primary border-bottom pb-2">
                                🏷️ Control de Lote
                            </legend>

                            <div class="row">
                                {{-- Lote --}}
                                <div class="col-md-4 mb-3">
                                    <label for="lote" class="form-label">Número de Lote</label>
                                    <input type="text"
                                           class="form-control @error('lote') is-invalid @enderror"
                                           id="lote"
                                           name="lote"
                                           value="{{ old('lote', $post->lote) }}"
                                           placeholder="Ej: LOT-2025-001">
                                    @error('lote')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Fecha de Vencimiento --}}
                                <div class="col-md-4 mb-3">
                                    <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                                    <input type="date"
                                           class="form-control @error('fecha_vencimiento') is-invalid @enderror"
                                           id="fecha_vencimiento"
                                           name="fecha_vencimiento"
                                           value="{{ old('fecha_vencimiento', $post->fecha_vencimiento?->format('Y-m-d')) }}">
                                    @error('fecha_vencimiento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Ubicación --}}
                                <div class="col-md-4 mb-3">
                                    <label for="ubicacion" class="form-label">Ubicación en Almacén</label>
                                    <input type="text"
                                           class="form-control @error('ubicacion') is-invalid @enderror"
                                           id="ubicacion"
                                           name="ubicacion"
                                           value="{{ old('ubicacion', $post->ubicacion) }}"
                                           placeholder="Ej: Estante A-3">
                                    @error('ubicacion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        {{-- Sección: Precios y Stock --}}
                        <fieldset class="mb-4">
                            <legend class="h5 text-primary border-bottom pb-2">
                                💰 Precios y Stock
                            </legend>

                            <div class="row">
                                {{-- Precio --}}
                                <div class="col-md-3 mb-3">
                                    <label for="Precio_por_unidad" class="form-label">
                                        Precio Unitario <span class="text-danger">*</span>
                                    </label>
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
                                <div class="col-md-3 mb-3">
                                    <label for="Cantidad" class="form-label">
                                        Cantidad en Stock <span class="text-danger">*</span>
                                    </label>
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

                                {{-- Stock Mínimo --}}
                                <div class="col-md-3 mb-3">
                                    <label for="stock_minimo" class="form-label">
                                        Stock Mínimo <span class="text-danger">*</span>
                                    </label>
                                    <input type="number"
                                           class="form-control @error('stock_minimo') is-invalid @enderror"
                                           id="stock_minimo"
                                           name="stock_minimo"
                                           value="{{ old('stock_minimo', $post->stock_minimo ?? 10) }}"
                                           min="0"
                                           required>
                                    <small class="text-muted">Alerta cuando el stock baje de este valor</small>
                                    @error('stock_minimo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Estado --}}
                                <div class="col-md-3 mb-3">
                                    <label for="Estado" class="form-label">
                                        Estado <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('Estado') is-invalid @enderror"
                                            id="Estado"
                                            name="Estado"
                                            required>
                                        <option value="disponible"
                                            {{ old('Estado', $post->Estado) === 'disponible' ? 'selected' : '' }}>
                                            Disponible
                                        </option>
                                        <option value="agotado"
                                            {{ old('Estado', $post->Estado) === 'agotado' ? 'selected' : '' }}>
                                            Agotado
                                        </option>
                                    </select>
                                    @error('Estado')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        {{-- Sección: Opciones Adicionales --}}
                        <fieldset class="mb-4">
                            <legend class="h5 text-primary border-bottom pb-2">
                                ⚙️ Opciones Adicionales
                            </legend>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="requiere_receta" value="0">
                                        <input type="checkbox"
                                               class="form-check-input @error('requiere_receta') is-invalid @enderror"
                                               id="requiere_receta"
                                               name="requiere_receta"
                                               value="1"
                                               {{ old('requiere_receta', $post->requiere_receta) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="requiere_receta">
                                            <strong>💊 Requiere Receta Médica</strong>
                                            <br>
                                            <small class="text-muted">
                                                Marcar si este medicamento necesita prescripción médica para su venta
                                            </small>
                                        </label>
                                        @error('requiere_receta')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        {{-- Botones --}}
                        <div class="d-flex gap-2 justify-content-end border-top pt-4">
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                                ❌ Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ $post->exists ? '💾 Actualizar Producto' : '✅ Guardar Producto' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <x-slot:scripts>
        @vite(['resources/js/posts/form.js'])
    </x-slot:scripts> --}}
</x-layout>
