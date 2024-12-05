<div class=" bg-white shadow-md rounded-lg p-4">
    <div class="flex justify-between items-center mb-2">
        <div class="stars">
            @for ($i = 1; $i <= 5; $i++) @if ($i <=$review->nb_of_star)
                <i class="text-primary-500 fa-solid fa-star"></i>
                @else
                <i class="text-primary-500 fa-light fa-star"></i>
                @endif
                @endfor
        </div>
        <div class="flex items-center gap-1">
            <i class="text-gray-500 fa-regular fa-badge-check"></i>
            <p class="text-gray-500 text-sm">{{ "Certifié" }}</p>
        </div>
    </div>
    <div class="mb-4">
        <p>{{ $review->comment }}</p>
    </div>
    <div class="flex items-center gap-1">
        <img src="{{ $review->user->profile_picture }}" alt="Avatar" class="rounded-full size-8">
        <p class="text-sm">{{ $review->user->first_name . ' ' . $review->user->last_name }}</p>
    </div>
</div>