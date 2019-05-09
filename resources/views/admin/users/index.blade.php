@extends('layouts.app')

@section('content')
            @foreach($users as $user)
                <div>
                    {{ $user->id }} {{ $user->name }} {{ $user->email}}
                </div>
            @endforeach
@endsection