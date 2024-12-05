<div class="flex flex-col transition-transform transform cursor-pointer hover:scale-105">
    <div class="relative" style="max-width: 330px;">
        <img src="{{ $car->imageDocument->document_content }}" alt="Image" class="object-cover rounded-lg"
            style="width: 330px; height: 200px;">
        <div class="absolute bottom-0 right-0 p-1 text-white bg-black rounded-tl-lg rounded-br-lg bg-opacity-20">
            {{ $timeRemaining }}
        </div>
    </div>
    <div class="flex flex-col">
        <p class="font-medium">{{ $car->carModel->brand->brand_name . ' ' . $car->carModel->model_name }}</p>
        <div class="flex justify-between" style="max-width: 330px;">
            <div class="flex items-center gap-1">
                <i class="text-gray-500 fa-regular fa-badge-check"></i>
                <p class="text-sm text-gray-500">{{ $car->user->first_name . ' ' . $car->user->last_name }}</p>
            </div>
            <p class="font-semibold">{{ number_format($car->selling_price, 2) }}€</p>
        </div>
    </div>
</div>