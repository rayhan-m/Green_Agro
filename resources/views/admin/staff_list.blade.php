@extends('admin.master')
@section('mainContent')

    
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Human Resources</a></li>
            <li>Staff List</li>
        </ul>
    </div>
    <div class=" border-top"></div>
    <div class="mt-20 mb-20">
        <a href="{{route('add_staff')}}"> <button type="button" class="btn btn-primary"> <span>+</span> Staff</button></a>
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
                                                <th style="width:10%">Staff ID</th>
                                                <th style="width:15%">Image</th>
                                                <th style="width:15%">Name</th>
                                                <th style="width:15%">Fathers Name</th>
                                                <th style="width:15%">joining Date</th>
                                                <th style="width:15%">Mobile</th>
                                                <th style="width:15%">basic_salary</th>
                                                <th style="width:15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
    
                                            @foreach ($staffs as $item)
                                                <tr>
                                                    <td>#{{$item->id }}</td>
                                                     <td> <img height="80px;" width="80px;"  src="{{asset('/')}}{{$item->staff_photo}}" class="img img-fluid">  </td>
                                                    <td>{{$item->full_name}}</td>
                                                    <td>{{$item->fathers_name}}</td>
                                                    <td>{{$item->date_of_joining}}</td>
                                                    <td>{{$item->mobile}}</td>
                                                    <td>{{$item->basic_salary}}</td>
                                                    
                                                    {{-- <td>{{$item->active_status}}</td> --}}
                                                    <td> 
                                                      <a href="{{url('admin/view-staff/'.$item->id)}}" ><i class="fa fa-eye" title="View" aria-hidden="true"></i>
                                                    </a>
                                                      <a href="{{url('admin/edit-staff/'.$item->id)}}" ><i class="fa fa-pencil-square-o" title="Edit" aria-hidden="true"></i>
                                                    </a>
                                                     
                                                      <a  data-toggle="modal" data-target="#deleteModal{{$item->id}}"  href="#" class="disabled"><i class="fa fa-trash" title="Delete" aria-hidden="true"></i></a>
                                                  </td>
                                                </tr>
                                              
                                            {{-- Delete Modal--}}
                                            <div  class="modal fade" id="deleteModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true" >
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Staff</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <h4>Are You Sure To Delete Staff ?</h4>
                                                            </div>

                                                            <div class="mt-20 d-flex justify-content-between">
                                                                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                                                {{-- <form action="{{url('admin/payment-delete/'.$item->id)}}" method="get" enctype="multipart/form-data"> --}}
                                                                <a href="{{url('admin/staff-delete/'.$item->id)}}"><button class="btn btn-danger" >Delete</button></a>
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





