<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;

class View extends Component
{
    public $category, $product;
    public function mount($category,$product)
    {
        dd($product->name);
        $this->category = $category;
        $this->product = $product;
        # code...
    }
    public function render()
    {
        
        return view('livewire.frontend.product.view',[
            'category' => $this->category,
            'product' => $this->product
        ]);
    }
}
