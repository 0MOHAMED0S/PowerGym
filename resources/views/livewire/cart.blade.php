<div>
    @if (auth('web')->check())
    <button wire:click="toggleCart">
        @if ($product)
        <i class="bx bxs-cart cart icon-clicked active"></i>
        @else
        <i class="bx bxs-cart cart"></i>
        @endif
    </button>
        @else
        <a href="{{route('login')}}">
            <i class="bx bxs-cart cart"></i>
        </a>
        @endif
</div>
