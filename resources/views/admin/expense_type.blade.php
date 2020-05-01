@extends('admin.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section('mainContent')

    
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Expenses</a></li>
            <li>Expense Type</li>
        </ul>
    </div>
    <div class=" border-top"></div>
    <div class="mt-20 mb-20">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> <span>+</span> Expense Type</button>
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
                                                <th style="width:10%">SL</th>
                                                <th style="width:50%">Expense Type Name</th>
                                                <th style="width:20%">Active Status</th>
                                                <th style="width:20%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count=1;
                                            @endphp
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $count++ }}</td>
                                                    <td>{{@$item->name}}</td>
                                                    <td>@if (@$item->active_status==1)
                                                        <a href="{{ url('admin/expense-type-deactive/'.@$item->id)}}"> <label class="badge badge-info">Active</label></a>
                                                        @else
                                                          <a href="{{ url('admin/expense-type-active/'.@$item->id)}}"> <label class="badge badge-danger">Deactive</label></a>
                                                        @endif</td>
                                                    {{-- <td>{{@$item->active_status}}</td> --}}
                                                    <td> 
                                                      <a data-toggle="modal" data-target="#editModal{{@$item->id}}"  href="#" >
                                                        <button class="btn btn-outline-primary" style="float:right;" data-toggle="modal" data-target="#editModal">Edit</button>
                                                    </a>
                                                      {{-- <button type="button" style="float:right;" class="btn btn-info" data-toggle="modal" data-target="#editModal">+ Add</button> --}}
                                                      <a data-toggle="modal" data-target="#deleteCategoryModal"  href="#"><button class="btn btn-outline-primary" >Delete</button></a>
                                                  </td>
                                                </tr>
                                                <!-- Edit Modal starts -->       
                                                <div class="modal fade" id="editModal{{@$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel-2">Edit Expense Type</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <form method="POST" action="{{url('admin/expense-type-update')}}" enctype="multipart/form-data">
                                                      @csrf 
                                                      <input type="hidden" name="id" value="{{ @$item->id}}">
                                                      <div class="modal-body">
                                                        <div class="row mb-20">
                                                          <div class="col-lg-10 col-lg-offset-1">
                                                              <div class="input-effect">
                                                                <label>Expense Type Name</label>
                                                                  
                                                                  <input class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" placeholder="expense Type Name" value="{{ @$item->name}}" autocomplete="off">
                                                                  <span class="focus-border"></span> @if ($errors->has('name'))
                                                                  <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                 </span> @endif
                                                              </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="submit" class="btn btn-info">Submit</button>
                                                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                                      </div>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                              <!-- Edit Modal Ends -->

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal starts -->
         
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-2">Expense Type</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="{{route('expense_type_submit')}}" enctype="multipart/form-data">
                          @csrf 
                          <div class="modal-body">
                            <div class="row mb-20">
                              <div class="col-lg-10 col-lg-offset-1">
                                  <div class="input-effect">
                                    <label>Expense Type Name</label>
                                      <input class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" placeholder="Expense Type Name"autocomplete="off">
                                      <span class="focus-border"></span> @if ($errors->has('name'))
                                      <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> @endif
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Ends -->
                  {{-- Delete Modal--}}
                  <div id="deleteCategoryModal"  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Expense Type</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="text-center">
                                    <h4>Are You Sure To Delete Item ?</h4>
                                </div>

                                <div class="mt-20 d-flex justify-content-between">
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                    {{-- {{ Form::open(['url' => 'product-category/delete/'.@$item->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }} --}}
                                    <form action="{{url('admin/expense-type-delete/'.@$item->id)}}" method="DELETE" enctype="multipart/form-data"
                                      >
                                      <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                    
                                    {{-- {{ Form::close() }} --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
@endsection