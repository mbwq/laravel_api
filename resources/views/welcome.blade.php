@extends('layout.app')

@section('content')

<h1>Bienvenue sur E-psg</h1>

@if (session('success'))
    <div class="alert alert-success">
        <h2>Voici votre espace {{ Auth::user()->name }}</h2>
    </div>
@endif

@php
$cartes = [
    ['texte' => 'Un exemple de texte descriptif pour la carte.'],
    ['texte' => 'Deuxième carte exemple.'],
    ['texte' => 'Troisième carte exemple.'],
];
@endphp

<main>
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach ($cartes as $carte)
          <div class="col">
            <div class="card shadow-sm">
              <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                   xmlns="http://www.w3.org/2000/svg" role="img">
                <rect width="100%" height="100%" fill="#55595c"></rect>
                <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
              </svg>
              <div class="card-body">
                <p class="card-text">{{ $carte['texte'] }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button class="btn btn-sm btn-outline-secondary">Voir</button>
                    <button class="btn btn-sm btn-outline-secondary">Éditer</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</main>



    <footer>
        <p>&copy; 2025 E-psg. Tous droits réservés.</p>
    </footer>


@endsection