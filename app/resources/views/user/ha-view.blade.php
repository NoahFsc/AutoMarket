@extends('layout')

@section('titre', 'Commande')

@section('contenu')
<div class="max-w-lg mx-auto">
    <a href="{{ route('user.historiqueachat') }}" class="flex items-center gap-2 text-gray-500 hover:text-gray-700">
        <i class="fa-solid fa-arrow-left"></i> Retour à la page précédente
    </a>
    
    <h1 class="text-2xl font-semibold mt-4 mb-4">Commande #CMD{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h1>
    <hr class="border-input-border">
    <div class="mt-4 flex gap-2">
        <form action="{{ route('order.mark-received', ['orderId' => $order->id]) }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Marquer comme reçue</button>
        </form>
        <a href="{{ route('chat.index', ['userId' => $order->car->user->id]) }}" class="bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300">Contacter le vendeur</a>
    </div>

    <div class="mt-6 p-4 border rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl font-semibold">Détails de la commande</h2>
            <span class="px-3 py-1 rounded text-white {{ $order->delivery_status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                {{ $order->delivery_status == 1 ? 'Livré' : 'Non livré' }}
            </span>
        </div>
        <p><strong>Nom :</strong> {{ $order->car->carModel->model_name }} {{ $order->car->carModel->brand->brand_name }}</p>
        <p><strong>Date d'achat :</strong> {{ \Carbon\Carbon::parse($order->delivery_date)->translatedFormat('j F Y') }}</p>
        <p><strong>Montant de l'achat :</strong> {{ number_format($order->car->selling_price, 0, ',', ' ') }}€</p>
    </div>

    <div class="mt-4 p-4 border rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Informations du vendeur</h2>
        <p><strong>Vendeur :</strong> {{ $order->car->user->first_name }} {{ $order->car->user->last_name }}</p>
        <p><strong>Adresse e-mail :</strong> {{ $order->car->user->email }}</p>
        <p><strong>Numéro de téléphone :</strong> {{ $order->car->user->telephone }}</p>
    </div>
</div>
@endsection