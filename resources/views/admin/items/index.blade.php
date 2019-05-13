@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="items_table ">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>View</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td scope="row">{{$item->id}}</td>
                    <td>{{$item->user_id}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->price}}</td>
                    <td>
                        <a href="{{route('admin.items.show', $item->id)}}" class="btn btn-success">View</a>
                    </td>
                    <td>
                        @if(Auth::user()->user_type == 1)
                            <form method="POST" action="/admin/items/{{ $item->id }}">
                                @method('DELETE')
                                @csrf
                                <div class="field">
                                    <div>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a href="{{route('admin.items.create')}}" class="btn btn-success">Create new item</a>

    </div>

@endsection

@push('scripts')
    <script>

        $(document).ready( function () {
            $('.items_table').DataTable();
        } );

    </script>
@endpush

