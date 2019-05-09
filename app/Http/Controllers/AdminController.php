<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use Illuminate\Http\Request;

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

    public function deleteUser($userID)
    {

    }

    public function deleteItem($itemID)
    {

    }
}
