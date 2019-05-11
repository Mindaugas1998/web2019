@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-lg-6">
                {{ $user->id }} {{ $user->user_type }} {{ $user->name }} {{ $user->email }} {{ $user->password }}
            </div>
        </div>
    </div>
@endsection



