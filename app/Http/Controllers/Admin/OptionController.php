<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OptionFormRequest;
use Illuminate\Http\Request;
use App\Models\Option;

class OptionController extends Controller
{

    public function index() // Afficher une liste des ressources.
    {
        return view('admin.options.index', [
          'options' => Option::paginate(25)
        ]);
    }


    public function create() // Afficher le formulaire pour créer une nouvelle ressource.
    {
        $option = new Option();
        return view('admin.options.form', [
          'option' => $option,
        ]);
    }


    public function store(OptionFormRequest $request) //  Enregistrer une nouvelle ressource dans le stockage.
    {
        $option = Option::create($request->validated());
        return to_route('admin.option.index')->with('success', "L'Option a bien été créé");
    }



    public function edit(Option $option) // Afficher le formulaire pour modifier la ressource spécifiée.
    {
        return view('admin.options.form', [
          'option' => $option
        ]);
    }


    public function update(OptionFormRequest $request, Option $option) // Mettre à jour la ressource spécifiée dans le stockage.
    {
        $option->update($request->validated());
        return to_route('admin.option.index')->with('success', "L'Option a bien été Modifié");
    }


    public function destroy(Option $option) // Supprimer la ressource spécifiée du stockage.
    {
        $option->delete();
        return to_route('admin.option.index')->with('success', "L'Option a bien été Supprimé" );
    }

};
