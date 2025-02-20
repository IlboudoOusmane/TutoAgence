@extends('base')

@section('title', 'Tous nos biens')

@section('content')


<div class="bg-light p-5 mb-5 text-center">
    <form class="container d-flex " action="" method="get">
        <input type="number" placeholder="Nombre de pièce minimun" class="form-control" value="{{ $input['rooms'] ?? '' }}" name="rooms">
        <input type="number" placeholder="surface minimum" class="form-control" value="{{ $input['surface'] ?? '' }}" name="surface">
        <input type="number" placeholder="Budget max" class="form-control" value="{{ $input['price'] ?? '' }}" name="price">
        <input placeholder="Mot clé" class="form-control" value="{{ $input['title'] ?? '' }}" name="title">
        <button class="btn btn-primary btn-sm flex-grow-0">Rechercher</button>
    </form>
</div>


<div class="container">
   <div class="row">
       @forelse($properties as $property)
           <div class="col-3 mb-4">
               @include('property/card')
           </div>
        @empty
          <div class="col">
              Aucun bien ne correspond à votre recherche
          </div>
        @endforelse

   </div>

   <div class="my-4">
      {{ $properties->links() }}
   </div>

</div>


@endsection
