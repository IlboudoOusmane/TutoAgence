@extends('base')


@section('content')


    <div class="container">
        <h1 class="text-center">Mon Agence</h1>
            <p>L'agence immobilière que nous proposons est une entreprise dédiée à la gestion, à la vente, à la location et à l'achat de biens immobiliers.
            Nous mettons à disposition notre expertise pour accompagner nos clients, qu'ils soient à la recherche de leur futur logement ou qu'ils souhaitent investir dans l'immobilier.</p>
    </div>
</div>

<div class="container mt-4">
    <h2>Nos derniers biens</h2>
      <div class="row">
          @foreach($properties as $property)
              <div class="col">
                  @include('property/card')
              </div>
            @endforeach
      </div>

</div>



@endsection
