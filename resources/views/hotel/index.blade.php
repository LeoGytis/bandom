@extends('layouts.app')

@section('content')
<div class="hr mb-3"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-color">
                <div class="card-header header-color">List of Hotels</div>
                <div class="card-body">
                    <div class="droppy dropright mb-3">
                    <div class="btn btn btn-secondary btn-sm dropdown-toggle ">
                        Sort by:
                    </div>
                    <div class="drop-pop">
                        <a class="btn btn-secondary btn-sm" href="{{route('hotel.index', ['sort' => 'price-asc'])}}" role="button">Price 0-99</a>
                        <a class="btn btn-secondary btn-sm" href="{{route('hotel.index', ['sort' => 'price-desc'])}}" role="button">Price 99-0</a>
                    </div>
                </div>
                    @foreach ($hotels as $hotel)
                    <div class="list-info mb-3">
                        <div class="info">
                            @if($hotel->photo)
                            <div class="image-box">
                                <img src="{{$hotel->photo}}">
                            </div>
                            @endif
                            {{$hotel->name}}<br>
                            Pirce: {{$hotel->price}}€<br>
                            Trip Time: {{$hotel->trip_time}} days<br>
                            Country: {{$hotel->hotelCountry->name}} <br>
                            {{-- <a class="more-info-link" href="{{route('hotel.show', $hotel->id)}}" role="button">More info</a> --}}
                        </div>
                        @if (Auth::user()->role > 9)
                        <div class="list-buttons">
                            <a class="btn btn-outline-success" href="{{route('hotel.edit',$hotel)}}">EDIT</a><br>
                            <form method="POST" action="{{route('hotel.destroy', $hotel)}}">
                                @csrf
                                <button class="btn btn-outline-secondary ms-3" type="submit">DELETE</button>
                            </form>
                        </div>
                        @endif
                        <div class="list-buttons">
                            <form method="post" action="{{route('orders-add')}}">
                                @csrf
                                @method('post')
                                <input class="order-count" type="number" name="hotels_count">
                                <input type="hidden" value="{{$hotel->id}}" name="hotel_id">
                                <button class="btn btn-outline-success me-3" type="submit">Order</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
