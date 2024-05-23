@extends('layouts.main')

@section('title', 'Ajouter une representation')

@section('content')
    <h2>Ajouter une representation</h2>

    <form action="{{ route('representation.store') }}" method="post" class="needs-validation" novalidate>
        @csrf

        <div>
            <label for="show_id">Show</label>
            <select name="show_id" id="show_id">
                @foreach($shows as $id => $title)
                    <option value="{{ $id }}">{{ $title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="when" class="form-label">Date (format : yyyy-mm-dd hh:mm:ss)</label>
            <input type="text" class="form-control @error('when') is-invalid @enderror" id="when" name="when" required>
            @error('when')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="location_id">Location</label>
            <select name="location_id" id="location_id">
                @foreach($locations as $id => $designation)
                    <option value="{{ $id }}">{{ $designation }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
        <a href="{{ route('representation_admin.index') }}" class="btn btn-secondary">Annuler</a>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <h2>Liste des erreurs de validation</h2>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <nav class="mt-4"><a href="{{ route('representation_admin.index') }}" class="btn btn-outline-secondary">Retour à l'index</a></nav>
@endsection
