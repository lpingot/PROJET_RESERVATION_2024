@extends('layouts.main')

@section('title', 'Liste des représentations')

@section('content')
    <h1>Liste des {{ $resource }}</h1>
    <ul>
        <li><a href="{{ route('representation.create') }}">Ajouter</a></li>    
    </ul>

    <ul>
    @foreach($representations as $representation)
    <li> 
        <a href="{{ route('representation_admin.show', $representation->id) }}">{{ $representation->show->title }}</a>
        @if($representation->location)
        - <span>{{ $representation->location->designation }}</span>
        @endif
        - <datetime>{{ substr($representation->when,0,-3) }}</datetime>
    </li>
    @endforeach
    </ul>
@endsection
