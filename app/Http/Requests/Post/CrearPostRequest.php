<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class CrearPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'codigo_barras' => 'nullable|string|max:50|unique:posts,codigo_barras',
            'Nombre_Producto' => 'required|string|max:255',
            'Descripcion_Producto' => 'required|string',
            'lote' => 'nullable|string|max:50',
            'fecha_vencimiento' => 'nullable|date|after:today',
            'Precio_por_unidad' => 'required|numeric|min:0',
            'Cantidad' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'ubicacion' => 'nullable|string|max:100',
            'proveedor' => 'nullable|string|max:150',
            'Estado' => 'required|in:disponible,agotado',
            'requiere_receta' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages(): array {

        return [
            'Nombre_Producto.required' => 'El nombre del producto es obligatorio.',
            'codigo_barras.unique' => 'El código de barras ya está en uso.',
            'fecha_vencimiento.after' => 'La fecha de vencimiento debe ser una fecha futura.',
            'Precio_por_unidad.required' => 'El precio por unidad es obligatorio.',
        ];
    }
}
