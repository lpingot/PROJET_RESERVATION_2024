<!-- resources/views/show/untagged.blade.php -->
@extends('layouts.main')

@section('title', 'Shows sans tags')

@section('content')
    <div class="container mt-5">
        <h1>Shows sans tags</h1>
        
        @if($untaggedShows->isEmpty())
            <p>Aucun show sans tags trouvé.</p>
        @else
            <ul class="list-group">
                @foreach($untaggedShows as $show)
                    <li class="list-group-item">
                        <a href="{{ route('show.show', $show->id) }}">{{ $show->title }}</a>
                        <p>{{ $show->description }}</p>
                    </li>
                @endforeach
            </ul>
        @endif

        <nav class="mt-4">
            <a href="{{ route('show.index') }}" class="btn btn-secondary">Retour à la liste des shows</a>
        </nav>
    </div>
@endsection
