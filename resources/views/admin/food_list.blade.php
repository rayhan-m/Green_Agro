@extends('admin.master')
@section('mainContent')

    
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Foods</a></li>
            <li>Food List</li>
        </ul>
    </div>
    <div class=" border-top"></div>
    <div class="mt-20 mb-20">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> <span>+</span> Food</button>
    </div>

     <!-- Table row-->
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%; font-size:12px;">
                                        <thead>
                                            <tr style="text-align:center;">
                                                <th>SL</th>
                                                <th>Food ID</th>
                                                <th>Food Name</th>
                                                <th>Category</th>
                                                <th>Details</th>
                                                <th>Status</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count=1;
                                            @endphp
                                            @foreach ($data as $item)
                                                <tr style="text-align:center;">
                                                    <td>{{ $count++ }}</td>
                                                    <td>{{@$item->id}}</td>
                                                    <td>{{@$item->name}}</td>
                                                    <td>{{@$item->category_name}}</td>
                                                    <td>{{@$item->details}}</td>
                                                    <td>@if (@$item->active_status==1)
                                                        <a href="{{ url('admin/food-deactive/'.@$item->id)}}"> <label class="badge badge-info">Active</label></a>
                                                        @else
                                                          <a href="{{ url('admin/food-active/'.@$item->id)}}"> <label class="badge badge-danger">Deactive</label></a>
                                                        @endif
                                                    </td>
                                                    <td> <img height="250px;" width="150px;"  src="{{asset('/')}}{{@$item->image}}" class="img img-fluid">  </td>
                                                    <td> 
                                                      <a data-toggle="modal" data-target="#editModal{{@$item->id}}"   href="#" ><i class="fa fa-pencil-square-o" title="Edit" aria-hidden="true"></i>
                                                    </a>
                                                      {{-- <button type="button" style="float:right;" class="btn btn-info" data-toggle="modal" data-target="#editModal">+ Add</button> --}}
                                                      <a data-toggle="modal" data-target="#deleteCategoryModal"  href="#"><i class="fa fa-trash" title="Delete" aria-hidden="true"></i></a>
                                                  </td>
                                                </tr>
                                                <!-- Edit Modal starts -->       
                                                <div class="modal fade" id="editModal{{@$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel-2">Edit Food</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <form method="POST" action="{{url('admin/food-update')}}" enctype="multipart/form-data">
                                                      @csrf 
                                                      <input type="hidden" name="id" value="{{ @$item->id}}">
                                                      <div class="modal-body">
                                                        <div class="row">
                                                          <div class="col-lg-10 ml-40">
                                                               <div class="input-effect">
                                                                <label>Food Name</label>
                                                                <input class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name"  value="{{ @$item->name}}" placeholder="Food Name"autocomplete="off">
                                                                <span class="focus-border"></span> @if ($errors->has('name'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span> @endif
                                                            </div>

                                                            <div class="input-effect mt-20">
                                                                <label>Select Category</label>
                                                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                                                                        name="category_id" id="category_id">
                                                                        <option data-display="Select Category *"
                                                                                value="">Select</option>
                                                                        @foreach($categories as $key=>$value)
                                                                            <option value="{{$value->id}}" {{$value->id == @$item->category_id? 'selected':''}}>{{$value->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="focus-border"></span>
                                                                    @if ($errors->has('category_id'))
                                                                        <span class="invalid-feedback invalid-select" role="alert">
                                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                                </span>
                                                                    @endif
                                                                </div>

                                                            <div class="form-group mt-20">
                                                                <img style="height: 50px;" src="{{asset('/')}}{{@$item->image}}" class="img-lg rounded mb-10" alt="product image" />
                                                                    <input type="file" name="image" class="file-upload-default">
                                                                    <div class="input-group col-xs-12">
                                                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Food Image">
                                                                        <span class="input-group-append">
                                                                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <label>Food Details:</label>
                                                                <div class="input-effect">
                                                                    <textarea name="details"  rows="6" cols="50" class="{{ $errors->has('details') ? ' is-invalid' : '' }}">{{ @$item->details}}</textarea>
                                                                    @if ($errors->has('details'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('details') }}</strong>
                                                                    </span>
                                                                    @endif
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
         
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-2">Food Information</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="{{route('food_submit')}}" enctype="multipart/form-data">
                          @csrf 
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-lg-10 ml-40" >
                                  <div class="input-effect">
                                    <label>Food Name</label>
                                      <input class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" placeholder="Food Name"autocomplete="off">
                                      <span class="focus-border"></span> @if ($errors->has('name'))
                                      <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> @endif
                                  </div>

                                  <div class="input-effect mt-20">
                                      <label>Select Category</label>
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                                            name="category_id" id="category_id">
                                            <option data-display="Select Category *"
                                                    value="">Select</option>
                                            @foreach($categories as $key=>$value)

                                                    <option value="{{$value->id}}" {{old('category_id')!=''? (old('category_id') == $value->id? 'selected':''):''}} >{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('category_id'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                  <div class="form-group mt-20">
                                        <input type="file" name="image" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Food Image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                            </span>
                                        </div>
                                    </div>
                                    <label>Food Details:</label>
                                    <div class="input-effect">
                                         
                                        <textarea name="details" rows="6"  cols="50" class="{{ $errors->has('details') ? ' is-invalid' : '' }}"></textarea>
                                        @if ($errors->has('details'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('details') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class=" btn btn-primary">Submit</button>
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
                                <h4 class="modal-title">Delete Food</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="text-center">
                                    <h4>Are You Sure To Delete Item ?</h4>
                                </div>

                                <div class="mt-20 d-flex justify-content-between">
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                    <form action="{{url('admin/food-delete/'.@$item->id)}}" method="DELETE" enctype="multipart/form-data"
                                      >
                                      <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{--End Delete Modal--}}
                   
@endsection