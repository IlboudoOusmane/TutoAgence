@extends('admin.admin')

@section('title')

@section('content')

  <div class="d-flex justify-content-between align-items-center">
      <h1>@yield('title')</h1>
      <a href="{{ route('admin.option.create') }}" class="btn btn-primary ml-auto"> Ajouter une Option</a>
  </div>

  <table class="table table-striped">
      <thead>
          <tr>
              <th>Nom</th>
              <th class="text-right">Action</th>
          </tr>
      </thead>

      <tbody>
          @foreach($options as $option)
              <tr>
                <td>{{ $option->name }}</td>

                <td>
                  <div class="d-flex gap-2 w-100 justify-content-end ms-3">

                    <a href="{{ route('admin.option.edit', $option) }}" class="btn btn-primary">Modifier</a>

                    <form action="{{ route('admin.option.destroy', $option) }}" method="post">
                        @csrf
                        @method('delete')

                        <button class="btn btn-danger">Supprimer</button>
                    </form>

                  </div>
                </td>

              </tr>
          @endforeach
      </tbody>
  </table>

    {{ $options->links() }}

@endsection
