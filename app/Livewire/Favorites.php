<?php

namespace App\Livewire;

use App\Models\Favorite;
use Livewire\Component;

class Favorites extends Component
{
    public $favo;
    public $productId;

    public function mount($productID)
    {
        $this->productId = $productID;
        $this->favo = Favorite::where('product_id', $productID)
            ->where('user_id', auth()->id())
            ->first();
    }
    public function render()
    {
        return view('livewire.favorites');
    }
    public function toggleFavorite()
    {
        $auth = auth()->id();
        if ($this->favo) {
            $this->favo->delete();
            $this->favo = null;
        } else {
            $newFavorite = Favorite::create([
                'user_id' => $auth,
                'product_id' => $this->productId,
            ]);

            $this->favo = $newFavorite;
        }
    }
}
