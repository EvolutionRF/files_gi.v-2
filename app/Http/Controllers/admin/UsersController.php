<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();
        $divisions = Division::all();

        $data = [
            'users' => $users,
            'divisions' => $divisions,
            'type_menu' => 'Data Users'
        ];
        // $datas =  ['data' => $data];
        // return response()->json($datas);

        return view('admin.users', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request, SweetAlertFactory $flasher)
    {
        // return response()->json($request->name);
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'division_id' => $request->division
        ];
        // return response()->json($data);
        $user = User::create($data);
        if ($user) {
            $asignRole = $user->assignRole('user');
            if ($asignRole) {
                $flasher->addSuccess('Data User has been add successfully!');
                return redirect()->route('users.index');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            'request' => $request->all(),
            'id' => $id
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, SweetAlertFactory $flasher)
    {
        // return response()->json($id);
        $delete = User::destroy($id);
        // if ($delete) {
        $flasher->addSuccess('Data has been Delete successfully!');
        // $flasher->iconColor('#ff0000');
        return redirect()->route('users.index');
        // }
    }
}
