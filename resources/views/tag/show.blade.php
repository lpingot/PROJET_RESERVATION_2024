@extends('layouts.main')

@section('title', 'Fiche d\'un tag')

@section('content')
    <h1>{{ ucfirst($tag->tag) }}</h1>
    <nav><a href="{{ route('tag.index') }}">Retour à l'index</a></nav>

@endsection
