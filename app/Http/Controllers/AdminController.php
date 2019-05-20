<?php

namespace App\Http\Controllers;

use App\Item;
use App\Log;
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
        try {
            $user = User::find($userID);
            $user->delete();

            $users = User::all();

            $log = new Log();
            $log->log = 'Admin: ' . Auth::user()->id . ' deleted user ' . $user->name;
            $log->save();

            return view('admin/users/index', compact('users'));
        }
        catch (Exception $e) {
            $log->log = $e->getMessage();
            $log->save();
            return redirect()->back();
        }
    }

    public function destroyItem($itemID)
    {
        try {
            $item = Item::find($itemID);
            $item->delete();

            $items = Item::all();

            $log = new Log();
            $log->log = 'Admin: ' . Auth::user()->id . ' deleted item ' . $item->title;
            $log->save();

            return view('admin/items/index', compact('items'));
        }
        catch (Exception $e) {
            $log->log = $e->getMessage();
            $log->save();
            return redirect()->back();
        }
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

        try {
            $user = new User();

            $user->user_type = $request->get('user_type');
            $user->name = $request->get('name');
            $user->email = $request->get('email');
//        $user->password = $request->get('password');
            $user->password = Hash::make($request->password);

            $user->save();

            $log = new Log();
            $log->log = 'Admin: ' . Auth::user()->id . ' created user ' . $user->name;
            $log->save();

            return redirect('admin/users');
        }
        catch (Exception $e) {
            $log->log = $e->getMessage();
            $log->save();
            return redirect()->back();
        }
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

        try {
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

            $log = new Log();
            $log->log = 'Admin: ' . Auth::user()->id . ' created item ' . $item->title;
            $log->save();

            return redirect('admin/items');
        }
        catch (Exception $e) {
            $log->log = $e->getMessage();
            $log->save();
            return redirect()->back();
        }
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

        try {
            $user = User::find($userID);
            $user->user_type = $request->get('user_type');
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = $request->get('password');
            $user->save();

            $log = new Log();
            $log->log = 'Admin: ' . Auth::user()->id . ' edited user ' . $user->name;
            $log->save();

            return redirect()->route('admin.users.index');
        }
        catch (Exception $e) {
            $log->log = $e->getMessage();
            $log->save();
            return redirect()->back();
        }

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

        try {
            $item = Item::find($itemID);

//        $item->user_id = $request->get('user_id');
            $item->title = $request->get('item_title');
            $item->description = $request->get('item_description');
            $item->price = $request->get('item_price');
            $item->phone = $request->get('item_phone');

            $item->save();

            $log = new Log();
            $log->log = 'Admin: ' . Auth::user()->id . ' edited item ' . $item->title;
            $log->save();

            return redirect()->route('admin.items.index');
        }
        catch (Exception $e) {
            $log->log = $e->getMessage();
            $log->save();
            return redirect()->back();
        }


    }
}
