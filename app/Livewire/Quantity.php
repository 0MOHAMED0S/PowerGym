<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class Quantity extends Component
{
    public $cart;
    public $cartId;

    public function mount($cartId)
    {
        $this->cartId = $cartId;
        $this->cart = Cart::find($cartId);
    }
    public function incrementQuantity()
    {
        $this->cart->increment('quantity');
        $this->cart->total_price= ($this->cart->product->price) * ($this->cart->quantity);
        $this->cart->save();
    }

    public function decrementQuantity()
    {
        if ($this->cart->quantity > 1) {
            $this->cart->decrement('quantity');
            $this->cart->total_price= ($this->cart->product->price) * ($this->cart->quantity);
            $this->cart->save();
        }
    }
    public function render()
    {
        return view('livewire.quantity');
    }
}
