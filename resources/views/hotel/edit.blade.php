@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Edit {{$hotel->name}}</div>
                <div class="card-body">
                    <form class="d-flex flex-column align-items-center" method="POST" action="{{route('hotel.update',$hotel)}}">
                        <div class="col-md-4 ms-3 mb-3">
                            Name: <input type="text" name="hotel_name" value="{{$hotel->name}}"><br>
                            Price: <input type="text" name="hotel_price" value="{{$hotel->price}}"><br>
                            Trip time: <input type="text" name="hotel_trip_time" value="{{$hotel->trip_time}}"><br>
                            Photo: <input type="text" name="hotel_photo" value="{{$hotel->photo}}"><br>
                        </div>
                        <select name="country_id">
                            @foreach ($countries as $country)
                            <option value="{{$country->id}}" @if($country->id == $hotel->country_id) selected @endif>
                                {{$country->name}} {{$country->s_time}}
                            </option>
                            @endforeach
                        </select>

                        @csrf
                        <button class="btn btn-outline-success mt-3 mb-3" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
