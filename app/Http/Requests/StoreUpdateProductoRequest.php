<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route('producto');
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => 'required|numeric|min:0|max:100000',
            // 'alias' => [
            //     'required',
            //     'string',
            //     'max:255',
            //     Rule::unique('productos', 'alias')->ignore($id)
            // ],
            // 'description' => ['required', 'string'],
            'description' => ['string', 'max:255'],
            'file' => ['file', 'mimes:jpeg,png', 'max:2048'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            // 'sku' => [
            //     'string',
            //     'min:8',
            //     'max:12',
            //     Rule::unique('productos', 'sku')->ignore($id)
            // ]
        ];
    }
}
