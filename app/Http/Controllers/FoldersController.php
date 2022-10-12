<?php

namespace App\Http\Controllers;

use App\Models\BaseFolder;
use App\Models\Content;
use App\Models\Permission;
use Illuminate\Http\Request;

class FoldersController extends Controller
{
    public function EnterFolder($slug)
    {
        // $baseFolder = BaseFold;
        $Folder = BaseFolder::where('slug', $slug)->first();
        $baseFolder = "";
        $permission = Permission::all();
        if ($Folder) {
            // return response()->json('masuk');
            $access_BaseFolder = $Folder->base_folders_accesses;
        } else {
            $baseFolder = $Folder;
            $Folder = Content::where('slug', $slug)->first();
            $access_BaseFolder = $baseFolder->base_folders_accesses;
        }

        $data = [
            'baseFolder' => $baseFolder,
            'baseFolders_accesses' => $access_BaseFolder,
            'content' => $Folder,
            'permission' => $permission
        ];


        if (auth()->user()) {
            if (auth()->user()->getRoleNames()->first() == "admin") { //Check apakah yang masuk rolenya admin
                $message = 'Masuk Ke ' . $Folder->name;
                return response()->json($message);

                // return view('folders', $data);
            } else { //jika user biasa maka akan mencek type folder
                // Enter User Role
                if ($Folder->isPrivate == 'public') { //Check Type Folder Apakah public atau Private
                    // Enter Public Content
                    // return view('folders', $data);

                    $message = 'Masuk Ke ' . $Folder->name . " Sebagai " . auth()->user()->name;
                    return response()->json($message);
                } else { //Jika Private maka akan masuk kesini
                    // Enter Private Content
                    foreach ($access_BaseFolder as $accesBase) { //perulangan untuk mengambil data yang memiliki akses ke folder
                        if (auth()->user()->id == $accesBase->user_id) { //jika ditemukan maka akan bisa masuk
                            // Enter Content Have Access
                            $message = ' Masuk Ke ' . $Folder->name . " Sebagai " . auth()->user()->name;
                            return response()->json($message);
                            // return view('folders', $data);
                        }
                    }
                    $message = 'Izin masuk ke' . $Folder->name . " Sebagai " . auth()->user()->name . " Ditolak";
                    return response()->json($message);
                }
            }
        } else {

            return response()->json("Masukan Password atau Login");
        }
    }
}
