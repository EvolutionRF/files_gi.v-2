<?php

namespace App\Http\Livewire;

use App\Models\BaseFolder;
use App\Models\BaseFolderAccess;
use App\Models\ContentAccess;
use Livewire\Component;
use Livewire\WithPagination;

class SharedIndex extends Component
{
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

    public function render()
    {

        $sharedBaseFolder = BaseFolderAccess::where('user_id', auth()->user()->id)->where('status', 'accept')->groupby('basefolder_id')->whereHas('basefolder', function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
            ->latest()->paginate(3, '*', 'basefolderPage');

        $sharedContentFolder = ContentAccess::where('user_id', auth()->user()->id)->where('status', 'accept')->groupBy('content_id')->whereHas('content', function ($query) {
            $query->where('type', 'folder')->where('name', 'like', '%' . $this->search . '%');
        })->latest()->paginate(4, '*', 'contentFolderPage');

        $sharedContentFile = ContentAccess::where('user_id', auth()->user()->id)->where('status', 'accept')->groupBy('content_id')->whereHas('content', function ($query) {
            $query->where('type', '!=', 'folder')->where('name', 'like', '%' . $this->search . '%');
        })->latest()->paginate(5, '*', 'contentFilePage');

        $data = [
            'sharedBaseFolder' => $sharedBaseFolder,
            'sharedContentFolder' => $sharedContentFolder,
            'sharedContentFile' => $sharedContentFile,
            'shared'    => true,
        ];
        return view('livewire.shared-index', $data);
    }
}
