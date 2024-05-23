<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Session;
use Exception;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        // Détecter si un token fictif est utilisé
        if ($request->stripeToken == 'tok_fakeToken123') {
            // Logique pour un paiement simulé réussi
            return Redirect::route('final.confirmation');
        }

        // Traitement réel avec Stripe si le token n'est pas fictif
        Stripe::setApiKey(config("services.stripe.key"));

        // Convertir le montant en centimes pour Stripe
        $amount = $request->input('amount'); // Assurez-vous que ce montant est transmis en centimes

        try {
            $charge = Charge::create([
                'amount' => $amount, // Utilisez le montant de la requête
                'currency' => 'eur', // ou 'usd', selon votre devise
                'description' => 'Paiement pour la commande',
                'source' => $request->stripeToken, // Token fourni par Stripe.js
            ]);

            // Une fois le paiement réussi, préparer les données pour la confirmation finale
            // $reservationData = json_decode($request->reservation_data, true);
            // Vous pouvez ajouter ici un traitement supplémentaire au besoin

            // Redirigez vers la route de confirmation finale avec les données de réservation
            return Redirect::route('final.confirmation');

        } catch (Exception $e) {
            // Gérez ici les erreurs.
            return back()->withErrors('error', $e->getMessage())->withInput();
        }
    }
}
