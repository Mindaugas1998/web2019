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
                            @if($item->is_bought == 0)
                                @if($item->user_id == Auth::user()->id)
                                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('items.destroy', $item->id) }}" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Delete</a>
                                @elseif(Auth::user()->user_type == 0)
                                    <a class="btn btn-success" data-toggle="modal" data-target="#buyModal">Buy</a>
                                @endif
                            @else
                                @if(Auth::user()->boughtByMe($item->id))
                                    <div class="alert alert-success" role="alert">
                                        Congratulations!!! You have bought this item!
                                    </div>
                                @else
                                    <div class="alert alert-warning" role="alert">
                                        Item already bought
                                    </div>
                                @endif
                            @endif
                        @else
                            <div class="alert alert-warning" role="alert">
                                Please login to buy
                            </div>
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

    <!-- Modal -->
    <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">


                    <form enctype="multipart/form-data" action="{{ route('items.buy_item', $item->id) }}" id="createItem" class="form-horizontal" method="POST" >
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="title">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Your address">
                        </div>

                        <div class="form-group">
                            <label for="title">Phone</label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Your phone">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
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


