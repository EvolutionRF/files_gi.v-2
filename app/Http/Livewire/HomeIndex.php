<?php

namespace App\Http\Livewire;

use App\Models\BaseFolder;
use Livewire\Component;
use Livewire\WithPagination;


class HomeIndex extends Component
{
    // public $baseFolders;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;

    protected $queryString = [
        'search'
    ];



    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->search) {
            $baseFolders = BaseFolder::with(['base_folders_accesses.user' => function ($query) {
                $query->select('id', 'name');
            }])->where('name', 'like', '%' . $this->search . '%')->latest();
        } else {
            $baseFolders = BaseFolder::with(['base_folders_accesses.user' => function ($query) {
                $query->select('id', 'name');
            }])->latest();
        }

        $data = [
            'baseFolders' => $baseFolders->paginate(6)
        ];
        return view('livewire.dashboard.home-index', $data);
    }
}
