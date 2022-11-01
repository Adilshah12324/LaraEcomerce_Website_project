<?php

namespace App\Http\Livewire\Admin\Brand;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Brand;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
   
    public function render()
    {
        $brands = Brand::orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.brand.index',['brands' => $brands])->extends('layouts.admin')->section('content');
    }
}
