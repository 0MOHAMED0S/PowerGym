<div>
    <button wire:click="decrementQuantity" class="qty-btn decrease" onclick="disableButtons()" >-</button>
    <span class="qty">{{ $cart['quantity'] }}</span>
    <button wire:click="incrementQuantity" class="qty-btn increase" onclick="disableButtons()">+</button>
</div>

<script>
    function disableButtons() {
        const buttons = document.querySelectorAll('.qty-btn');
        buttons.forEach(button => {
            button.disabled = true;
            setTimeout(() => {
                button.disabled = false;
            }, 500); // 0.5 seconds
        });
    }
</script>
