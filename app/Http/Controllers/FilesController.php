<?php

namespace App\Http\Controllers;

use App\Models\BaseFolder;
use App\Models\Content;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FilesController extends Controller
{
    public function upload(Request $request, SweetAlertFactory $flasher)
    {
        // dd($request->all());
        $parent = BaseFolder::where('slug', $request->FileparentSlug)->first();
        if (!$parent) {
            $parent = Content::where('slug', $request->FileparentSlug)->first();
            $baseFolder_id = $parent->basefolder_id;
        } else {
            $baseFolder_id = $parent->id;
        }

        $content = new Content(); //bikin object content
        $content->name = $request->get('name'); // mengisi content->name dengan request name
        $content->type = 'file'; //mengisi content->type dengan file
        $content->owner_id = auth()->user()->id; //mengisi owner_id dengan user yang login
        $content->slug = Str::random(32); //mengisi slug dengan $slugContent
        $content->basefolder_id = $baseFolder_id; //mengisi basefolder_id dengan $baseFolder
        $content->isPrivate = $request->FileisPrivate;

        $doneUploadFile = $parent->contents()->save($content);
        if ($doneUploadFile) {
            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $doneUploadFile->addMediaFromRequest('file')->toMediaCollection('file');
                $flasher->addSuccess('File has been Uploaded successfully!');
                return redirect()->route('EnterFolder', $request->FileparentSlug);
            }
        }
    }
}
