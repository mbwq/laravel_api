@extends('layout.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/connect.css') }}">
@endsection

@section('content')

   <div class="login-temple">
    <h2>Connexion Admin</h2>
    <form action="{{ route('connexion.admin') }}" method="POST">
        @csrf {{-- Sécurité Laravel obligatoire pour les formulaires POST --}}
        
        <label for="email">Email</label>
        <input type="Email" id="email" name="email" placeholder="Nom@exemple.com" required >
        
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
        <a href="/changer-mot-de-passe">Reiniatiliser votre mot de passe</a>


        <input type="submit" value="Se connecter">
    </form>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session('message'))
        <p style="color:green;">{{ session('message') }}</p>
    @endif

    <p>Pas encore inscrit ? <a href="{{ route('inscription.index') }}">Créer un compte</a></p>

    </div>

@endsection