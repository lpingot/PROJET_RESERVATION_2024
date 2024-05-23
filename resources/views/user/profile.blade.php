@extends('layouts.main')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Profil de l'utilisateur</h4>
                </div>
                <div class="card-body">
                    <p class="card-text"><strong>Login:</strong> {{ $user->login }}</p>
                    <p class="card-text"><strong>Nom:</strong> {{ $user->firstname }} {{ $user->lastname }}</p>
                    <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="card-text"><strong>Langue:</strong> {{ $user->langue }}</p>
                    <p class="card-text"><strong>Rôle:</strong> {{ $user->role }}</p>
                    <!-- Ajoutez d'autres informations que vous souhaitez afficher -->
                    @if($user->role === 'admin')
                        <a  href="{{ route('admin.dashbboard') }}" class="btn btn-primary">Accéder au tableau de bord admin</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
