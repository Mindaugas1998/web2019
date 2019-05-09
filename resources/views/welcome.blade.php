@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-lg-6">
                <a href="/items" class="btn btn-primary btn-lg">Show items</a>
            </div>
            <div class="col col-lg-6">
                <a href="/items/create" class="btn btn-warning btn-lg">Create item</a>
            </div>
        </div>
    </div>
@endsection

