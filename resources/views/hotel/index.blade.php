@extends('layouts.app')

@section('content')
<div class="hr mb-3"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-color">
                <div class="card-header header-color">List of Hotels</div>
                <div class="card-body">
                    @foreach ($hotels as $hotel)
                    <div class="list-info mb-3">
                        <div class="info">
                            {{$hotel->name}}<br>
                            {{$hotel->price}}<br>
                            {{$hotel->trip_time}}<br>
                            {{-- {{$hotel->hotelCountry->name}}  --}}

                            {{-- <a class="more-info-link" href="{{route('hotel.show', $hotel->id)}}"
                                role="button">More info</a> --}}
                        </div>
                        <div class="list-buttons">
                            <a class="btn btn-outline-success" href="{{route('hotel.edit',$hotel)}}">EDIT</a><br>
                            <form method="POST" action="{{route('hotel.destroy', $hotel)}}">
                                @csrf
                                <button class="btn btn-outline-secondary ms-3" type="submit">DELETE</button>
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
