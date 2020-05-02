@extends('admin.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .icon-inner title{
display : none ;
}
</style>
@section('mainContent')

    
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Cows</a></li>
            <li>Seller List</li>
        </ul>
    </div>
    <div class=" border-top"></div>
    <div class="mt-20 mb-20">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> <span>+</span> Seller</button>
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
                                                <th>SL</th>
                                                <th>Seller ID</th>
                                                <th>Seller Name</th>
                                                <th>Phone</th>
                                                <th>email</th>
                                                <th>address</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count=1;
                                            @endphp
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $count++ }}</td>
                                                    <td>#{{$item->id}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->phone}}</td>
                                                    <td>{{$item->email}}</td>
                                                    <td>{{$item->address}}</td>
                                                    <td style="text-align:center;"> <img height="80px;" width="80px;"  src="{{asset('/')}}{{$item->image}}" class="img img-fluid">  </td>
                                                    <td> 
                                                      <a data-toggle="modal" data-target="#editModal{{$item->id}}" href="#" ><i class="fa fa-pencil-square-o" title="Edit" aria-hidden="true"></i>
                                                         </a>
                                                      <a data-toggle="modal" data-target="#deleteModal{{$item->id}}"  href="#"><i class="fa fa-trash" title="Delete" aria-hidden="true"></i></a>
                                                    </td>
                                                  </tr>
                                                   <!--Edit Modal starts -->
         
                                                  <div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel-2">Edit Seller Info</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>
                                                        <form method="POST" action="{{route('seller_update')}}" enctype="multipart/form-data">
                                                          @csrf 
                                                          <input type="hidden" name="id" value="{{@$item->id}}">
                                                          <div class="modal-body">
                                                            <div class="row mb-20">
                                                              <div class="col-lg-10 col-lg-offset-1" style="margin-left: 40px;">
                                                                
                                                                    <div class="input-effect mt-20">
                                                                        <label>Seller Name *</label>
                                                                        <input class="primary-input date form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"  type="text"
                                                                        name="name" value="{{@$item->name}}" autocomplete="off">
                                                                        <span class="focus-border"></span>
                                                                        @if ($errors->has('name'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('name') }}</strong>
                                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="input-effect mt-20">
                                                                        <label>Phone *</label>
                                                                        <input class="primary-input date form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"  type="text"
                                                                        name="phone" onkeypress="return isNumberKey(event)"  value="{{@$item->phone}}" autocomplete="off">
                                                                        <span class="focus-border"></span>
                                                                        @if ($errors->has('phone'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="input-effect mt-20 mb-20">
                                                                        <label>Email</label>
                                                                        <input class="primary-input date form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  type="email"
                                                                        name="email"  value="{{@$item->email}}" autocomplete="off">
                                                                        <span class="focus-border"></span>
                                                                        @if ($errors->has('email'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('email') }}</strong>
                                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                    
                                                                    <label>Address</label>
                                                                    <div class="input-effect">
                                                                        
                                                                        <textarea name="address" rows="4"  cols="52" class="{{ $errors->has('address') ? ' is-invalid' : '' }}"> {{@$item->address}}</textarea>
                                                                        @if ($errors->has('address'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('address') }}</strong>
                                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                  
                                                                    <label class="mt-20">Image:</label>
                                                                    <div class="form-group">
                                                                      <img class="mb-20" height="80px;" width="80px;"  src="{{asset('/')}}{{$item->image}}" class="img img-fluid">
                                                                        <input type="file" name="image" class="file-upload-default {{ $errors->has('image') ? ' is-invalid' : '' }}">
                                                                        <div class="input-group col-xs-12">
                                                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload image">
                                                                            <span class="input-group-append">
                                                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                                            </span>
                                                                        </div>
                                                                        @if ($errors->has('image'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('image') }}</strong>
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
                                                  <!--Edit Modal Ends -->
                                                  {{-- Delete Modal--}}
                                                  <div  class="modal fade" id="deleteModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true" >
                                                      <div class="modal-dialog">
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <h4 class="modal-title">Delete Seller</h4>
                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                              </div>

                                                              <div class="modal-body">
                                                                  <div class="text-center">
                                                                      <h4>Are You Sure To Delete Seller ?</h4>
                                                                  </div>
                                                                  <div class="mt-20 d-flex justify-content-between">
                                                                      <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                                                      <a href="{{url('admin/seller-delete/'.$item->id)}}"><button class="btn btn-danger" >Delete</button></a>
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
                     <!-- Modal starts -->
         
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-2">Seller Info</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="{{route('seller_submit')}}" enctype="multipart/form-data">
                          @csrf 
                          <div class="modal-body">
                            <div class="row mb-20">
                              <div class="col-lg-10 col-lg-offset-1" style="margin-left: 40px;">
                                
                                    <div class="input-effect mt-20">
                                        <label>Seller Name *</label>
                                        <input class="primary-input date form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"  type="text"
                                        name="name" autocomplete="off">
                                        <span class="focus-border"></span>
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="input-effect mt-20">
                                        <label>Phone *</label>
                                        <input class="primary-input date form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" onkeypress="return isNumberKey(event)"  type="text"
                                        name="phone" autocomplete="off">
                                        <span class="focus-border"></span>
                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="input-effect mt-20 mb-20">
                                        <label>Email</label>
                                        <input class="primary-input date form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  type="email"
                                        name="email" autocomplete="off">
                                        <span class="focus-border"></span>
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    
                                    <label>Address</label>
                                    <div class="input-effect">
                                         
                                        <textarea name="address" rows="4"  cols="52" class="{{ $errors->has('address') ? ' is-invalid' : '' }}"></textarea>
                                        @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                  
                                    <label class="mt-20">Image:</label>
                                    <div class="form-group">
                                        <input type="file" name="image" class="file-upload-default {{ $errors->has('image') ? ' is-invalid' : '' }}">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                            </span>
                                        </div>
                                        @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
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
                  <!-- Modal Ends -->
                  
@endsection