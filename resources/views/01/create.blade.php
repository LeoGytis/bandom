@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Create new autoshop</div>
                <div class="card-body">
                    <form class="d-flex flex-column align-items-center" method="POST" action="{{route('autoshop.store')}}">
                        <div class="col-md-4 ms-3 mb-3">
                            Name: <input type="text" name="autoshop_name">
                            Address: <input type="text" name="autoshop_address">
                            Phone number: <input type="text" name="autoshop_phone_nr">
                        </div>
                        @csrf
                        <button class="btn btn-outline-success mt-3" type="submit">Create</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection
