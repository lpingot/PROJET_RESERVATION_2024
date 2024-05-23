@extends('layouts.main')

@section('title', 'Liste des tags')

@section('content')
    <h1>Liste des {{ $resource }}</h1>

    <ul>
    @foreach($tags as $tag)
        <li><a href="{{ route('tag.show', $tag->id) }}">{{ $tag->tag}}</a></li>
    @endforeach
    </ul>
@endsection
