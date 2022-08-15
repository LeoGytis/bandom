@extends('layouts.app')

@section('content')
<div class="hr mb-3"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header header-color">List of Hotels</div>
                <div class="card-body">
                    <div class="droppy dropend mb-3">
                        <div class="btn btn btn-secondary btn-sm dropdown-toggle ">
                            Sort by:
                        </div>
                        <div class="drop-pop">
                            <a class="btn btn-secondary btn-sm ms-1" href="{{route('hotel.index', ['sort' => 'price-asc'])}}" role="button">Price 0-99</a>
                            <a class="btn btn-secondary btn-sm" href="{{route('hotel.index', ['sort' => 'price-desc'])}}" role="button">Price 99-0</a>
                        </div>
                    </div>
                    @foreach ($hotels as $hotel)
                    <div class="d-flex justify-content-start grey-line mb-3">

                        @if($hotel->photo)
                        <div class="image-box mb-3 me-3">
                            <img src="{{$hotel->photo}}">
                        </div>
                        @endif

                        <div class="d-flex flex-column justify-content-between mb-3">
                            <div>
                                <b>{{$hotel->name}}</b><br>
                                Pirce: {{$hotel->price}}€<br>
                                Trip Time: {{$hotel->trip_time}} days<br>
                                Country: {{$hotel->hotelCountry->name}} <br>
                            </div>
                            <div class="mt-3">
                                <form method="post" action="{{route('orders-add')}}">
                                    @csrf
                                    @method('post')
                                    <input class="order-count" type="number" name="hotels_count">
                                    <input type="hidden" value="{{$hotel->id}}" name="hotel_id">
                                    <button class="btn btn-outline-success me-3" type="submit">Order</button>
                                </form>
                            </div>
                            @if (Auth::user()->role > 9)
                            <div class="d-flex flex-row justify-content-start mt-1">
                                <a class="btn btn-outline-success me-1" href="{{route('hotel.edit',$hotel)}}">EDIT</a><br>
                                <form method="POST" action="{{route('hotel.destroy', $hotel)}}">
                                    @csrf
                                    <button class="btn btn-outline-secondary" type="submit">DELETE</button>
                                </form>
                            </div>
                            @endif
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
