<div>
    @if (auth('web')->check())
    <button wire:click="toggleFavorite">
        @if ($favo)
        <i class="bx bxs-heart heart icon-clicked active"></i>
        @else
        <i class="bx bxs-heart heart"></i>
        @endif
    </button>
        @else
        <a href="{{route('login')}}">
        <i class="fa-solid fa-heart heart "></i>
        </a>
        @endif
</div>


