@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <restaurant-group 
                :restaurants="{{json_encode($restaurants)}}">
            </restaurant-group>
        </div>
    </div>
    
</div>
@endsection
 