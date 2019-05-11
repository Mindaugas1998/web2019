@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        @foreach($users as $user)
            <div class="col col-lg-4">
                {{ $user->id }} {{ $user->name }} {{ $user->email}}
                <a href="{{route('admin.users.show', $user->id)}}" class="btn btn-success">View</a>
                <a href="{{ route('admin.users.destroy', $user->id) }}" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Delete</a>
                <h3></h3>
            </div>
        @endforeach

        </div>
            <a href="{{route('admin.users.create')}}" class="btn btn-success">Create new user</a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    Do you really want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="destroyUser({{ json_encode(route('admin.users.destroy', $user->id)) }})">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection

<script>
    function destroyUser(url) {
        $.ajax({
            url: url,
            method: 'DELETE',
            data: {
                _token: {!! json_encode(csrf_token()) !!}
            },
            success: function (data) {
                window.location = data['url'];
            }
        });
    }
</script>

