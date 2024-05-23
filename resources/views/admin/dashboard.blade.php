@extends('layouts.main')

@section('title', 'Tableau de Bord Admin')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4>Tableau de Bord Admin</h4>
                </div>
                <div class="card-body">
                    <p class="card-text">Sélectionnez les éléments que vous souhaitez modifier :</p>
                    <a href="{{ route('artist.index') }}" class="btn btn-success">Artiste</a>
                    <a href="{{ route('representation_admin.index') }}" class="btn btn-success">Représentation</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
