@extends('layouts.app')

@section('content')
    <div class="container">
        <form enctype="multipart/form-data" action="{{ route('items.store') }}" id="createItem" class="form-horizontal" method="POST" >
            {{csrf_field()}}

            <div class="form-group">
                <label for="title">Item Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Item title">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" rows="5" id="description" name="description" placeholder="Description"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Upload Image</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price">
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="number" class="form-control" id="phone" name="phone">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection


