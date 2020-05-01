@extends('admin.master')
@section('mainContent')
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Payments</a></li>
            <li>Staff Payment</li>
        </ul>
    </div>
    <div class=" border-top"></div>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5 ">
            <div class="card-body col-md-6" style="margin-left:50px">
                <div class="mb-40">
                    {{-- {{dd(@$data)}} --}}
                    <form method="POST" action="{{url('admin/staff-payment-create')}}" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="inputEmail3">Select Staff</label>
                            <div class="col-md-7">
                                <select class="niceSelect w-100 bb form-control{{ $errors->has('staff_id') ? ' is-invalid' : '' }}"
                                    name="staff_id" id="staff_id">
                                    <option data-display="Select Category *"
                                            value="">Select ID</option>
                        
                                    @foreach($staff as $key=>$value)
                                        
                                        <option value="{{@$value->id}}" {{old('staff_id')!=''? (old('staff_id') == @$value->id? 'selected':''):''}} >{{@$value->id}}</option>
                                        
                                        @endforeach
                                </select>
                                <span class="focus-border"></span>
                                @if ($errors->has('staff_id'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('staff_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <form method="POST" action="{{route('staff_payment_submit')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="staff_id" value="{{@$staffInfo->id}}">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="inputEmail3">Name</label>
                        <div class="col-sm-9">
                            <input class="primary-input form-control" name="name" type="text" value="{{@$staffInfo->full_name}}" readonly >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="inputEmail3">Basic Salary</label>
                        <div class="col-sm-9">
                            <input class="primary-input form-control" name="basic_salary" type="text" value="{{@$staffInfo->basic_salary}}" readonly >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="inputPassword3" >Paid Amount</label>
                        <div class="col-sm-9">
                            <input class="primary-input form-control{{ $errors->has('pay_amount') ? ' is-invalid' : '' }}" type="text" min="0" value="{{@$staffInfo->basic_salary}}" name="pay_amount" placeholder="Paid amount"autocomplete="off">
                            <span class="focus-border"></span>
                            @if ($errors->has('pay_amount'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pay_amount') }}</strong>
                                </span> 
                            @endif
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="inputPassword3">Payment Month</label>
                        <div class="col-sm-9">
                            <select class="niceSelect w-100 bb form-control{{ $errors->has('payment_month') ? ' is-invalid' : '' }}"
                                name="payment_month" id="payment_month">
                                <option data-display="Select Payment Month *"value="">Select</option>
                                <option value="1" {{old('payment_month')!=''? (old('payment_month') == 1? 'selected':''):''}} >January</option>
                                <option value="2" {{old('payment_month')!=''? (old('payment_month') == 2? 'selected':''):''}} >February</option>
                                <option value="3" {{old('payment_month')!=''? (old('payment_month') == 3? 'selected':''):''}} >March</option>
                                <option value="4" {{old('payment_month')!=''? (old('payment_month') == 4? 'selected':''):''}} >April</option>
                                <option value="5" {{old('payment_month')!=''? (old('payment_month') == 5? 'selected':''):''}} >May</option>
                                <option value="6" {{old('payment_month')!=''? (old('payment_month') == 6? 'selected':''):''}} >June</option>
                                <option value="7" {{old('payment_month')!=''? (old('payment_month') == 7? 'selected':''):''}} >July</option>
                                <option value="8" {{old('payment_month')!=''? (old('payment_month') == 8? 'selected':''):''}} >August</option>
                                <option value="9" {{old('payment_month')!=''? (old('payment_month') == 9? 'selected':''):''}} >Septerber</option>
                                <option value="10" {{old('payment_month')!=''? (old('payment_month') == 10? 'selected':''):''}} >October</option>
                                <option value="11" {{old('payment_month')!=''? (old('payment_month') == 11? 'selected':''):''}} >November</option>
                                <option value="12" {{old('payment_month')!=''? (old('payment_month') == 12? 'selected':''):''}} >December</option>
                            </select>
                            <span class="focus-border"></span>
                            @if ($errors->has('payment_month'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('payment_month') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="inputPassword3">Payment Status</label>
                        <div class="col-sm-9">
                            <select class="niceSelect w-100 bb form-control{{ $errors->has('payment_status') ? ' is-invalid' : '' }}"
                                name="payment_status" id="payment_status">
                                <option data-display="Select Payment Status *"value="">Select</option>
                                <option value="1" {{old('payment_status')!=''? (old('payment_status') == 1? 'selected':''):''}} >Paid</option>
                                <option value="0" {{old('payment_status')!=''? (old('payment_status') == 0? 'selected':''):''}} >Due</option>
                            </select>
                            <span class="focus-border"></span>
                            @if ($errors->has('payment_status'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('payment_status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-9">
                            <button class="btn btn-primary" type="submit">Add Payment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                   
@endsection





