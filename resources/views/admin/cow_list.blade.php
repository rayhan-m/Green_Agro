@extends('admin.master')
@section('mainContent')

    
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Cows</a></li>
            <li>Cow List</li>
        </ul>
    </div>
    <div class=" border-top"></div>
    <div class="mt-20 mb-20">
        <a href="{{route('add_cow')}}"> <button type="button" class="btn btn-primary"> <span>+</span> Buy Cow</button></a>
        <a style="margin-left:20px;" href="{{route('sell_cow')}}"> <button type="button" class="btn btn-primary"> <span>+</span> Sell Cow</button></a>
    </div>

     <!-- Table row-->
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        
                        <div class="card text-left">
                            <div class="card-body">
                                <h4 class="text-center" style="color:green;">Active Cows</h4>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%; font-size:12px;">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Cow ID</th>
                                                <th>Name</th>
                                                <th>Bread</th>
                                                <th>Type</th>
                                                <th>Buy Price</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count=1;
                                            @endphp
                                            @foreach ($cows as $item)
                                                <tr>
                                                    <td>#{{$count++ }}</td>
                                                    <td>#{{@$item->id }}</td>
                                                    <td>{{@$item->cow_name}}</td>
                                                    <td>{{@$item->bread_name}}</td>
                                                    <td>@if (@$item->type==1) Milky Cow @else OX @endif </td>
                                                    <td>{{@$item->buy_price}}</td>
                                                    <td> <img height="80px;" width="80px;"  src="{{asset('/')}}{{@$item->image}}" class="img img-fluid">  </td>
                                                    <td> 
                                                      <a href="{{url('admin/view-active-cow/'.@$item->id)}}" ><i class="fa fa-eye" title="View" aria-hidden="true"></i>
                                                    </a>
                                                      <a href="{{url('admin/edit-cow/'.@$item->id)}}" ><i class="fa fa-pencil-square-o" title="Edit" aria-hidden="true"></i>
                                                    </a>
                                                     
                                                      <a  data-toggle="modal" data-target="#deleteModal{{@$item->id}}"  href="#" class="disabled"><i class="fa fa-trash" title="Delete" aria-hidden="true"></i></a>
                                                  </td>
                                                </tr>
                                              
                                            {{-- Delete Modal--}}
                                            <div  class="modal fade" id="deleteModal{{@$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true" >
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Cow</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <h4>Are You Sure To Delete Cow ?</h4>
                                                            </div>

                                                            <div class="mt-20 d-flex justify-content-between">
                                                                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                                                {{-- <form action="{{url('admin/payment-delete/'.@$item->id)}}" method="get" enctype="multipart/form-data"> --}}
                                                                <a href="{{url('admin/cow-delete/'.@$item->id)}}"><button class="btn btn-danger" >Delete</button></a>
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


                    <div class="col-md-12 mb-4">
                        
                        <div class="card text-left">
                            <div class="card-body">
                                <h4 class="text-center" style="color:red;">Sold Cows</h4>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%; font-size:12px;">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Cow ID</th>
                                                <th>Name</th>
                                                <th>Bread</th>
                                                <th>Buy Price</th>
                                                <th>Sell Price</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count=1;
                                            @endphp
                                            @foreach ($sold_cows as $item)
                                                <tr>
                                                    <td>#{{$count++ }}</td>
                                                    <td>#{{@$item->id }}</td>
                                                    <td>{{@$item->cow_name}}</td>
                                                    <td>{{@$item->bread_name}}</td>
                                                    <td>{{@$item->buy_price}}</td>
                                                    <td>{{@$item->sell_price}}</td>
                                                    <td> <img height="80px;" width="80px;"  src="{{asset('/')}}{{@$item->image}}" class="img img-fluid">  </td>
                                                    <td> 
                                                      <a href="{{url('admin/view-sold-cow/'.@$item->id)}}" ><i class="fa fa-eye" title="View" aria-hidden="true"></i>
                                                    </a>
                                                  </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                  
                   
@endsection





