@extends('admin.master')
@section('mainContent')
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Reports</a></li>
            <li>Income Summery</li>
        </ul>
    </div>
    <div class=" border-top"></div>
    
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5 ">
            <div class="card-body col-md-12">
            <form action="{{route('income_summery')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="row mb-20">
                       <div class="col-lg-5">
                            <div class="no-gutters input-right-icon">
                                <div class="col">
                                    <div class="input-effect">
                                        <label>From Date</label>
                                        <input class="primary-input date form-control{{ $errors->has('from_date') ? ' is-invalid' : '' }}" id="date_of_birth" type="text"
                                        name="from_date" autocomplete="off">
                                        <span class="focus-border"></span>
                                        @if ($errors->has('from_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('from_date') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-lg-5">
                            <div class="no-gutters input-right-icon">
                                <div class="col">
                                    <div class="input-effect">
                                        <label>To Date <span>*</span> </label>
                                        <input class="primary-input date form-control{{ $errors->has('to_date') ? ' is-invalid' : '' }}" id="datepicker" type="text"
                                        name="to_date" >
                                        <span class="focus-border"></span>
                                        
                                        @if ($errors->has('to_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('to_date') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2" style="margin-top:30px;">
                            <button type="submit" class="btn btn-primary">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                   
@endsection





