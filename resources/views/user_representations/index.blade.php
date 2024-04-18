{{-- resources/views/user_representations/index.blade.php --}}

@php
    use Carbon\Carbon;
@endphp

@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <h2 class="mb-3">Voici un récapitulatif de vos commandes</h2>
        <p>Mes Réservations</p>
    </div>

    @if($representations->isEmpty())
        <div class="alert alert-info" role="alert">
            Vous n'avez aucune réservation.
        </div>
    @else
        @php
            $groupedRepresentations = $representations->groupBy(function($item) {
                // Conversion de 'when' en objet Carbon pour le formatage
                $when = Carbon::parse($item->when);
                return $item->show->title . ' ' . $when->format('Y-m-d H:i');
            });
        @endphp

        <div class="list-group">
        @foreach ($groupedRepresentations as $group => $items)
        @php
        $firstItem = $items->first();
        $when = Carbon::parse($firstItem->when);

        // Agréger les données des réservations utilisateurs pour chaque groupe
        $profileSummary = $items->flatMap(function ($item) {
            return $item->userRepresentations; // Assurez-vous que cela renvoie bien les réservations utilisateurs associées
        })->groupBy('profile_type')->map(function ($group) {
            return $group->sum('places');
         });
          @endphp
        <div class="list-group-item list-group-item-action mb-3 p-4 shadow-sm">
        <h3 class="mb-3">{{ $firstItem->show->title }}</h3>
        <p>Date: {{ $when->format('Y-m-d H:i') }}</p>
        @foreach ($profileSummary as $profileType => $places)
            <p>{{ ucfirst($profileType) }}: {{ $places }} places</p>
        @endforeach
        </div>
        @endforeach

        </div>
    @endif
</div>
@endsection
