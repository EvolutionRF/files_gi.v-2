<?php

namespace App\Http\Controllers;

use App\Models\BaseFolder;
use App\Models\Content;
use App\Models\Permission;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


class FoldersController extends Controller
{
    public function EnterFolder($slug)
    {
        // $baseFolder = BaseFold;
        $Folder = BaseFolder::where('slug', $slug)->first();
        $baseFolder = "";
        $permission = Permission::all();
        $parents = array();
        if ($Folder) {
            // return response()->json('masuk');
            $access_folder = $Folder->base_folders_accesses;
            $parents[0] =  array(

                'slug' => $Folder->slug,
                'name' => $Folder->name

            );
            // return response()->json($parents);
        } else {
            $Folder = Content::where('slug', $slug)->first();
            $baseFolder = BaseFolder::find($Folder->basefolder_id);
            $access_folder = $Folder->accesses;

            $result = $Folder->contentable;
            $count = 0;
            do {
                //
                $parents[$count] = array(
                    'slug'  => $result->slug,
                    'name'  => $result->name,
                );
                $result = $result->contentable;
                $count++;
            } while ($result != null);
            // return response()->json($parents);
        }

        $data = [
            'baseFolder' => $baseFolder,
            'Folders_accesses' => $access_folder,
            'content' => $Folder,
            'permission' => $permission,
            'type_menu' => 'dashboard',
            'parents' => $parents
        ];
        // return response()->json($data['parents']['name']);



        if (auth()->user()) {
            if (auth()->user()->getRoleNames()->first() == "admin") { //Check apakah yang masuk rolenya admin
                $message = 'Masuk Ke ' . $Folder->name;
                // return response()->json($message);


                return view('folders', $data);
            } else { //jika user biasa maka akan mencek type folder
                // Enter User Role
                if ($Folder->isPrivate == 'public') { //Check Type Folder Apakah public atau Private
                    // Enter Public Content
                    return view('folders', $data);

                    // $message = 'Masuk Ke ' . $Folder->name . " Sebagai " . auth()->user()->name;
                    // return response()->json($message);
                } else { //Jika Private maka akan masuk kesini
                    // Enter Private Content
                    if (auth()->user()->id == $Folder->owner_id) {
                        return view('folders', $data);
                        // $message = 'Masuk Ke ' . $Folder->name . " Sebagai " . auth()->user()->name;
                        // return response()->json($message);
                    } else {
                        foreach ($access_folder as $access) { //perulangan untuk mengambil data yang memiliki akses ke folder
                            if (auth()->user()->id == $access->user_id) { //jika ditemukan maka akan bisa masuk
                                // // Enter Content Have Access
                                // $message = ' Masuk Ke ' . $Folder->name . " Sebagai " . auth()->user()->name;
                                // return response()->json($message);
                                return view('folders', $data);
                            }
                        }
                        $message = 'Izin masuk ke' . $Folder->name . " Sebagai " . auth()->user()->name . " Ditolak" . ", Silahkan Request Akses";
                        return response()->json($message);
                    }
                }
            }
        } else {
            return response()->json("Masukan Password atau Login");
        }
    }


    public function CreateBaseFolder(Request $request, SweetAlertFactory $flasher)
    {
        $data = [
            'name' => $request->name,
            'owner_id' => auth()->user()->id,
            'isPrivate' => $request->isPrivate,
            'slug' => Str::random(32)
        ];
        $doneCreate = BaseFolder::create($data);
        if ($doneCreate) {
            $flasher->addSuccess('Folder has been Create successfully!');
            return redirect()->route('dashboard');
        }
        // return response()->json($data);
    }

    public function CreateFolder(Request $request, SweetAlertFactory $flasher)
    {
        $parent = BaseFolder::where('slug', $request->parentSlug)->first();
        if (!$parent) {
            $parent = Content::where('slug', $request->parentSlug)->first();
            $baseFolder_id = $parent->basefolder_id;
        } else {
            $baseFolder_id = $parent->id;
        }
        // return response()->json($parent);
        // dd($parent);
        $content = new Content(); //bikin object content
        $content->name = $request->get('name'); // mengisi content->name dengan request name
        $content->type = 'folder'; //mengisi content->type dengan folder
        $content->owner_id = auth()->user()->id; //mengisi owner_id dengan user yang login
        $content->slug = Str::random(32); //mengisi slug dengan $slugContent
        $content->basefolder_id = $baseFolder_id; //mengisi basefolder_id dengan $baseFolder
        $data = [
            'parent' => $parent,
            'content' => $content
        ];
        $doneCreateBaseFolder = $parent->contents()->save($content);
        if ($doneCreateBaseFolder) {
            $flasher->addSuccess('Folder has been Create successfully!');
            return redirect()->route('EnterFolder', $request->parentSlug);
        }

        // return response()->json($data);
    }
}
