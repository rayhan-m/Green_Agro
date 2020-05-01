@php
    $setting=App\GeneralSetting::where('active_status',1)->first();
@endphp
@extends('admin.master')
@section('mainContent')
<div class="main-content pt-4" id="print">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="true">Income Summery</a></li>
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
                                                <h4 class="font-weight-bold">Income Summery</h4>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12 table-responsive">
                                                <table class="table table-hover mb-4">
                                                    <thead class="bg-gray-300">
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Type</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                        
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <tr>
                                                            <th>1</th>
                                                            <th>Total Income From Cow</th>
                                                            <th>${{@$grand_total_cow}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>2</th>
                                                            <th>Total Income From Milk</th>
                                                            <th>${{@$grand_total_milk}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>3</th>
                                                            <th>Total Expense</th>
                                                            <th>${{@$total_expenes}}</th>
                                                        </tr>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            
                                            <div class="col-md-9 mb-40">
                                                <div class="invoice-summary" style="width: 400px;">
                                                    <h5 class="font-weight-bold">Income Summery: <span style="width: 150px;">$({{$income_summery}}) ( @if ($income_summery>0) Profit @else Loss @endif )</span></h5>
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





