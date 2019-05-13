@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('admin.items.update', $item)}}" id="item_form" method="POST">
            <input type="hidden" name="_method" value="PATCH">
            {{csrf_field()}}

            <div class="form-group">
                <label for="item_title">Item Title</label>
                <input type="text" class="form-control" id="item_title" name="item_title"
                       placeholder="Item title" value="{{$item->title}}">
            </div>

            <div class="form-group">
                <label for="item_description">Description</label>
                <textarea class="form-control" rows="5" id="item_description" name="item_description"
                          placeholder="Description">{{$item->description}}</textarea>
            </div>

            <div class="form-group">
                <label for="item_price">Price</label>
                <input type="number" step="0.01" class="form-control" id="item_price" name="item_price"
                       value="{{$item->price}}">
            </div>
            <div class="form-group">
                <label for="item_phone">Phone Number</label>
                <input type="number" class="form-control" id="item_phone" name="item_phone" value="{{$item->phone}}">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection


