@extends('layouts.main')

@section('title', 'Fiche d\'un artiste')

@section('content')
    <h1>{{ $artist->firstname }} {{ $artist->lastname }}</h1>  

    <div><a href="{{ route('artist.edit' ,$artist->id) }}">Modifier</a></div>
<form method="post" action="{{ route('artist.delete', $artist->id) }}">
	@csrf
	@method('DELETE')
	<button>Supprimer</button>
</form>

<h2>Liste des types</h2>
    <ul>
    @foreach($artist->types as $type)    
        <li>{{ $type->type }}</li>
    @endforeach
    </ul>


    <nav><a href="{{ route('artist.index') }}">Retour à l'index</a></nav>
@endsection
