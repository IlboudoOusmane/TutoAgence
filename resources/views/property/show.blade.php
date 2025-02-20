@extends('base')

@section('title', $property->title)

@section('content')

<div class="container mt-4">
    <h1>{{ $property->title }}</h1>
    <h2>{{ $property->rooms }} pièces - {{ $property->surface }}m²</h2>


    <div class="text-primary fw-bold" style="font-size: 2rem;">
       {{ number_format($property->price, thousands_separator: ' ') }} €
    </div>

    <hr>

    <div class="mt-4">
       <h4> Intéressé par ce bien ? </h4>

          @include('shared.flash')

       <form class="vstack gap-3" action="{{ route('property.contact', $property) }}" method="post">
           @csrf

            <div class="row ">
                @include('shared.input', ['label' => 'Prenom', 'class' => 'col-md-5', 'name' => 'firstname'])
                @include('shared.input', ['label' => 'Nom', 'class' => 'col-md-5', 'name' => 'lastname'])
            </div>

            <div class="row ">
                @include('shared.input', ['label' => 'Téléphone', 'class' => 'col-md-5', 'name' => 'phone'])
                @include('shared.input', ['type' => 'email', 'label' => 'Email', 'class' => 'col-md-5', 'name' => 'email'])
            </div>

            @include('shared.input', ['type' => 'textarea', 'label' => 'Votre message', 'class' => 'col-md-10', 'name' => 'message'])

            <div>
               <button class="btn btn-primary">Nous contacter</button>
            </div>
       </form>
    </div>

    <div class="mt-4">
      <h4>Description</h4>
        <p>{!! nl2br($property->description) !!}</p>

        <div class="row">

           <div class="col-8">
              <h4>Caractéristique</h4>

                  <table class="table striped">
                     <tr>
                        <td>Surface habitable</td>
                        <td>{{ $property->surface }}m²</td>
                     </tr>

                     <tr>
                        <td>Pièces</td>
                        <td>{{ $property->rooms }}</td>
                     </tr>

                     <tr>
                        <td>Chambres</td>
                        <td>{{ $property->bedrooms }}</td>
                     </tr>

                     <tr>
                        <td>Etages</td>
                        <td>{{ $property->floor ?: 'Rez de chaussé' }}</td>
                     </tr>

                     <tr>
                        <td>Localisation</td>
                        <td>
                           {{ $property->address }} <br>
                           {{ $property->city }} ({{ $property->postal_code }})
                        </td>
                     </tr>
                  </table>
           </div>

           <div class="col-4">
              <h2>Spécificités</h2>

              <ul class="list-group">
                 @foreach($property->options as $option)
                     <li class="list-group-item">{{ $option->name }}</li>
                 @endforeach
              </ul>
           </div>

        </div>
    </div>




</div>

@endsection
