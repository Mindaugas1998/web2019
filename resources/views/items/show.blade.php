@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="col col-lg-6" align="center" style="margin-left: auto; margin-right: auto">
                    <div class="card">
                        <img class="card-img-top" src="/uploads/{{ $item->image }}"
                             alt="Card image cap" style="max-width: 150px; max-height: 150px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ $item->description }}</p>
                            <div>{{ $item->price }}</div>
                        @if(Auth::user())
                            @if($item->user_id == Auth::user()->id)
                                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('items.destroy', $item->id) }}" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Delete</a>
                            @else
                                <a href="{{ route('items.show', $item->id) }}" class="btn btn-success">Buy</a>
                            @endif
                        @else
                                <a href="{{ route('items.show', $item->id) }}" class="btn btn-success">Buy</a>
                        @endif
                        </div>
                    </div>
                </div>
        </div>
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
                    <button type="button" class="btn btn-sm btn-danger" onclick="destroyItem({{ json_encode(route('items.destroy', $item->id)) }})">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function destroyItem(url) {
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


