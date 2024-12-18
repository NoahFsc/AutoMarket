<div class="p-4 bg-white rounded-md">
    <div class="flex items-center gap-2 mb-2">
        <div>
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $review->nb_of_star)
                <i class="text-primary-500 fa-solid fa-star"></i>
                @else
                <i class="text-primary-500 fa-light fa-star"></i>
                @endif
            @endfor
        </div>
        <div class="text-sm font-bold opacity-50">{{ number_format($review->nb_of_star, 1) }}</div>
    </div>
    <a href="{{ route('user.show', $review->writer) }}">
        <div class="flex items-center gap-1">
            <img src="{{ $review->writer->profile_picture ? asset('storage/' . $review->writer->profile_picture) : asset('assets/default_pfp.png')
            }}" alt="Avatar" class="rounded-full size-8">
            <p class="text-sm font-medium hover:text-primary-500">{{ $review->writer->first_name . ' ' . $review->writer->last_name }}</p>
        </div>
    </a>
    <div class="mt-4">
        <p>{{ $review->comment }}</p>
    </div>
</div>