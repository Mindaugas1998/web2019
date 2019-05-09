<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

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
            'description' => 'required',
            'price' => 'required',
            'phone' => 'required',
            'image' => 'required'
        ]);

        $item = new Item();

        $item->user_id = Auth::user()->id;
        $item->title = request('title');
        $item->description = request('description');
        $item->price = request('price');
        $item->phone = request('phone');
        if(Input::hasFile('image')){
            $image = Input::file('image');
            $image->move('uploads/', $image->getClientOriginalName());
            $imagePath = $image->getClientOriginalName();
        }
        $item->image = $imagePath;

        $item->save();

        return redirect('items');
    }

    public function show($itemID)
    {
        $item = Item::find($itemID);
        return view('items.show', compact('item'));
    }

    public function edit($itemID)
    {
        $item = Item::find($itemID);

        if($item->user_id == Auth::user()->id){
            return view('items.edit')
                ->with('item', $item);
        }else{
            return redirect()->route('welcome');
        }
    }

    public function update(Request $request, $itemID)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'phone' => 'required'
        ]);
        $item = Item::find($itemID);
        $item->title = $request->get('title');
        $item->description = $request->get('description');
        $item->price = $request->get('price');
        $item->phone = $request->get('phone');
        $item->save();
        return redirect()->route('items.index');
    }
}
