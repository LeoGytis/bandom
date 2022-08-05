@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">List of Orders</div>
                <div class="card-body">
                    @foreach ($orders as $order)
                    <div class="list-info d-flex justify-content-between">
                        <div class="info i-block"><br>
                            <b>Order for: </b><br>
                            {{$order->count}}x {{$order->hotel->name}}<br><br>
                        </div>
                        @if (Auth::user()->role > 9)
                        <div class="list-buttons">
                            <a class="btn btn-outline-success" href="{{route('orders-approve', $order)}}">Approve</a><br>
                            <form method="POST" action="{{route('orders-destroy', $order)}}">
                                @csrf
                                <button class="btn btn-outline-secondary ms-3" type="submit">DELETE</button>
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
