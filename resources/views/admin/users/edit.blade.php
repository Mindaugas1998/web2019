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

        <form action="{{route('admin.users.update', $user)}}" id="user_form" method="POST">
            <input type="hidden" name="_method" value="PATCH">
            {{csrf_field()}}

            <div class="form-group">
                <label for="user_type">User type</label>
                <input type="number" class="form-control" id="user_type" name="user_type"
                       placeholder="User type" value="{{$user->user_type}}">
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                       placeholder="Name" value="{{$user->name}}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email"
                       placeholder="YourEmail@exmaple.com" value="{{$user->email}}">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" id="password" name="password"
                       placeholder="Password" value="{{$user->password}}">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>






{{--    <form method="POST" action="{{route('admin.users.update', $user)}}">--}}
{{--        <input type="hidden" name="_method" value="DELETE">--}}
{{--        {{csrf_field()}}--}}

{{--        <div class="field">--}}
{{--            <div> class="control">--}}
{{--                <button type="submit" class="button">Delete Project</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}
@endsection