@extends('admin.master')

@section('mainContent')
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Foods</a></li>
            <li><a href="#">Food Stock</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row" style="margin-bottom: 150px !important;">
        
        @foreach ($food_stocks as $item)
            <!-- Food Stock-->
        <div class="col-lg-5 col-md-6 col-sm-6" style="left:100px">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4" style="height:200px">
                <div class="card-body text-center">
                    <div class="content text-center" style="max-width:100% !important;">
                       <h5 class="text-muted">Food ID:</h5>
                       <h4 class="text-muted">#{{$item->food_id}}</h4>
                        <i class="i-Checkout-Basket"></i>
                    </div>
                    <div class="content text-center" style="max-width:100% !important;">
                        
                        <h5 class="text-muted">Food Name:</h5>
                        <h5 class="text-muted"><b> ({{$item->name}})</b></h5>
                        <h4 class="text-muted">Available Quantity</h4>
                        <p class="text-primary text-24 line-height-1 mt-2 mb-2" style="margin-left: 40px;">{{$item->quantity}} KG</p>
                        @if ($item->quantity<10)
                            <h5 class="text-muted" style="color:red  !important;">Stock Is Low. Please Update..</h5>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- End food Stock-->
        @endforeach
    </div>
@endsection