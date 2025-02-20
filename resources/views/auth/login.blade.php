@extends('base')

@section('title', 'Se connecter')


@section('content')

<div class="mt-4 container">
    <h1>@yield('title')</h1>
</div>

<div class="container gap-3">
  <form class="vstack gap-3" action="{{ route('login')}}" method="post">
        @csrf

        @include('shared.input', ['type' => 'email', 'label' => 'Email', 'class' => 'col-md-5', 'name' => 'email'])
        @include('shared.input', ['type' => 'password', 'label' => 'Mot de passe', 'class' => 'col-md-5', 'name' => 'password'])

        <button class="btn btn-primary">Se connecter</button>
  </form>
</div>


@endsection
