<div class="container p-6 mx-auto">
    <div class="flex items-center justify-between">
        <div class="flex flex-col">
            <p class="text-2xl font-medium">{{ __('OrderHistory') }}</p>
            <p class="text-gray-500">{{ __('AllOrders') }} ({{ $orders->total() }})</p>
        </div>
        <div class="mt-4">
            <input type="text" wire:model.live='search' placeholder="{{ __('Search') }}" class="w-64 px-3 py-2 border rounded">
        </div>
    </div>

    <table class="w-full mt-4 border rounded-lg shadow-md">
        <thead class="bg-gray-100">
            <tr class="text-left">
                <th class="p-3">#</th>
                <th class="p-3">{{ __('OrderID') }}</th>
                <th class="p-3">{{ __('Product') }}</th>
                <th class="p-3">{{ __('Seller') }}</th>
                <th class="p-3">{{ __('PurchaseDate') }}</th>
                <th class="p-3">{{ __('TotalPrice') }}</th>
                <th class="p-3">{{ __('Status') }}</th>
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
                <td class="flex items-center p-3">
                    <img src="{{ $order->car->user->profile_picture ? asset('storage/' . $order->car->user->profile_picture) : asset('assets/default_pfp.png') }}" class="w-8 h-8 mr-2 rounded-full">
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
                        {{ $order->delivery_status == 1 ? __('Delivered') : __('NotDelivered') }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="flex justify-center mt-4">
        {{ $orders->links('components.pagination') }}
    </div>
</div>