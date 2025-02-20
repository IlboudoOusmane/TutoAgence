<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>@yield('title')</title>
    <style >
       @layer reset {
          button {
            all: unset;
          }
       }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container-fluid">
       <a class="navbar-brand" href="/">Agence</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          @php
          $route = request()->route()->getName();
          @endphp

          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">

                <li class="nav-item">
                    <a href="{{ route('property.index') }}" @class(['nav-link', 'active' => str_contains($route, 'property.')]) >Biens</a>
                </li>

              </ul>

              <div class="ml-auto">
                 @auth
                   <ul class="navbar-nav">
                      <li class="nav-item">
                          <form class="" action="{{ route('logout') }}" method="post">
                             @csrf

                             @method('delete')
                             <button class="nav-link ">Se Déconnecter</button>
                          </form>
                      </li>
                   </ul>
                 @endauth
              </div>

         </div>
    </div>
</nav>

  @include('shared.flash')
  @yield('content')

</body>
</html>
