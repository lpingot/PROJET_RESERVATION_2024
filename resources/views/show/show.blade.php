@extends('layouts.main')

@section('title', "Fiche d'un spectacle")

@section('content')
    <div class="container mt-5">
        <article class="card mb-5">
            <div class="row g-0">
                <div class="col-md-4">
                    @if($show->poster_url)
                        <img src="{{ asset('images/'.$show->poster_url) }}" alt="{{ $show->title }}" class="img-fluid rounded-start">
                    @else
                        <canvas width="200" height="100" style="border:1px solid #000000;"></canvas>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h1 class="card-title">{{ $show->title }}</h1>
                        @if($show->location)
                            <p class="card-text"><strong>Lieu de création:</strong> {{ $show->location->designation }}</p>
                        @endif
                        <p class="card-text"><strong>Prix:</strong> {{ $show->price }} €</p>
                        <p class="card-text">{!! $show->bookable ? '<span class="text-success">Réservable</span>' : '<span class="text-danger">Non réservable</span>' !!}</p>
                        <h2>Liste des représentations</h2>
                        <p>Sélectionnez une représentation pour passer à la réservation</p>
                        @if($show->representations->count() >= 1)
                            <div class="list-group">
                                @foreach ($show->representations as $representation)
                                    <a href="{{ route('representation.show', $representation->id) }}" class="list-group-item list-group-item-action">{{ $representation->when }}<button class="btn btn-primary" type="submit">Réserver ce spectacle</button></a>
                                @endforeach
                            </div>
                        @else
                            <p>Aucune représentation</p>
                        @endif
                    </div>
                </div>
            </div>
        </article>

        <section>
            <h2>Liste des artistes</h2>
            <ul class="list-group mb-4">
                @foreach ($show->artistTypes as $collaborateur)
                    <li class="list-group-item">
                        {{ $collaborateur->artist->firstname }}
                        {{ $collaborateur->artist->lastname }}
                        ({{ $collaborateur->type->type }})
                    </li>
                @endforeach
            </ul>

            <div>
                <h3>Équipe de production</h3>
                <p><strong>Auteur:</strong>
                @foreach ($collaborateurs['auteur'] as $auteur)
                    {{ $auteur->firstname }} 
                    {{ $auteur->lastname }}@if(!$loop->last), @endif
                @endforeach
                </p>
                <p><strong>Metteur en scène:</strong>
                @foreach ($collaborateurs['scénographe'] as $scenographe)
                    {{ $scenographe->firstname }} 
                    {{ $scenographe->lastname }}@if(!$loop->last), @endif
                @endforeach
                </p>
                <p><strong>Distribution:</strong>
                @foreach ($collaborateurs['comédien'] as $comedien)
                    {{ $comedien->firstname }} 
                    {{ $comedien->lastname }}@if(!$loop->last), @endif
                @endforeach
                </p>
            </div>
            <h2>Liste des tags</h2>
               <ul>
               @foreach($show->tags as $tag)    
                   <li>{{ $tag->tag }}</li>
               @endforeach
               </ul>
        <!-- Vérifier si l'utilisateur est un administrateur -->
        @if ($user && $user->role === 'admin')
            <div>
                <h3>Admin Panel</h3>
                <p>Bienvenue, admin! Voici des options supplémentaires pour vous. Ajoutez un tag</p>
                <!-- Vos options administratives ici -->
                <form action="{{ route('show.addTag', $show->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="tag_id">Ajouter un tag</label>
                        <select class="form-control" id="tag_id" name="tag_id" required>
                            <option value="">Sélectionner un tag</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Ajouter Tag</button>
                </form>
            </div>
        @endif

        </section>

        <nav class="mt-4"><a href="{{ route('show.index') }}" class="btn btn-secondary">Retour à la liste</a></nav>
    </div>
@endsection
