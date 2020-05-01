@php
    $setting=App\GeneralSetting::where('active_status',1)->first();
@endphp
@extends('admin.master')
@section('mainContent')
<div class="main-content pt-4" id="print">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="true">Cow Sell Report</a></li>
                        </ul>
                        <div class="card">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                                    <div class="d-sm-flex mb-5" data-view="print"><span class="m-auto"></span>
                                        <button onclick="javascript:printDiv('print')" class="btn btn-primary mb-sm-0 mb-3 print-invoice">Print Report</button>
                                    </div>
                                    <!-- -===== Print Area =======-->
                                    <div id="print-area" >
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h4 class="font-weight-bold">Cow Sell Report</h4>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12 table-responsive">
                                                <table class="table table-hover mb-4">
                                                    <thead class="bg-gray-300">
                                                        <tr>
                                                            <th scope="col">SL</th>
                                                            <th scope="col">Cow Name</th>
                                                            <th scope="col">Bread Name</th>
                                                            <th scope="col">Buyer Name</th>
                                                            <th scope="col">Buy Price</th>
                                                            <th scope="col">Sell Price</th>
                                                            <th scope="col">Profit/Loss</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $count=1;
                                                        @endphp
                                                        @foreach ($sell_data as $item)
                                                        <tr>
                                                            <th scope="row">{{$count++}}</th>
                                                            <td>{{$item->cow_name}}</td>
                                                            <td>{{$item->bread_name}}</td>
                                                            <td>{{$item->buyer_name}}</td>
                                                            <td>{{$item->buy_price}}</td>
                                                            <td>{{$item->sell_price}}</td>
                                                            @php
                                                                $profit_loss =$item->sell_price - $item->buy_price;
                                                                
                                                            @endphp
                                                            <td>{{@$profit_loss}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            
                                            <div class="col-md-11 mb-40">
                                                <div class="invoice-summary" style="width:270px !important;">
                                                <h5 class="font-weight-bold">Total Profit/Loss: <span>${{@$grand_total}}</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ==== / Print Area =====-->
                                </div>
                                <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end of main-content -->
            </div>
            
            <script>
                function printDiv(divID) {
                    //Get the HTML of div
                    var divElements = document.getElementById(divID).innerHTML;
                    //Get the HTML of whole page
                    var oldPage = document.body.innerHTML;
                    //Reset the page's HTML with div's HTML only
                    document.body.innerHTML = "<html><head><title></title></head><body>" + divElements + "</body>";
                    //Print Page
                    window.print();
                    //Restore orignal HTML
                    document.body.innerHTML = oldPage;
                }

            </script>
@endsection





