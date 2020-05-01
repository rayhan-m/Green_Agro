@extends('admin.master')

@section('mainContent')
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Milk Stock</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row" style="margin-bottom: 150px !important;">
        
        <!-- Total Stock-->
        <div class="col-lg-4 col-md-6 col-sm-6" style="left:100px">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4" style="height:200px">
                <div class="card-body text-center"><i class="i-Checkout-Basket mt-5"></i>
                    <div class="content" style="max-width:100% !important;">
                        <h4 class="text-muted mt-2 mb-5">Available Quantity</h4>
                        <p class="text-primary text-24 line-height-1 mb-2" style="margin-left: 40px;">{{$milk_stocks->quantity}} Ltr.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Day Collection-->
        <div class="col-lg-4 col-md-6 col-sm-6" style="left:200px">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4" style="height:200px">
                <div class="card-body text-center"><i class="i-Checkout-Basket mt-5"></i>
                    <div class="content" style="max-width:100% !important;">
                        <h4 class="text-muted mt-2 mb-5">Today's Collections</h4>
                        <p class="text-primary text-24 line-height-1 mb-2" style="margin-left:40px;">{{ $total_collect}} Ltr.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection