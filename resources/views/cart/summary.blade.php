@extends('layouts.main')

@section('title', 'Récapitulatif de la commande')

@section('content')

    @php
        $totalAmount = 0;
        $totalPlaces = 0;
        foreach ($reservation['places'] ?? [] as $type => $quantity) {
            $totalPlaces += $quantity;
            $totalAmount += $quantity * ($reservation['prices'][$type] ?? 0);
        }
    @endphp
    @if($totalPlaces > 0)
        <h1>Récapitulatif de la commande</h1>
        <p><strong>Show:</strong> {{ $reservation['show_title'] }}</p>
        <p><strong>Date:</strong> {{ $reservation['date'] }}</p>
        <p><strong>Heure:</strong> {{ $reservation['time'] }}</p>
        <p><strong>Lieu:</strong> {{ $reservation['location'] }}</p>

        <table class="table">
            <thead>
                <tr>
                    <th>Profil</th>
                    <th>Nombre de places</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $totalAmount = 0; @endphp
                @foreach ($reservation['places'] as $type => $quantity)
                    @if($quantity > 0)
                    <tr>
                        <td>{{ ucfirst($type) }}</td>
                        <td>{{ $quantity }}</td>
                        <td>{{ $quantity * $reservation['prices'][$type] }} €</td>
                        @php
                            $totalAmount += $quantity * $reservation['prices'][$type];
                        @endphp
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

    <p><strong>Nombre de places :</strong> {{ $totalPlaces }}</p>
    <p><strong>Prix total :</strong> {{ $totalAmount }} €</p>

    <h2>Méthode de paiement</h2>
    <form action="{{ route('payment.store') }}" method="POST" id="payment-form">
        @csrf
        <div class="form-group">
            <label for="card-element">Crédit ou Débit</label>
            <div id="card-element"></div>
            <div id="card-errors" role="alert"></div>
        </div>
        <input type="hidden" name="amount" value="{{ $totalAmount * 100 }}">
        <button class="btn btn-primary" type="submit">Procéder au paiement</button>
    </form>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ config("services.stripe.key") }}');
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            var fakeToken = { id: 'tok_fakeToken123' }; // Créer un token fictif
            stripeTokenHandler(fakeToken);
        });

        function stripeTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    </script>
    @else
        <div class="alert alert-info" role="alert">
            Le panier est vide.
        </div>
    @endif
@endsection
