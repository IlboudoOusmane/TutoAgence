<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PropertyFormRequest extends FormRequest
{

    public function authorize(): bool // Détermine si l'utilisateur est autorisé à effectuer cette requête.
    {

        return true;
    }


    public function rules(): array //  Obtenir les règles de validation qui s'appliquent à la requête.
    {
        return [
            'title' => ['required', 'min:8'],
            'description' => ['required', 'min:8'] ,
            'surface' => ['required', 'integer', 'min:10'],
            'rooms' => ['required', 'integer', 'min:1'],
            'bedrooms' => ['required', 'integer', 'min:0'],
            'floor' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'integer', 'min:0'],
            'city' => ['required', 'min:8'],
            'address' => ['required', 'min:8'],
            'postal_code' => ['required', 'min:2'],
            'sold' => ['required', 'boolean'],
            'options' => ['array', 'exists:options,id', 'required'],
        ];
    }

};
