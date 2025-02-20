@extends('admin.admin')

@section('title', $property->exists ? "Editer un bien" : "Créer un bien")

@section('content')

    <h1>@yield('title')</h1>

    <form class="vstack gap-2" action="{{ route($property->exists ? 'admin.property.update' : 'admin.property.store', $property) }}" method="post">
        @csrf
        @method($property->exists ? 'put' : 'post')


        <div class="row">
            @include('shared.input', ['label' => 'Titre', 'class' => 'col', 'name' => 'title', 'value' => $property->title])

            <div class="col row">
                @include('shared.input', ['class' => 'col', 'name' => 'surface', 'value' => $property->surface])

                @include('shared.input', ['label' => 'Prix', 'class' => 'col', 'name' => 'price', 'value' => $property->price])
            </div>
        </div>

        @include('shared.input', ['type' => 'textarea', 'name' => 'description', 'value' => $property->description])

        <div class="row">
          @include('shared.input', ['label' => 'Pièces', 'class' => 'col', 'name' => 'rooms', 'value' => $property->rooms])
          @include('shared.input', ['label' => 'Chambres', 'class' => 'col', 'name' => 'bedrooms', 'value' => $property->bedrooms])
          @include('shared.input', ['label' => 'Etages', 'class' => 'col', 'name' => 'floor', 'value' => $property->floor])
        </div>

        <div class="row">
          @include('shared.input', ['label' => 'Address', 'class' => 'col', 'name' => 'address', 'value' => $property->address])
          @include('shared.input', ['label' => 'Ville', 'class' => 'col', 'name' => 'city', 'value' => $property->city])
          @include('shared.input', ['label' => 'Code Postal', 'class' => 'col', 'name' => 'postal_code', 'value' => $property->postal_code])
        </div>

        @include('shared.select', ['label' => 'Options', 'name' => 'options', 'value' => $property->options()->pluck('id'), 'multiple' => true])
        @include('shared.checkbox', ['label' => 'Vendu','name' => 'sold', 'value' => $property->sold, 'options' => $options])

        <div class="">
           <button class="btn btn-primary">
               @if($property->exists)
                   Modifier
               @else
                   Créer
               @endif
           </button>
        </div>

    </form>

@endsection
