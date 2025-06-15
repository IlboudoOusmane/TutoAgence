<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyContactRequest;
use App\Http\Requests\SearchPropertyRequest;
use App\Mail\PropertyContactMail;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PropertyController extends Controller
{

    // Affiche la liste des propriétés avec la possibilité de filtrer
    public function index(SearchPropertyRequest $request)
    {
        $query = Property::query()->orderBy('created_at', 'desc'); // Démarre une requête triée par date de création (plus récent en premier)

        if ($price = $request->validated('price')) { // Si un prix maximal est fourni, filtre les propriétés par ce prix
            $query = $query->where('price', '<=', $price);
        }

        if ($surface = $request->validated('surface')) { // Si une surface minimale est fournie, filtre les propriétés par cette surface
            $query = $query->where('surface', '>=', $surface);
        }

        if ($rooms = $request->validated('rooms')) { // Si un nombre minimal de pièces est fourni, filtre les propriétés par ce nombre
            $query = $query->where('rooms', '>=', $rooms);
        }

        if ($title = $request->validated('title')) { // Si un titre est fourni, recherche les propriétés dont le titre correspond
            $query = $query->where('title', 'like', "%{$title}%");
        }

        // Retourne la vue avec la liste paginée des propriétés et les filtres utilisés
        return view('property.index', [
            'properties' => $query->paginate(16),
            'input' => $request->validated()
        ]);
    }

    // Affiche une page de détail pour une propriété
    public function show(string $slug, Property $property)
    {
        $expectedSlug = $property->getSlug(); // Récupère le slug généré pour la propriété

        if ($slug != $expectedSlug) { // Si le slug de l’URL n’est pas le bon, redirige vers la bonne URL
            to_route('property.show', ['slug' => $expectedSlug, 'property' => $property]);
        }

        // Retourne la vue de la propriété avec ses détails
        return view('property.show', [
            'property' => $property
        ]);
    }

    // Traite l’envoi du formulaire de contact pour une propriété
    public function contact(PropertyContactRequest $request, Property $property)
    {
        Mail::send(new PropertyContactMail($property, $request->validated())); // Envoie un mail avec les infos du contact
        return back()->with('Votre demande de contacte a bien été envoyé'); // Retourne à la page précédente avec un message de succès
    }

}
