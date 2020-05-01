@extends('admin.master')
@section('mainContent')
     <div class="main-content pt-4">
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">Cows</a></li>
                        <li>Cow Details</li>
                    </ul>
                </div>
                <div class="separator-breadcrumb border-top"></div>
                <div class="card user-profile o-hidden mb-4">
                    <div class="header-cover" style="background-image: url('{{asset('/')}}backend/uploads/cow/banner.jpg'); height:200px !important;"></div>
                    <div class="user-info" style="    margin-top: -100px;">
                        <img class="" style="height:220px; width:360px;border-radius: 22px;" src="{{asset('/')}}{{@$CowInfo->image}}"  alt="">
                        <p class="m-0 text-30">@if(isset($CowInfo)){{@$CowInfo->cow_name}}@endif</p>
                    </div>
                    <div class="card-body">
                       
                        <div class="tab-content">

                            <div >
                                <hr />
                                <div class="row">
                                    <div class="col-md-3 col-6" style="margin-left:60px;">
                                        <div class="mb-4">
                                            <p class="text-primary mb-1">Cow Name : <span> {{@$CowInfo->cow_name}}</span></p>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-primary mb-1"> Cow ID : <span># {{@$CowInfo->id}}</span></p>
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-7 col-6" style="border-left: 1px solid #000; padding-left:60px;">
                                        <h4 class="mb-4">Personal Info:</h4>
                                        <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1"> Bread Name : <span> {{@$CowInfo->bread_name}}</span></p>
                                        </div>
                                        <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1"> Seller Name : <span> {{@$CowInfo->seller_name}}</span></p>
                                        </div>
                                        @if (@$CowInfo->buyer_name != "")
                                            <div class="mb-4" style="border-bottom: 1px solid;">
                                                <p class="text-primary mb-1">Buyer Name : <span> {{@$CowInfo->buyer_name}}</span></p>
                                            </div>
                                        @endif
                                        <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1"> Buy Price: <span>${{@$CowInfo->buy_price}}</span></p>
                                        </div>
                                        @if (@$CowInfo->sell_price != "")
                                            <div class="mb-4" style="border-bottom: 1px solid;">
                                                <p class="text-primary mb-1"> Sell Price: <span>${{@$CowInfo->sell_price}}</span></p>
                                            </div>
                                        @endif
                                        
                                         <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1"> Cow Type :<span> @if (@$CowInfo->type==1)
                                                Milky Cow
                                            @else
                                                OX
                                            @endif</span></p>
                                        </div>
                                         <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1">Buy Purpose :<span> @if (@$CowInfo->purpose==1)
                                                Milky
                                            @else
                                                Meat
                                            @endif</span></p>
                                        </div>
                                        <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1"> Birth Date : <span> {{@$CowInfo->date_of_birth}}</span></p>
                                        </div>
                                        <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1"> Age/Year : <span> {{@$CowInfo->age}}</span></p>
                                        </div>
                                        <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1">Weight/KG : <span> {{@$CowInfo->weight}}</span></p>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                <hr />
                                <h4>Details</h4>
                                <p>
                                    {{@$CowInfo->details}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div><!-- end of main-content -->
            </div>
@endsection





