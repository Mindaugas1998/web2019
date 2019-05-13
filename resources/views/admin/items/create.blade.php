@extends('layouts.app')

@section('content')
    <div class="container">
        <form enctype="multipart/form-data" action="{{ route('admin.items.store') }}" id="createItem" class="form-horizontal" method="POST" >
            {{csrf_field()}}

            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="number" class="form-control" id="user_id" name="user_id" placeholder="User ID">
            </div>

            <div class="form-group">
                <label for="item_title">Item Title</label>
                <input type="text" class="form-control" id="item_title" name="item_title" placeholder="Item Title">
            </div>

            <div class="form-group">
                <label for="item_description">Item Description</label>
                <input type="text" class="form-control" id="item_description" name="item_description" placeholder="Item Description">
            </div>

            <div class="form-group">
                <label for="item_price">Item Price</label>
                <input type="number" class="form-control" id="item_price" name="item_price" placeholder="Item Price">
            </div>

            <div class="form-group">
                <label for="item_phone">Item Phone</label>
                <input type="number" class="form-control" id="item_phone" name="item_phone" placeholder="Phone Number">
            </div>

            <div class="form-group">
                <label for="image">Upload Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
@endsection