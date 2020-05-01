@php
    $setting=App\GeneralSetting::where('active_status',1)->first();
@endphp
@extends('admin.master')
@section('mainContent')
<div class="main-content pt-4" id="print">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="true">Expense Report</a></li>
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
                                                <h4 class="font-weight-bold">Expense Report</h4>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12 table-responsive">
                                                <table class="table table-hover mb-4">
                                                    <thead class="bg-gray-300">
                                                        <tr>
                                                            <th style="width:10%">SL</th>
                                                            <th style="width:40%">Expense Type</th>
                                                            <th style="width:25%">Expense Date</th>
                                                            <th style="width:25%">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $count=1;
                                                        @endphp
                                                        @foreach ($data as $item)
                                                        <tr>
                                                            <th scope="row">{{$count++}}</th>
                                                            <td>{{@$item->name}}</td>
                                                            <td>{{@$item->expense_date}}</td>
                                                            <td>{{@$item->amount}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            
                                            <div class="col-md-10 mb-40">
                                                <div class="invoice-summary">
                                                    <h5 class="font-weight-bold">Grand Total: <span>${{$grand_total}}</span></h5>
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





