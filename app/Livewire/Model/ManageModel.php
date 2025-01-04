<?php

namespace App\Livewire\Model;

use App\Models\CarModel;
use Livewire\Component;

class ManageModel extends Component
{
    public $model_id;
    public $model_name;

    protected $rules = [
        'model_name' => 'required|string|max:255',
    ];

    protected $listeners = ['openManageModelModal' => 'openModal'];

    public function openModal($model_id = null)
    {
        if ($model_id) {
            $model = CarModel::findOrFail($model_id);
            $this->model_id = $model->id;
            $this->model_name = $model->model_name;
        } else {
            $this->reset(['model_id', 'model_name']);
        }
    }

    public function saveModel()
    {
        $this->validate();

        if ($this->model_id) {
            $model = CarModel::findOrFail($this->model_id);
            $model->update([
                'model_name' => $this->model_name,
            ]);
            session()->flash('status', 'Modèle modifié avec succès.');
        } else {
            CarModel::create([
                'model_name' => $this->model_name,
            ]);
            session()->flash('status', 'Modèle ajouté avec succès.');
        }

        // Réinitialiser les champs du formulaire
        $this->reset(['model_id', 'model_name']);

        $this->dispatch('close-manage-model-modal');
        $this->dispatch('refreshModels');
    }

    public function render()
    {
        return view('components.admin.model.manage-model');
    }
}
