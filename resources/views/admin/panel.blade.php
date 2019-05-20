@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(!Auth::user())
                <div class="col col-lg-6">
                    <a href="/items" class="btn btn-primary btn-lg">Show items</a>
                </div>
            @elseif(Auth::user())
                @if(Auth::user()->user_type == 0)
                    <div class="col col-lg-6">
                        <a href="/items" class="btn btn-primary btn-lg">Show items</a>
                    </div>
                    <div class="col col-lg-6">
                        <a href="/items/create" class="btn btn-warning btn-lg">Create item</a>
                    </div>
                @elseif(Auth::user()->user_type == 1)
                    <div class="col col-lg-6">
                        <a href="/admin/items" class="btn btn-primary btn-lg">List all items</a>
                    </div>
                    <div class="col col-lg-6">
                        <a href="/admin/users" class="btn btn-warning btn-lg">List all users</a>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection