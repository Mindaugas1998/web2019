<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    public function showUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function showItems()
    {
        $items = Item::all();
        return view('admin.items.index', compact('items'));
    }

    public function destroyUser($userID)
    {
        $user = User::find($userID);
        $deleted = $user->delete();

        if($deleted){
            return response([
                'success' => true,
                'url' => route('admin.users.index')
            ]);
        }
    }

    public function deleteItem($itemID)
    {

    }





    public function createUser()
    {
        return view('admin.users.create');
    }
    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'user_type' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);


        $user = new User();

        $user->user_type = $request->get('user_type');
        $user->name = $request->get('name');
        $user->email = $request->get('email');
//        $user->password = $request->get('password');
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect('admin/users');
    }

    public function showUser($userID)
    {
        $user = User::find($userID);
        return view('admin.users.show', compact('user'));
    }

    public function editUser($userID)
    {
        $user = User::find($userID);

        return view('admin.users.edit')
            ->with('user', $user);

    }

    public function updateUser(Request $request, $userID)
    {
        $this->validate($request, [
            'user_type' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::find($userID);
        $user->user_type = $request->get('user_type');
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->save();
        return redirect()->route('admin.users.index');
    }
}
