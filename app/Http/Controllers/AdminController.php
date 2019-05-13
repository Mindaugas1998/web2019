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
        $user->delete();

        $users = User::all();
        return view('admin/users/index', compact('users'));
    }

    public function destroyItem($itemID)
    {
        $item = Item::find($itemID);
        $item->delete();

        $items = Item::all();
        return view('admin/items/index', compact('items'));
    }


    public function createUser()
    {
        return view('admin.users.create');
    }

    public function createItem()
    {
        return view('admin.items.create');
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

    public function storeItem(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'item_title' => 'required',
            'item_description' => 'required',
            'item_price' => 'required',
            'item_phone' => 'required'
        ]);

        $item = new Item();

        $item->user_id = $request->get('user_id');
        $item->title = $request->get('item_title');
        $item->description = $request->get('item_description');
        $item->price = $request->get('item_price');
        $item->phone = $request->get('item_phone');
        if(Input::hasFile('image')){
            $image = Input::file('image');
            $image->move('uploads/', $image->getClientOriginalName());
            $imagePath = $image->getClientOriginalName();
        }

        $item->image = $imagePath;

        $item->save();

        return redirect('admin/items');
    }


    public function showUser($userID)
    {
        $user = User::find($userID);
        return view('admin.users.show', compact('user'));
    }

    public function showItem($itemID)
    {
        $item = Item::find($itemID);
        return view('admin.items.show', compact('item'));
    }

    public function editUser($userID)
    {
        $user = User::find($userID);

        return view('admin.users.edit')
            ->with('user', $user);

    }

    public function editItem($itemID)
    {
        $item = Item::find($itemID);

        return view('admin.items.edit')
            ->with('item', $item);

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

    public function updateItem(Request $request, $itemID)
    {
        $this->validate($request, [
//            'user_id' => 'required',
            'item_title' => 'required',
            'item_description' => 'required',
            'item_price' => 'required',
            'item_phone' => 'required'
        ]);

        $item = Item::find($itemID);

//        $item->user_id = $request->get('user_id');
        $item->title = $request->get('item_title');
        $item->description = $request->get('item_description');
        $item->price = $request->get('item_price');
        $item->phone = $request->get('item_phone');

        $item->save();

        return redirect()->route('admin.items.index');
    }
}
