@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($items as $item)
                <div class="col col-lg-3">
                    <div class="card">
                        <img class="card-img-top" src="/uploads/{{ $item->image }}"
                             alt="Card image cap" style="max-width: 150px; max-height: 150px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ $item->description }}</p>
                            <a href="{{ route('items.show', $item->id) }}" class="btn btn-primary">View</a>
                        </div>
                        <div class="card-footer">{{ $item->price }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection