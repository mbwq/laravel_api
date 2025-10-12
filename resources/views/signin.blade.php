@extends('layout.app')

@section('content')
<div class="signin-template">
    <h2>Inscription</h2>

    <form action="{{ route('inscription.new') }}" method="POST">
        @csrf

        <label for="name">Nom</label>
        <li><input type="text" id="name" name="name" required></li>

        <label for="firstname">Prénom</label>
        <li><input type="text" id="firstname" name="firstname" required></li>

        <label for="email">Email</label>
        <li><input type="email" id="email" name="email" required></li>

        <label for="password">Mot de passe</label>
        <li><input type="password" id="password" name="password" required></li>

        <label for="password_confirmation">Confirmer le mot de passe</label>
        <li><input type="password" id="password_confirmation" name="password_confirmation" required></li>

        <input type="submit" value="S'inscrire">
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
</div>
@endsection
