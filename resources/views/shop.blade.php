@extends('layout.produit')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection

@section('content')


<div class="container py-5">
  <div class="row align-items-center">

    <!-- Image du produit -->
    <div class="col-md-6 mb-4 mb-md-0">
      <div class="bg-light p-3 rounded-4 shadow-sm text-center">
        <img 
          src="{{ asset('produits/' . $produit->photo_principale) }}" 
          alt="{{ $produit->nom }}" 
          class="img-fluid rounded-3"
          style="max-height: 400px; object-fit: contain;"
        >
      </div>
    </div>

    <!-- Informations du produit -->
    <div class="col-md-6">
      <h1 class="display-5 fw-bold">{{ $produit->nom }}</h1>
      <p class="text-muted">{{ $produit->description }}</p>
      <h3 class="text-primary fw-semibold">
        {{ number_format($produit->prix, 2, ',', ' ') }} €
      </h3>

        <!-- Choix de la taille -->
        <div class="mb-3">
          <label for="taille" class="form-label">Taille</label>
          <select name="taille" id="taille" class="form-select" required>
            <option value="">-- Sélectionner une taille --</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
          </select>
        </div>

        <!-- Choix de la quantité -->
        <div class="mb-3">
          <label for="quantite" class="form-label">Quantité</label>
          <input type="number" name="quantite" id="quantite" class="form-control" value="1" min="1" max="25" required>
        </div>

        <!-- Bouton d'ajout au panier -->
        <button type="submit" class="btn btn-success btn-lg w-100">
          Ajouter au panier
        </button>
    </div>

  </div>
</div>

@endsection
