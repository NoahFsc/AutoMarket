<?php

namespace App\Livewire\Model;

use App\Models\CarModel;
use Livewire\Component;
use Livewire\WithPagination;

class ModelsCatalog extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = ['refreshModels' => '$refresh'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function deleteModel($modelId)
    {
        CarModel::find($modelId)->delete();
    }

    public function render()
    {
        $models = CarModel::where('model_name', 'like', '%'.$this->search.'%')
            ->paginate(6);

        return view('components.admin.model.models-catalog', ['models' => $models]);
    }
}
