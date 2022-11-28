<?php

namespace App\Http\Livewire;

use App\Models\BaseFolder;
use App\Models\Content;
use Livewire\Component;
use Livewire\WithPagination;

class ContentIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $slug;

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
        $folder = BaseFolder::where('slug', $this->slug)->first();
        // dd($this->slug);
        $parents = array();
        if ($folder) {
            $parents[0] =  array(
                'slug' => $folder->slug,
                'name' => $folder->name
            );
        } else {
            $folder = Content::where('slug', $this->slug)->first();
            // dd($folder);
            $result = $folder->contentable;
            if ($result == "") {
                return response()->json('ERROR');
            }
            $count = 0;
            do {
                $parents[$count] = array(
                    'slug'  => $result->slug,
                    'name'  => $result->name,
                );
                $result = $result->contentable;
                $count++;
            } while ($result != null);
        }


        if ($this->search) {
            $content_folder = $folder->contents()
                ->where('type', 'folder')
                ->where('name', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(4, '*', 'folderPage');

            $content_file = $folder->contents()
                ->where('type', '!=', 'folder')
                ->where('name', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(6, '*', 'filePage');
        } else {
            $content_folder = $folder->contents()
                ->where('type', 'folder')
                ->latest()
                ->paginate(4, '*', 'folderPage');

            $content_file = $folder->contents()
                ->where('type', '!=', 'folder')
                ->latest()
                ->paginate(6, '*', 'filePage');
        }

        $data = [
            'folder' => $folder,
            'parents' => array_reverse($parents),
            'content_folder' => $content_folder,
            'content_file' => $content_file,
        ];
        return view('livewire.content-index', $data);
    }
}
