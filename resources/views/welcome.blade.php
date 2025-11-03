@extends('layout.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection

@section('content')

<h1>Bienvenue sur E-PSG</h1>

@if (session('success'))
    <div class="alert alert-success">
        <h2>Voici votre espace {{ $user->firstname }} {{ $user->name }}</h2>
    </div>
    <form action="{{ logout }}" method="POST">
      @csrf
      <button type="submit">Se déconnecter</button>
    </form>
@endif


<main class="produits-section py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold">Nos Produits</h2>

    <div class="row g-4">
      @foreach($produits as $produit)
        <div class="col-md-4 col-sm-6">
          <div class="card produit-card h-100">

            <!-- Image du produit -->
            <img 
              src="{{ asset('produits/' . $produit->photo_principale) }}"
              alt="{{ $produit->nom }}" 
              class="card-img-top produit-image"
            >

            <!-- Contenu -->
            <div class="card-body d-flex flex-column">
              <h5 class="card-title produit-nom">{{ $produit->nom }}</h5>
              <p class="card-text produit-description">
                {{ Str::limit($produit->description, 120, '...') }}
              </p>

              <div class="mt-auto">
                <p class="produit-prix">
                  {{ number_format($produit->prix, 2, ',', ' ') }} €
                </p>
                <div class="d-flex justify-content-between">
                  <a href="{{ route('welcome.produit', $produit->id) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                    <i class="bi bi-eye"></i> Voir
                  </a>
                </div>
              </div>
            </div>

          </div>
        </div>
      @endforeach
    </div>
  </div>
</main>



    <footer>
      <div class="footer-links">
        <a href="#">Accueil</a>
        <a href="#">À propos</a>
        <a href="#">Contact</a>
      </div>
        <p>&copy; 2025 E-psg. Tous droits réservés.</p>
    </footer>

@endsection