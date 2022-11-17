<?php

namespace App\Http\Livewire;

use App\Models\BaseFolder;
use App\Models\Content;
use Livewire\Component;
use Livewire\WithPagination;

class ContentIndex extends Component
{
    use WithPagination;

    public $slug;
    public function render()
    {
        $folder = BaseFolder::where('slug', $this->slug)->first();
        $parents = array();
        if ($folder) {
            $parents[0] =  array(
                'slug' => $folder->slug,
                'name' => $folder->name
            );
        } else {
            $folder = Content::where('slug', $this->slug)->first();
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

        $data = [
            'folder' => $folder,
            'parents' => array_reverse($parents),
            'content_folder' => $folder->contents->where('type', 'folder'),
            'content_file' => $folder->contents->where('type', '!=', 'folder'),

        ];
        return view('livewire.content-index', $data);
    }
}
