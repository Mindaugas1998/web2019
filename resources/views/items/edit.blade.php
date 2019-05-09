@extends('layouts.app')

@section('content')
    <div class="container">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('items.update', $item)}}" id="item_form" method="POST">
            <input type="hidden" name="_method" value="PATCH">
            {{csrf_field()}}

            <div class="form-group">
                <label for="title">Item Title</label>
                <input type="text" class="form-control" id="title" name="title"
                       placeholder="Item title" value="{{$item->title}}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" rows="5" id="description" name="description"
                          placeholder="Description">{{$item->description}}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price"
                       value="{{$item->price}}">
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="number" class="form-control" id="phone" name="phone" value="{{$item->phone}}">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection


