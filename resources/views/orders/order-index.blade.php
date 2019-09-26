@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-3">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h3>Manage Orders for {{$restaurant->name}}</h3>
                </div>
                <div class="col-md-6">      
                    <a style="color:white" class="btn btn-sm btn-info" href="{{route('restaurants.orders.add', $restaurant->id)}}">Add Order</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
            <div class="col-md-12">
                @if($orders->count() > 0)
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Customer Details</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->amount}}</td>
                                <td>{{($order->isComplete) ? 'Complete' : 'Incomplete'}}</td>
                                <td>
                                    Name: {{$order['order_details']['customer_name']}}
                                    <br>
                                    Phone: {{$order['order_details']['customer_phone']}}
                                    <br>
                                    Address: {{$order['order_details']['customer_address']}}
                                </td>
                            </tr>
                        @endforeach()
                    </tbody>
                </table>

                <div class="col-md-2 mx-auto">
                    <div class="center" style="text-align:center">
                        {{$orders->render()}}
                    </div>
                </div>

                @else
                <p>You have no orders yet</p>
                @endif
            </div>
        </div>
    
</div>
@endsection
 