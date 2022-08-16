@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">List of Orders</div>
                <div class="card-body">
                    @foreach ($orders as $order)
                    <div class="d-flex flex-row justify-content-between grey-line mb-3">
                        <div>
                            <div class="mb-3">
                                <b>Order for: {{$order->client->name}}</b><br>
                                {{$order->count}}x {{$order->hotel->name}}<br>
                                @if( $order->status == 3) 
                                    <div class="btn btn-success disabled">
                                        Approved
                                    </div>
                                @endif
                            </div>
                            @if (Auth::user()->role > 9)
                            <form method="POST" action="{{route('order.destroy', $order)}}">
                                @csrf
                                <button class="btn btn-outline-dark mt-3 mb-1" type="submit">Delete Order</button>
                            </form>
                            @endif
                        </div>
                        @if (Auth::user()->role > 9)
                        <div>
                            <form class="d-flex flex-row justify-content-end mb-2" action="{{route('order.status', $order)}}" method="post">
                                <div>
                                    <label>Status:</label>
                                    <select class="form-select" name="status">
                                        @foreach($statuses as $key => $status)
                                        <option value="{{$key}}" @if($key==$order->status) selected @endif>{{$status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-success m-4">Set status</button>
                            </form>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
