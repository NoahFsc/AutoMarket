<div class="container mx-auto p-6">
    <div class="flex justify-between items-center">
        <div class="flex flex-col">
            <p class="text-2xl font-medium">Historique des derniers achats</p>
            <p class="text-gray-500">Tous vos achats ({{ $orders->total() }})</p>
        </div>
        <div class="mt-4">
            <input type="text" wire:model.live='search' placeholder="Rechercher" class="border rounded px-3 py-2 w-64">
        </div>
    </div>

    <table class="w-full mt-4 border rounded-lg shadow-md">
        <thead class="bg-gray-100">
            <tr class="text-left">
                <th class="p-3">#</th>
                <th class="p-3">Identifiant</th>
                <th class="p-3">Produit</th>
                <th class="p-3">Vendeur</th>
                <th class="p-3">Date de l’achat</th>
                <th class="p-3">Total TTC</th>
                <th class="p-3">Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $index + 1 }}</td>
                <td class="p-3">
                    <a href="{{ route('user.ha-view', ['orderId' => $order->id]) }}" class="text-blue-500">#CMD{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</a>
                </td>
                <td class="p-3">{{ $order->car->carModel->brand->brand_name }} {{ $order->car->carModel->model_name }}</td>
                <td class="p-3 flex items-center">
                    <img src="{{ $order->car->user->profile_picture ? asset('storage/' . $order->car->user->profile_picture) : asset('assets/default_pfp.png') }}" class="w-8 h-8 rounded-full mr-2">
                    <a href="#" class="text-blue-500">{{ $order->car->user->first_name }} {{ $order->car->user->last_name }}</a>
                </td>
                <td class="p-3">
                    @if($order->delivery_date)
                        {{ $order->delivery_date->format('D. j M Y') }}
                    @else
                        N/A
                    @endif
                </td>
                <td class="p-3">{{ number_format($order->car->selling_price, 0, ',', ' ') }}€</td>
                <td class="p-3">
                    <span class="px-3 py-1 rounded text-white {{ $order->delivery_status == 1 ? 'bg-green-400' : 'bg-red-400' }}">
                        {{ $order->delivery_status == 1 ? 'Livré' : 'Non livré' }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4 flex justify-center">
        {{ $orders->links('components.pagination') }}
    </div>
</div>