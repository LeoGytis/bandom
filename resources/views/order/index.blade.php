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
                            {{-- <form class="delete form" action="{{route('orders-status', $order)}}" method="post">
                                @csrf
                                @method('put')
                                <div class="container">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>What status?</label>
                                                <select class="form-control" name="status">
                                                    @foreach($statuses as $key => $status)
                                                    <option value="{{$key}}" @if($key==$order->status) selected @endif>{{$status}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-outline-info m-4">Set status</button>
                                        </div>
                                        <div class="col-3">
                                            <a class="btn btn-outline-success m-4" href="{{route('orders-pdf', $order)}}">Get PDF</a>
                                        </div>
                                    </div>
                                </div>
                            </form> --}}
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
