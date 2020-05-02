@extends('admin.master')
@section('mainContent')
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Human Resources</a></li>
            <li>Staff Create</li>
        </ul>
    </div>
    <div class=" border-top"></div>
    <div class="mt-20 mb-20">
        <a href="{{route('staff_list')}}"> <button type="button" class="btn btn-primary"> Staff List</button></a>
    </div>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5 ">
            <div class="card-body col-md-12">
                <div class="mb-40">
                    {{-- {{dd(@$data)}} --}}
                    @if (@$editData)
                        <form method="POST" action="{{route('staff_update')}}" enctype="multipart/form-data" >
                    @else
                        <form method="POST" action="{{route('staff_create')}}" enctype="multipart/form-data" >
                    @endif
                        @csrf
                         <div class="row">
                                <div class="col-lg-12">

                                <div class="white-box">
                                    <div class="">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="main-title">
                                                    <h4>Basic Info</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <hr>
                                            </div>
                                        </div>

                                        <input type="hidden" name="id"  value="{{@$editData->id}}">

                                        <div class="row mb-30">
                                            <div class="col-lg-3">
                                                <div class="input-effect">
                                                    <label>First Name <span>*</span> </label>
                                                    <input class="primary-input form-control {{$errors->has('first_name') ? 'is-invalid' : ' '}}" type="text"  name="first_name" value="{{isset($editData)? @$editData->first_name : '' }}">
                                                    <span class="focus-border"></span>
                                                    
                                                    @if ($errors->has('first_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('first_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="input-effect">
                                                    <label>Last Name <span>*</span> </label>
                                                    <input class="primary-input form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" type="text"  name="last_name" value="{{isset($editData)? @$editData->last_name : '' }}">
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('last_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('last_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="input-effect">
                                                    <label>Father's Name</label>
                                                    <input class="primary-input form-control{{ $errors->has('fathers_name') ? ' is-invalid' : '' }}" type="text"  name="fathers_name" value="{{isset($editData)? @$editData->fathers_name : '' }}">
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('fathers_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('fathers_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="input-effect">
                                                    <label>Mother's Name</label>
                                                    <input class="primary-input form-control{{ $errors->has('mothers_name') ? ' is-invalid' : '' }}" type="text" name="mothers_name" value="{{isset($editData)? @$editData->mothers_name : '' }}">
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('mothers_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('mothers_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-20">
                                        <div class="col-lg-3">
                                            <div class="input-effect">
                                                <label>Email <span>*</span> </label>
                                                <input class="primary-input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email"  name="email" value="{{isset($editData)? @$editData->email : '' }}">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- {{ dd($genders)}} --}}
                                        <div class="col-lg-3">
                                            <div class="input-effect">
                                                <label>Gender <span>*</span> </label>
                                                <select class="niceSelect w-100 bb form-control{{ $errors->has('gender_id') ? ' is-invalid' : '' }}" name="gender_id">
                                                    <option data-display="Gender *" value="">Select Gender</option>
                                                    <option value="1" {{old('gender_id')!=''? (old('gender_id') == 1? 'selected':''):''}}{{@$editData->gender_id == "1"? 'selected':''}} >Male</option>
                                                    <option value="0" {{old('gender_id')!=''? (old('gender_id') == 0? 'selected':''):''}}{{@$editData->gender_id == "0"? 'selected':''}} >Female</option>
                                                </select>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('gender_id'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong>{{ $errors->first('gender_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="input-effect">
                                                        <label>Date of Birth</label>
                                                        <input class="primary-input date form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" id="date_of_birth" type="text"
                                                        name="date_of_birth" value="{{isset($editData)? @$editData->date_of_birth : '' }} " autocomplete="off">
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('date_of_birth'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('date_of_birth') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-lg-3">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="input-effect">
                                                        <label>Date of Joining <span>*</span> </label>
                                                        <input class="primary-input date form-control{{ $errors->has('date_of_joining') ? ' is-invalid' : '' }}" id="datepicker" type="text"
                                                        name="date_of_joining" value="{{isset($editData)? @$editData->date_of_joining : '' }}" >
                                                        <span class="focus-border"></span>
                                                        
                                                        @if ($errors->has('date_of_joining'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('date_of_joining') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                    <div class="col-lg-3">
                                        <div class="input-effect">
                                            <label>Mobile <span>*</span> </label>
                                            <input class="primary-input form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" onkeypress="return isNumberKey(event)" type="text"  name="mobile" value="{{isset($editData)? @$editData->mobile : '' }}">
                                            <span class="focus-border"></span>
                                            @if ($errors->has('mobile'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('mobile') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-effect">
                                            <label>Marital Status <span>*</span> </label>
                                            <select class="niceSelect w-100 bb form-control" name="marital_status">
                                                <option data-display="Marital Status" value="">Marital Status</option>

                                                <option {{@$editData->marital_status == "married"? 'selected':''}} value="married">Married</option>
                                                <option {{@$editData->marital_status == "unmarried"? 'selected':''}} value="unmarried">Unmarried</option>

                                            </select>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-effect">
                                            <label>Emergency Mobile </label>
                                            <input class="primary-input form-control{{ $errors->has('emergency_mobile') ? ' is-invalid' : '' }}" type="text" onkeypress="return isNumberKey(event)"  name="emergency_mobile" value="{{isset($editData)? @$editData->emergency_mobile : '' }}">
                                            <span class="focus-border"></span>
                                            @if ($errors->has('emergency_mobile'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('emergency_mobile') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-effect">
                                            <label>Basic Salary </label>
                                            <input class="primary-input form-control{{ $errors->has('basic_salary') ? ' is-invalid' : '' }}" type="text" onkeyup="isNumberKeyDecimal(this);"  name="basic_salary" value="{{isset($editData)? @$editData->basic_salary : '' }}">
                                            <span class="focus-border"></span>
                                            @if ($errors->has('basic_salary'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('basic_salary') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="row mt-20">
                                    <div class="col-lg-3">
                                        <div class="input-effect">
                                            <label>NID No </label>
                                            <input class="primary-input form-control{{ $errors->has('nid') ? ' is-invalid' : '' }}" type="text" onkeypress="return isNumberKey(event)"  name="nid" value="{{isset($editData)? @$editData->nid : '' }}">
                                            <span class="focus-border"></span>
                                            @if ($errors->has('nid'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nid') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        @if (isset($editData))
                                            <img height="80px;" width="80px;"  src="{{asset('/')}}{{@$editData->staff_photo}}" class="img img-fluid">
                                        @endif
                                    
                                        <div class="form-group">
                                            <label> Staff Image </label>
                                            <input type="file" name="staff_photo" class="file-upload-default">
                                            <div class="input-group">
                                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Staff Image">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-20">
                                    <div class="col-lg-6">
                                        <div class="input-effect">
                                            <label>Current Address <span>*</span> </label>
                                            <textarea class="primary-input form-control {{ $errors->has('current_address') ? 'is-invalid' : ''}}" cols="0" rows="4" name="current_address" id="current_address">{{isset($editData)? @$editData->current_address : '' }}</textarea>
                                            <span class="focus-border textarea"></span>
                                            @if ($errors->has('current_address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('current_address') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-effect">
                                            <label>Permanent Address <span></span> </label>
                                            <textarea class="primary-input form-control {{ $errors->has('permanent_address') ? 'is-invalid' : ''}}" cols="0" rows="4"  name="permanent_address" id="permanent_address">{{isset($editData)? @$editData->permanent_address : '' }}</textarea>
                                            <span class="focus-border textarea"></span>
                                            @if ($errors->has('permanent_address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('permanent_address') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-lg-6">
                                        <div class="input-effect">
                                            <label>Qualifications </label>
                                            <textarea class="primary-input form-control" cols="0" rows="4" name="qualification" id="qualification"> {{isset($editData)? @$editData->qualification : '' }}</textarea>
                                            <span class="focus-border textarea"></span>
                                            @if ($errors->has('qualification'))
                                            <span class="danger text-danger">
                                                <strong>{{ $errors->first('qualification') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-effect">
                                            <label>Experience </label>
                                            <textarea class="primary-input form-control" cols="0" rows="4"  name="experience" id="experience">{{isset($editData)? @$editData->experience : '' }}</textarea>
                                            <span class="focus-border textarea"></span>
                                            @if ($errors->has('experience'))
                                            <span class="danger text-danger">
                                                <strong>{{ $errors->first('experience') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>

                    <div class="row mt-40">
                        <div class="col-lg-12 text-center">
                            <button class="btn btn-primary">
                                <span class="ti-check"></span>
                                @if(isset($editData))
                                    Update
                                    @else
                                    Save
                                    @endif
                                    Staff
                            </button>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                   
@endsection





