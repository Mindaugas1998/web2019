@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="col col-lg-6" align="center" style="margin-left: auto; margin-right: auto">
                    <div class="card">
                        <img class="card-img-top" src="/uploads/{{ $item->image }}"
                             alt="Card image cap" style="max-width: 150px; max-height: 150px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ $item->description }}</p>
                            <div>{{ $item->price }}</div>


                            @if($item->user_id == Auth::user()->id)
                                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('items.show', $item->id) }}" class="btn btn-danger">Delete</a>
                            @else
                                <a href="{{ route('items.show', $item->id) }}" class="btn btn-success">Buy</a>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection


