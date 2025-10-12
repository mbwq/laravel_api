@extends('layout.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/connect.css') }}">
@endsection

@section('content')

   <div class="login-temple">
    <h2>Connexion</h2>
    <form action="/login" method="POST">
        @csrf {{-- Sécurité Laravel obligatoire pour les formulaires POST --}}
        
        <label for="username">Email</label>
        <input type="Email" id="email" name="email" placeholder="Nom@exemple.com" required >
        
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
        <a href="/changer-mot-de-passe">Reiniatiliser votre mot de passe</a>


        <input type="submit" value="Se connecter">
    </form>
    </div>

@endsection