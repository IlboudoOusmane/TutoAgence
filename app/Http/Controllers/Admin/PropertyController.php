<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyFormRequest;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{

    public function index() // Afficher une liste des ressources.
    {
        return view('admin.properties.index', [
          'properties' => Property::orderBy('created_at', 'desc')->paginate(25)
        ]);
    }


    public function create() // Afficher le formulaire pour créer une nouvelle ressource.
    {
        $property = new Property();
        $property->fill([
           'surface' => 40,
           'rooms' => 3,
           'bedrooms' => 1,
           'floor' => 0,
           'city' => 'Ouagadougou',
           'postal_code' => 34000,
           'sold' => false,
        ]);

        return view('admin.properties.form', [
          'property' => $property,
          'options' => Option::pluck('name', 'id'),
        ]);
    }


    public function store(PropertyFormRequest $request) //  Enregistrer une nouvelle ressource dans le stockage.
    {
        $property = Property::create($request->validated());
        $property->options()->sync($request->validated('options'));
        return to_route('admin.property.index')->with('success', 'Le Bien a bien été créé');
    }



    public function edit(Property $property) // Afficher le formulaire pour modifier la ressource spécifiée.
    {
        return view('admin.properties.form', [
          'property' => $property,
          'options' => Option::pluck('name', 'id'),
        ]);
    }


    public function update(PropertyFormRequest $request, Property $property) // Mettre à jour la ressource spécifiée dans le stockage.
    {
        $property->update($request->validated());
        $property->options()->sync($request->validated('options'));
        return to_route('admin.property.index')->with('success', 'Le Bien a bien été Modifié');
    }


    public function destroy(Property $property) // Supprimer la ressource spécifiée du stockage.
    {
        $property->delete();
        return to_route('admin.property.index')->with('success', 'Le Bien a bien été Supprimé');
    }

};
