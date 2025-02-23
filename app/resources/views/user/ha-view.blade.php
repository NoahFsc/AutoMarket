@extends('layout')

@section('titre', __('Order'))

@section('contenu')
<div class="max-w-lg mx-auto">
    <a href="{{ route('user.historiqueachat') }}" class="flex items-center gap-2 text-gray-500 hover:text-gray-700">
        <i class="fa-solid fa-arrow-left"></i> {{ __('BackToPreviousPage') }}
    </a>
    
    <h1 class="mt-4 mb-4 text-2xl font-semibold">{{ __('Order') }} #CMD{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h1>
    <hr class="border-input-border">
    <div class="flex gap-2 mt-4">
        <form action="{{ route('order.mark-received', ['orderId' => $order->id]) }}" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">{{ __('MarkAsReceived') }}</button>
        </form>
        <a href="{{ route('chat.index', ['userId' => $order->car->user->id]) }}" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">{{ __('ContactSeller') }}</a>
    </div>

    <div class="p-4 mt-6 border rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xl font-semibold">{{ __('OrderDetails') }}</h2>
            <span class="px-3 py-1 rounded text-white {{ $order->delivery_status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                {{ $order->delivery_status == 1 ? __('Delivered') : __('NotDelivered') }}
            </span>
        </div>
        <p><strong>{{ __('Name') }} :</strong> {{ $order->car->carModel->model_name }} {{ $order->car->carModel->brand->brand_name }}</p>
        <p><strong>{{ __('PurchaseDate') }} :</strong> {{ \Carbon\Carbon::parse($order->delivery_date)->translatedFormat('j F Y') }}</p>
        <p><strong>{{ __('PurchaseAmount') }} :</strong> {{ number_format($order->car->selling_price, 0, ',', ' ') }}€</p>
    </div>

    <div class="p-4 mt-4 border rounded-lg shadow-md">
        <h2 class="mb-4 text-xl font-semibold">{{ __('SellerInformation') }}</h2>
        <p><strong>{{ __('Seller') }} :</strong> {{ $order->car->user->first_name }} {{ $order->car->user->last_name }}</p>
        <p><strong>{{ __('EmailAddress') }} :</strong> {{ $order->car->user->email }}</p>
        <p><strong>{{ __('PhoneNumber') }} :</strong> {{ $order->car->user->telephone }}</p>
    </div>
</div>
@endsection