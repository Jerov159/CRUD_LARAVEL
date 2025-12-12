<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'Nombre_Producto' => 'required|string|max:255',
            'Descripcion_Producto' => 'required|string',
            'Precio_por_unidad' => 'required|numeric|min:0',
            'Cantidad' => 'required|integer|min:0',
            'Estado' => 'required|in:disponible,agotado',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
