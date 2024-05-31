<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use App\Models\Products;
use Livewire\Component;

class Cart extends Component
{
    public $product;
    public $productId;

    public $price;


    public function mount($productId)
    {
        $this->productId = $productId;
        $this->product = ModelsCart::where('product_id', $productId)
            ->where('user_id', auth()->id())
            ->first();

            $this->price = Products::where('id', $productId)
            ->first();
    }
    public function render()
    {
        return view('livewire.cart');
    }

    public function toggleCart()
    {
        $auth = auth()->id();
        if ($this->product) {
            $this->product->delete();
            $this->product = null;
        } else {
            $newCart = ModelsCart::create([
                'user_id' => $auth,
                'product_id' => $this->productId,
                'total_price'=>$this->price->price
            ]);
            $this->product = $newCart;
        }
    }

}
