@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-3">
        <div class="col-md-12">
            <h3>Home delivery for {{$restaurant->name}}</h3>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
           <order-group
           :restaurant_id="{{$restaurant->id}}">
            </order-group> 
        </div>
    </div>
    
</div>
@endsection
  