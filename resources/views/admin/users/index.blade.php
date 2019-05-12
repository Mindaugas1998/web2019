@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table ">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>User Type</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td scope="row">{{$user->id}}</td>
                        <td>{{$user->user_type}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a href="{{route('admin.users.show', $user->id)}}" class="btn btn-success">View</a>
                        </td>
                        <td>
                            @if(Auth::user()->user_type == 1)
                                @if($user->id != Auth::user()->id)
                                    <form method="POST" action="/admin/users/{{ $user->id }}">
                                        @method('DELETE')
                                        @csrf
                                        <div class="field">
                                            <div>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{route('admin.users.create')}}" class="btn btn-success">Create new user</a>

    </div>

@endsection

@push('scripts')
    <script>

        $(document).ready( function () {
            $('.table').DataTable();
        } );

    </script>
@endpush

