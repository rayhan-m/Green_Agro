@extends('admin.master')
@section('mainContent')

    
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Payments</a></li>
            <li>Milk Payment</li>
        </ul>
    </div>
    <div class=" border-top"></div>
    <div class="mt-20 mb-20">
        <a href="{{route('milk_payment_create')}}"> <button type="button" class="btn btn-primary"> <span>+</span> Payment</button></a>
    </div>

     <!-- Table row-->
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%; font-size:12px;">
                                        <thead>
                                            <tr>
                                                <th>Buyer ID</th>
                                                <th>Buyer Name</th>
                                                <th>From Date</th>
                                                <th>To Date</th>
                                                <th>Paid Amount</th>
                                                <th>Payment Date</th>
                                                <th>Payment Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payments as $item)
                                                <tr>
                                                    <td>#{{$item->buyer_id }}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->from_date}}</td>
                                                    <td>{{$item->to_date}}</td>
                                                    <td>{{$item->pay_amount}}</td>
                                                    <td>{{$item->payment_date}}</td>
                                                    <td>
                                                        @if ($item->payment_status==1)
                                                            <a href="#"><label class="badge badge-success">Paid</label></a>
                                                            {{-- <a href="{{ url('admin/milk-payment-deactive/'.$item->id)}}"><label class="badge badge-success">Paid</label></a> --}}
                                                        @else
                                                            <a href="{{ url('admin/milk-payment-active/'.$item->id)}}" ><label class="badge badge-danger">Due</label></a>
                                                        @endif
                                                    </td>
                                                    {{-- <td>{{$item->active_status}}</td> --}}
                                                    <td> 
                                                        @if ($item->payment_status==0)
                                                            <a  data-toggle="modal" data-target="#deleteModal{{$item->id}}"  href="#" class="disabled"><i class="fa fa-trash" title="Delete" aria-hidden="true"></i></a>
                                                        @endif
                                                        <a class="btn btn-primary" href="{{ url('admin/invoice/'.$item->id)}}">Invoice</a>
                                                    </td>
                                                </tr>
                                              
                                            {{-- Delete Modal--}}
                                            <div  class="modal fade" id="deleteModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true" >
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Product</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <h4>Are You Sure To Delete Item ?</h4>
                                                            </div>

                                                            <div class="mt-20 d-flex justify-content-between">
                                                                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                                                {{-- <form action="{{url('admin/payment-delete/'.$item->id)}}" method="get" enctype="multipart/form-data"> --}}
                                                                <a href="{{url('admin/milk-payment-delete/'.$item->id)}}"><button class="btn btn-danger" >Delete</button></a>
                                                                </form>
                                                                
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Delete Modal --}}
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                  
                   
@endsection





