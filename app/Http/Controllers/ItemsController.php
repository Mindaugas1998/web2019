<?php

namespace App\Http\Controllers;

use App\BuyInfo;
use App\Item;
use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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

        try {
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

            $log = new Log();
            $log->log = 'User: ' . Auth::user()->id . ' created item ' . $item->title;
            $log->save();

            return redirect('items');
        }
        catch (Exception $e) {
            $log->log = $e->getMessage();
            $log->save();
            return redirect()->back();
        }
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
        try {
            $item = Item::find($itemID);
            $item->title = $request->get('title');
            $item->description = $request->get('description');
            $item->price = $request->get('price');
            $item->phone = $request->get('phone');
            $item->save();

            $log = new Log();
            $log->log = 'User: ' . Auth::user()->id . ' edited item ' . $item->title;
            $log->save();

            return redirect()->route('items.index');
        }
        catch (Exception $e) {
            $log->log = $e->getMessage();
            $log->save();
            return redirect()->back();
        }
    }

    public function destroy($itemID)
    {
        try {
            $item = Item::find($itemID);
            $deleted = $item->delete();

            if(File::exists($item->image)){
                File::delete($item->image);
            }

            $log = new Log();
            $log->log = 'User: ' . Auth::user()->id . ' deleted item ' . $item->title;
            $log->save();

            if($deleted){
                return response([
                    'success' => true,
                    'url' => route('items.index')
                ]);
            }
        }
        catch (Exception $e) {
            $log->log = $e->getMessage();
            $log->save();
            return redirect()->back();
        }
    }

    public function showMyItems()
    {
        $items = Item::where('user_id', Auth::user()->id)->get();


        return view('items.my_items', compact('items'));
    }

    public function buyItem(Request $request, $itemID)
    {
        $this->validate($request, [
            'address' => 'required|string',
            'phone' => 'required|integer',
        ]);

        $item = Item::find($itemID);
        $item->is_bought = 1;
        $item->save();

        $buy_info = new BuyInfo();

        $buy_info->item_id = $itemID;
        $buy_info->user_id = Auth::user()->id;
        $buy_info->contact_address = $request->get('address');
        $buy_info->contact_phone = $request->get('phone');

        $buy_info->save();

        return view('items.show', compact('item'));

    }

    public function getIndex()
    {
        $json_url = 'https://api.darksky.net/forecast/06d3d09fa7209984883deb1f79cea0e6/54.396121,24.045931?units=auto&exclude=[minutely%2Chourly%2Cdaily&fbclid=IwAR3ttNxqfmpgCSy-LhMfbMPZ4AembN7rIqRIBjPkkqO2SznV-7YpXP73hGU';
        $json = file_get_contents($json_url);
        $decode = json_decode($json, True);
        $decode['currently']['time'] = gmdate("F j, Y, g:i a", $decode['currently']['time'] + 10800);
        $decode['currently']['humidity'] = $decode['currently']['humidity'] * 100;
        return view('welcome', compact('decode'));
    }
}
