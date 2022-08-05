@extends('layouts.app')

@section('content')
<div class="hr mb-3"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-color">
                <div class="card-header header-color">List of Autoshops</div>
                <div class="card-body">
                    @foreach ($autoshops as $autoshop)
                    <div class="list-info mb-3">
                        <div class="info">
                            {{$autoshop->name}}<br>
                            {{$autoshop->address}}<br>
                            {{$autoshop->phone_nr}}<br>
                            <a class="more-info-link" href="{{route('autoshop.show', $autoshop->id)}}"
                                role="button">More info</a>
                        </div>
                        <div class="list-buttons">
                            <a class="btn btn-outline-success" href="{{route('autoshop.edit',$autoshop)}}">EDIT</a><br>
                            <form method="POST" action="{{route('autoshop.destroy', $autoshop)}}">
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
