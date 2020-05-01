@php
    $setting=App\GeneralSetting::where('active_status',1)->first();
@endphp
@extends('admin.master')
@section('mainContent')
<div class="main-content pt-4" id="print">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="true">Invoice</a></li>
                        </ul>
                        <div class="card">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                                    <div class="d-sm-flex mb-5" data-view="print"><span class="m-auto"></span>
                                        <button onclick="javascript:printDiv('print')" class="btn btn-primary mb-sm-0 mb-3 print-invoice">Print Invoice</button>
                                    </div>
                                    <!-- -===== Print Area =======-->
                                    <div id="print-area" >
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="font-weight-bold">Payment Info</h4>
                                                <p>Payment ID : <strong>#{{@$milk_payment->id}}</strong></p>
                                                <p>Payment Date : <strong>{{@$milk_payment->payment_date}} </strong></p>
                                                <h5>Payment Statud : <strong>  @if (@$milk_payment->payment_status==1) Paid @else Due @endif </strong></h5>
                                            </div>
                                            <div class="col-md-6 text-sm-right">
                                                <h4 class="font-weight-bold">Buyer Info</h4>
                                                <p>Buyer ID : <strong>#{{$sellBuyer->milk_buyer_id}}</strong></p>
                                                <p>Buyer Name : <strong>{{$sellBuyer->name}}</strong></p>
                                            </div>
                                        </div>
                                        <div class="mt-3 mb-4 border-top"></div>
                                        <div class="row">
                                            <div class="col-md-12 table-responsive">
                                                <table class="table table-hover mb-4">
                                                    <thead class="bg-gray-300">
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Item Name</th>
                                                            <th scope="col">Unit Price</th>
                                                            <th scope="col">Quentity</th>
                                                            <th scope="col">Cost</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $count=1;
                                                        @endphp
                                                        @foreach ($Sell_milk_info as $item)
                                                        <tr>
                                                            <th scope="row">{{$count++}}</th>
                                                            <td>{{$item->sell_date}}</td>
                                                            <td>{{$item->price}}</td>
                                                            <td>{{$item->quantity}}</td>
                                                            <td>{{$item->total}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            
                                            <div class="col-md-12 mb-40">
                                                <div class="invoice-summary">
                                                    <p>Sub total: <span>${{$total_payable}}</span></p>
                                                    {{-- <p>Vat: <span>$120</span></p> --}}
                                                    {{-- <h5 class="font-weight-bold">Grand Total: <span>${{$orders->total}}</span></h5> --}}
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





