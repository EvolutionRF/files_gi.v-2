<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\User;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function editProfile()
    {

        $user = auth()->user();
        $division = Division::all();
        $data = [
            'url' => route('user.storeeditprofile', $user->id),
            'user' => $user,
            'divisions' => $division
        ];
        // return response()->json($user);
        return view('user.edit-profile', $data);
    }

    public function storeEditProfile($id, Request $request, SweetAlertFactory $flasher)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|min:3',
        ]);

        $data = [
            'name' => $request->name,
            'division_id' => $request->division
        ];

        $update = $user->update($data);
        if ($update) {
            activity()->causedBy(auth()->user())->performedOn($user)->log('Update Profile');
            $flasher->addSuccess('Data has been update successfully!');
            return redirect()->back();
        }
    }
    public function changePassword()
    {
        $user = auth()->user();
        $data = [
            'url' => route('user.storechangepassword', $user->id)
        ];
        // return response()->json('masuk');
        return view('user.change-password', $data);
    }

    public function storeChangePassword($id, Request $request, SweetAlertFactory $flasher)
    {
        $user = User::findOrFail($id);

        if (!Hash::check($request->oldPassword, $user->password)) {
            // $this->emit('wrongOldPassword');
            $flasher->addError('Failed Change Password');
            return redirect()->back();
        } else {
            $validate = $request->validate([
                'newPassword' => 'required|min:8',
            ]);

            if ($request->newPassword != $request->newPassword_confirmation) {
                $flasher->addError('Failed Change Password');
                return redirect()->back();
            } else {
                $user->update([
                    'password' => Hash::make($request->newPassword)
                ]);
                activity()->causedBy(auth()->user())->performedOn($user)->log('Change Password');
                $flasher->addSuccess('Password has been update successfully!');
                return redirect()->back();
            }
        }
    }
}
