<div>
    <button wire:click="decrementQuantity" class="qty-btn decrease" onclick="disableButtons()" >-</button>
    <span class="qty">{{ $cart['quantity'] }}</span>
    <button wire:click="incrementQuantity" class="qty-btn increase" onclick="disableButtons()">+</button>
</div>
