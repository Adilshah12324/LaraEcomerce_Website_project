<?php

namespace App\Http\Livewire\Admin\Brand;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Brand;

class Index extends Component
{
   
    public function render()
    {
        return view('livewire.admin.brand.index')->extends('layouts.admin')->section('content');
    }
}
