<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OptionFormRequest extends FormRequest
{

    public function authorize(): bool // Détermine si l'utilisateur est autorisé à effectuer cette requête.
    {

        return true;
    }


    public function rules(): array //  Obtenir les règles de validation qui s'appliquent à la requête.
    {
        return [
            'name' => ['required', 'min:3'],
        ];
    }

};
