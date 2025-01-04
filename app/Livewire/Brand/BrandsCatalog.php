<?php

namespace App\Livewire\Brand;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class BrandsCatalog extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = ['refreshBrands' => '$refresh'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function deleteBrand($brandId)
    {
        Brand::find($brandId)->delete();
    }

    public function render()
    {
        $brands = Brand::where('brand_name', 'like', '%' . $this->search . '%')
            ->paginate(6);

        return view('components.admin.brand.brands-catalog', ['brands' => $brands]);
    }
}
