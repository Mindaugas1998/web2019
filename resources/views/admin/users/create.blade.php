@extends('layouts.app')

@section('content')
    <div class="container">
        <form enctype="multipart/form-data" action="{{ route('admin.users.store') }}" id="createUser" class="form-horizontal" method="POST" >
            {{csrf_field()}}

            <div class="form-group">
                <label for="user_type">User type</label>
                <input type="number" class="form-control" id="user_type" name="user_type" placeholder="User type">
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="YourEmail@example.com">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" id="password" name="password" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection