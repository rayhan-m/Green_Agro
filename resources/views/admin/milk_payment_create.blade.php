@extends('admin.master')
@section('mainContent')
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Payments</a></li>
            <li>Milk Payment</li>
        </ul>
    </div>
    <div class=" border-top"></div>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5 ">
            <div class="card-body col-md-12" style="margin-left:50px">
                <div class="mb-40">
                    {{-- {{dd(@$data)}} --}}
                    <form method="POST" action="{{url('admin/milk-payment-create')}}" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>Select Buyer</label>
                                <select class="niceSelect w-100 bb form-control{{ $errors->has('buyer_id') ? ' is-invalid' : '' }}"
                                    name="buyer_id" id="buyer_id">
                                    <option data-display="Select*" value="">Select</option>
                                        @foreach($buyers as $key=>$value)
                                            <option value="{{@$value->id}}" {{old('buyer_id')!=''? (old('buyer_id') == @$value->id? 'selected':''):''}} >{{@$value->name}}</option>
                                        @endforeach
                                </select>
                                <span class="focus-border"></span>
                                @if ($errors->has('buyer_id'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('buyer_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <div class="input-effect">
                                <label>From Date</label>
                                <input class="primary-input date form-control{{ $errors->has('from_date') ? ' is-invalid' : '' }}" id="date_of_birth" type="text"
                                name="from_date" value="{{isset($editData)? @$editData->from_date : '' }} " autocomplete="off">
                                <span class="focus-border"></span>
                                @if ($errors->has('from_date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('from_date') }}</strong>
                                </span>
                                @endif
                            </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-effect">
                                    <label>To Date</label>
                                    <input class="primary-input date form-control{{ $errors->has('to_date') ? ' is-invalid' : '' }}" id="datepicker" type="text"
                                    name="to_date" value="{{isset($editData)? @$editData->to_date : '' }} " autocomplete="off">
                                    <span class="focus-border"></span>
                                    @if ($errors->has('to_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('to_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2" style="margin-top:25px;">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body col-md-6" style="margin-left:50px">
                
                <form method="POST" action="{{route('milk_payment_submit')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="buyer_id" value="{{@$sellBuyer->milk_buyer_id}}">
                    <input type="hidden" name="from_date" value="{{@$from_date}}">
                    <input type="hidden" name="to_date" value="{{@$to_date}}">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="inputEmail3">Name</label>
                        <div class="col-sm-9">
                            <input class="primary-input form-control" name="name" type="text" value="{{@$sellBuyer->name}}" readonly >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="inputEmail3">Payable Amount</label>
                        <div class="col-sm-9">
                            <input class="primary-input form-control" name="payable_amount" type="text" value="{{@$total_payable}}" readonly >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="inputPassword3" >Paid Amount</label>
                        <div class="col-sm-9">
                            <input class="primary-input form-control{{ $errors->has('pay_amount') ? ' is-invalid' : '' }}" type="text" min="0" value="{{@$total_payable}}" name="pay_amount" placeholder="Paid amount"autocomplete="off">
                            <span class="focus-border"></span>
                            @if ($errors->has('pay_amount'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pay_amount') }}</strong>
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





