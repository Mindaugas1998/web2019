@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-lg-6" align="center" style="margin-left: auto; margin-right: auto">
                <div class="card">
                    <img class="card-img-top" src="/uploads/{{ $item->image }}"
                         alt="Card image cap" style="min-width: 40px; min-height: 40px;
                          max-width: 150px; max-height: 150px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ $item->description }}</p>
                        <div>{{ $item->price }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

