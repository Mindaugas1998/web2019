<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('items.index', compact('items'));
    }
    public function create()
    {
        return view('items.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'price' => 'required',
            //'image' => 'required'
        ]);

        $item = new Item();

        $item->title = request('title');
        $item->description = request('description');
        $item->price = request('price');
        $item->phone = request('phone');

        $item->save();

        return redirect('items');
    }
}
