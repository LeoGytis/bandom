@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Edit your Autoshop {{$autoshop->name}}</div>
                <div class="card-body">
                    <form class="d-flex flex-column align-items-center" method="POST" action="{{route('autoshop.update',$autoshop)}}">
                        <div class="col-md-4 ms-3 mb-3">
                            Name: <input type="text" name="autoshop_name" value="{{$autoshop->name}}"><br>
                            Address: <input type="text" name="autoshop_address" value="{{$autoshop->address}}"><br>
                            Phone number: <input type="text" name="autoshop_phone_nr" value="{{$autoshop->phone_nr}}"><br>
                        </div>
                        @csrf
                        <button class="btn btn-outline-success mt-3 mb-3" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
