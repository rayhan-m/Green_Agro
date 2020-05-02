@extends('admin.master')
@section('mainContent')

    
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Foods</a></li>
        <li>Feed Food</li>
        </ul>
    </div>
    <div class=" border-top"></div>
    <div class="mt-20 mb-20">
        <a href="{{route('add_feed_food')}}"> <button type="button" class="btn btn-primary"> <span>+</span> Feed Now</button></a>
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
                                                <th>Feed Food ID</th>
                                                <th>Feed Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
    
                                            @foreach ($feed_foods as $item)
                                                <tr>
                                                    <td>#{{$item->id }}</td>
                                                    
                                                    <td>{{$item->feed_date}}</td>
                                                    <td>
                                                        @if ($item->active_status == 1)
                                                            <label class="badge badge-success">Done</label>
                                                        @else
                                                            <label class="badge badge-danger">Pending</label>
                                                        @endif
                                                    {{-- <td>{{$item->active_status}}</td> --}}
                                                    <td> 
                                                        <a  data-toggle="modal" data-target="#viewModal{{$item->id}}"   href="#" ><i class="fa fa-eye" title="View" aria-hidden="true"></i>
                                                    </a>
                                                        @if ($item->active_status == 0)
                                                            <a  data-toggle="modal" data-target="#deleteModal{{$item->id}}"  href="#" class="disabled"><i class="fa fa-trash" title="Delete" aria-hidden="true"></i></a>
                                                            <a class="btn btn-primary" href="{{ url('admin/feed-food-updated/'.$item->id)}}">Update</a>
                                                        @else
                                                            <a class="btn btn-primary" href="#">Updated</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                              
                                            {{-- Delete Modal--}}
                                            <div  class="modal fade" id="deleteModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true" >
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Feed Food</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <h4>Are You Sure To Delete Feed Food ?</h4>
                                                            </div>

                                                            <div class="mt-20 d-flex justify-content-between">
                                                                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                                                {{-- <form action="{{url('admin/payment-delete/'.$item->id)}}" method="get" enctype="multipart/form-data"> --}}
                                                                <a href="{{url('admin/feed-food-delete/'.$item->id)}}"><button class="btn btn-danger" >Delete</button></a>
                                                                </form>
                                                                
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Delete Modal --}}

                                            <!--  Large Modal -->
                                                <div class="modal fade" id="viewModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Feed Food Items</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mb-20">
                                                                    <div class="col-lg-12">
                                                                        
                                                                        <label style="width:20%">SL</label>
                                                                        <label style="width:50%">Food Name</label>
                                                                        <label style="width:20%">Quantity/KG</label>
                                                                        <hr style="margin-top:0px; margin-bottom:10px;" />
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        @php
                                                                            $feed_food_items= App\FeedFoodItem::join('foods','foods.id','=','feed_food_items.food_id')->where('feed_food_items.feed_food_id','=',$item->id )->get();
                                                                            $count=1;
                                                                        @endphp
                                                                        @foreach ($feed_food_items as $feed_food_item)
                                                                            <label style="width:20%">{{ $count++ }}</label>
                                                                            <label style="width:50%">{{$feed_food_item->name }}</label>
                                                                            <label style="width:20%">{{$feed_food_item->quantity }} KG</label>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal Ends -->
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                  
                   
@endsection





