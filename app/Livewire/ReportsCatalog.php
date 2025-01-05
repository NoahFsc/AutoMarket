<?php

namespace App\Livewire;

use App\Models\Report;
use Livewire\Component;
use Livewire\WithPagination;

class ReportsCatalog extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function markAsResolved($reportId)
    {
        $report = Report::findOrFail($reportId);
        $report->status = 1;
        $report->save();
    }

    public function markAsUnresolved($reportId)
    {
        $report = Report::findOrFail($reportId);
        $report->status = 0;
        $report->save();
    }

    public function deleteReport($reportId)
    {
        Report::findOrFail($reportId)->delete();
    }

    public function render()
    {
        $reports = Report::whereHas('receiver', function ($query) {
            $query->where('last_name', 'like', '%' . $this->search . '%')
                ->orWhere('first_name', 'like', '%' . $this->search . '%');
        })
            ->orWhereHas('writer', function ($query) {
                $query->where('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('first_name', 'like', '%' . $this->search . '%');
            })
            ->orWhere('reason', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('components.admin.reports-catalog', ['reports' => $reports]);
    }
}
