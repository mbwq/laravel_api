@extends('layout.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/connect.css') }}">
@endsection

@section('content')

   <div class="login-temple">
    <h2>Connexion</h2>
    <form action="/login" method="post">
        <label for="username">Email</label>
        <input type="password" id="password" name="motpasse" placeholder="Nom@exemple.com" required >
        
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Se connecter">
    </form>
    </div>

@endsection