@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Create new autoshop</div>
                <div class="card-body">
                    <form class="d-flex flex-column align-items-center" method="POST" action="{{route('hotel.store')}}">
                        Name: <input type="text" name="hotel_name">
                        Price: <input type="text" name="hotel_price">
                        Trip Time: <input type="text" name="hotel_trip_time">
                        Photo: <input type="text" name="hotel_photo">
                        <select class="mt-3" name="country_id">
                            @foreach ($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}} {{$country->s_time}}</option>
                            @endforeach
                     </select>
                        @csrf
                        <button class="btn btn-outline-success mt-3" type="submit">ADD</button>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
