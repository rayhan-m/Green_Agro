@extends('admin.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
@section('mainContent')

    
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Expenses</a></li>
            <li>Expense List</li>
        </ul>
    </div>
    <div class=" border-top"></div>
    <div class="mt-20 mb-20">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> <span>+</span> Expenses</button>
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
                                                <th style="width:15%">Expense Type</th>
                                                <th style="width:15%">Expense Date</th>
                                                <th style="width:10%">Amount</th>
                                                <th style="width:10%">Voucher</th>
                                                <th style="width:20%">Details</th>
                                                <th style="width:10%">Status</th>
                                                <th style="width:10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count=1;
                                            @endphp
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ @$count++ }}</td>
                                                    <td>{{@$item->name}}</td>
                                                    <td>{{@$item->expense_date}}</td>
                                                    <td>{{@$item->amount}}</td>
                                                    <td> 
                                                        <a class="btn btn-primary" href="{{asset('/')}}{{$item->voucher}}" target="_blank">View</a>
                                                    </td>
                                                    <td>{{@$item->details}}</td>
                                                    <td>@if (@$item->active_status==1)
                                                        <a href="{{ url('admin/expenses-deactive/'.@$item->id)}}"> <label class="badge badge-info">Paid</label></a>
                                                        @else
                                                          <a href="{{ url('admin/expenses-active/'.@$item->id)}}"> <label class="badge badge-danger">Due</label></a>
                                                        @endif</td>
                                                    {{-- <td>{{$item->active_status}}</td> --}}
                                                    <td> 
                                                      <a data-toggle="modal" data-target="#editModal{{@$item->id}}"  href="#" >
                                                        <ion-icon name="create-outline"></ion-icon>
                                                    </a>
                                                      {{-- <button type="button" style="float:right;" class="btn btn-info" data-toggle="modal" data-target="#editModal">+ Add</button> --}}
                                                      <a data-toggle="modal" data-target="#deleteModal{{@$item->id}}"  href="#"><i class="fa fa-trash" title="Delete" aria-hidden="true"></i></a>
                                                  </td>
                                                </tr>
                                                <!-- Edit Modal starts -->       
                                                <div class="modal fade" id="editModal{{@$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel-2">Edit Expense</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <form method="POST" action="{{url('admin/expenses-update')}}" enctype="multipart/form-data">
                                                        <input type="hidden" name="id" value="{{$item->id}}">
                                                        @csrf 
                                                        <div class="modal-body">
                                                            <div class="row mb-20">
                                                            <div class="col-lg-10 col-lg-offset-1" style="margin-left: 40px;">
                                                                {{-- jhg --}}
                                                                <div class="input-effect mt-20">
                                                                    <label>Select Expense Type</label>
                                                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('type_id') ? ' is-invalid' : '' }}"
                                                                            name="type_id" id="type_id">
                                                                            <option data-display="Select Category *" value="">Select</option>
                                                                            @foreach($expense_type as $key=>$value)
                                                                                <option value="{{$value->id}}" {{$value->id == $item->type_id? 'selected':''}} >{{$value->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <span class="focus-border"></span>
                                                                        @if ($errors->has('type_id'))
                                                                            <span class="invalid-feedback invalid-select" role="alert">
                                                                                <strong>{{ $errors->first('type_id') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <input type="hidden" name="expense_date" id="input_expense_date{{$item->id}}" value="ttttt"> 
                                                                    <div class="input-effect mt-20">
                                                                        <label>Expense Date</label>
                                                                        
                                                                        <input   class="primary-input date form-control{{ $errors->has('expense_date') ? ' is-invalid' : '' }}" id="datepicker{{$item->id}}" type="text"
                                                                        value="{{$item->expense_date}}" onclick="expanceDate({{@$item->id}})" onchange="setDate({{@$item->id}})" autocomplete="off">
                                                                        <span class="focus-border"></span>
                                                                        @if ($errors->has('expense_date'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('expense_date') }}</strong>
                                                                        </span>
                                                                        @endif
                                                                    </div>

                                                                    <div class="input-effect mt-20 mb-20">
                                                                        <label>Amount</label>
                                                                        <input class="primary-input form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" type="text" onkeyup="isNumberKeyDecimal(this);" value="{{$item->amount}}"   name="amount" >
                                                                        <span class="focus-border"></span>
                                                                        @if ($errors->has('amount'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('amount') }}</strong>
                                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                    <label>Voucher:</label>
                                                                    <div class="form-group">
                                                                        <a class="btn btn-primary" href="{{asset('/')}}{{$item->voucher}}" target="_blank">View</a>
                                                                        <input type="file" name="voucher" class="file-upload-default">
                                                                        <div class="input-group col-xs-12">
                                                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Voucher">
                                                                            <span class="input-group-append">
                                                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                                            </span>
                                                                        </div>
                                                                        @if ($errors->has('voucher'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('voucher') }}</strong>
                                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                    <label>Details:</label>
                                                                    <div class="input-effect">
                                                                        
                                                                        <textarea name="details" rows="4"  cols="52" class="{{ $errors->has('details') ? ' is-invalid' : '' }}">{{$item->details}}</textarea>
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
                                                {{-- Delete Modal--}}
                                            <div id="deleteModal{{@$item->id}}"  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true" >
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Expense</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <h4>Are You Sure To Delete Item ?</h4>
                                                            </div>

                                                            <div class="mt-20 d-flex justify-content-between">
                                                                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>

                                                                <a href="{{url('admin/expenses-delete/'.@$item->id)}}"><button class="btn btn-danger" type="submit">Delete</button></a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <script>

                                               
                                            </script>
                                            {{-- Delete Modal--}}
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
                          <h5 class="modal-title" id="exampleModalLabel-2">Expense Info</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="{{route('expenses_submit')}}" enctype="multipart/form-data">
                          @csrf 
                          <div class="modal-body">
                            <div class="row mb-20">
                              <div class="col-lg-10 col-lg-offset-1" style="margin-left: 40px;">
                                {{-- jhg --}}
                                <div class="input-effect mt-20">
                                      <label>Select Expense Type</label>
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('type_id') ? ' is-invalid' : '' }}"
                                            name="type_id" id="type_id">
                                            <option data-display="Select Category *" value="">Select</option>
                                            @foreach($expense_type as $key=>$value)
                                                <option value="{{$value->id}}" {{old('type_id')!=''? (old('type_id') == $value->id? 'selected':''):''}} >{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('type_id'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('type_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{-- ggh --}}
                                    <div class="input-effect mt-20">
                                        <label>Expense Date</label>
                                        <input class="primary-input date form-control{{ $errors->has('expense_date') ? ' is-invalid' : '' }}" id="expense_date" type="text"
                                        name="expense_date" autocomplete="off">
                                        <span class="focus-border"></span>
                                        @if ($errors->has('expense_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('expense_date') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                  <div class="input-effect mt-20 mb-20">
                                        <label>Amount</label>
                                        <input class="primary-input form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" type="text" onkeyup="isNumberKeyDecimal(this);"  name="amount" >
                                        <span class="focus-border"></span>
                                        @if ($errors->has('amount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <label>Voucher:</label>
                                    <div class="form-group">
                                        <input type="file" name="voucher" class="file-upload-default {{ $errors->has('voucher') ? ' is-invalid' : '' }}">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Voucher">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                            </span>
                                        </div>
                                        @if ($errors->has('voucher'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('voucher') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <label>Details:</label>
                                    <div class="input-effect">
                                         
                                        <textarea name="details" rows="4"  cols="52" class="{{ $errors->has('details') ? ' is-invalid' : '' }}"></textarea>
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
                  <!-- Modal Ends -->
                  
@endsection