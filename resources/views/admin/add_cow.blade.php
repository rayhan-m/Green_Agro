@extends('admin.master')
@section('mainContent')
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Cows</a></li>
            <li>Add New Cow</li>
        </ul>
    </div>
    <div class=" border-top"></div>
    <div class="mt-20 mb-20">
        <a href="{{route('cow_list')}}"> <button type="button" class="btn btn-primary"> Cow List</button></a>
    </div>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5 ">
            <div class="card-body col-md-12">
                <div class="mb-40">
                    {{-- {{dd(@$data)}} --}}
                    @if (@$editData)
                        <form method="POST" action="{{route('update_cow')}}" enctype="multipart/form-data" >
                    @else
                        <form method="POST" action="{{route('cow_create')}}" enctype="multipart/form-data" >
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
                                            <div class="col-lg-4">
                                                <div class="input-effect">
                                                    <label>Cow Name <span>*</span> </label>
                                                    <input class="primary-input form-control {{$errors->has('name') ? 'is-invalid' : ' '}}" type="text"  name="name" value="{{isset($editData)? @$editData->name : '' }}">
                                                    <span class="focus-border"></span>
                                                    
                                                    @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="input-effect">
                                                    <label>Bread</label>
                                                    <select
                                                        class="niceSelect w-100 bb form-control{{ $errors->has('bread_id') ? ' is-invalid' : '' }}"
                                                        name="bread_id" id="bread_id">
                                                        <option data-display="Select Bread *" value="">Select Bread</option>
                                                        @foreach(@$breads as $key=>$value)
                                                        <option value="{{@$value->id}}"{{@$value->id == @$editData->bread_id? 'selected':''}}>{{@$value->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('bread_id'))
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                                        <strong>{{ $errors->first('bread_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="input-effect">
                                                    <label>Seller</label>
                                                    <select
                                                        class="niceSelect w-100 bb form-control{{ $errors->has('seller_id') ? ' is-invalid' : '' }}"
                                                        name="seller_id" id="seller_id">
                                                        <option data-display="Select Seller *" value="">Select Seller</option>
                                                        @foreach($sellers as $key=>$value)

                                                        <option value="{{@$value->id}}"{{@$value->id == @$editData->seller_id? 'selected':''}}>{{@$value->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('seller_id'))
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                                        <strong>{{ $errors->first('seller_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row mt-20">
                                            <div class="col-lg-4">
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
                                            <div class="col-lg-4">
                                                <div class="input-effect">
                                                    <label>Cow Type <span>*</span> </label>
                                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type">
                                                        <option data-display="Cow Type *" value="">Select Type</option>
                                                        <option value="1" {{old('type')!=''? (old('type') == 1? 'selected':''):''}}{{@$editData->type == "1"? 'selected':''}} >Milky Cow</option>
                                                        <option value="0" {{old('type')!=''? (old('type') == 0? 'selected':''):''}}{{@$editData->type == "0"? 'selected':''}} >OX</option>
                                                    </select>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('type'))
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                                        <strong>{{ $errors->first('type') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        {{-- {{ dd($genders)}} --}}
                                        <div class="col-lg-4">
                                            <div class="input-effect">
                                                <label>Purpose <span>*</span> </label>
                                                <select class="niceSelect w-100 bb form-control{{ $errors->has('purpose') ? ' is-invalid' : '' }}" name="purpose">
                                                    <option data-display="Purpose *" value="">Select Purpose</option>
                                                    <option value="1" {{old('purpose')!=''? (old('purpose') == 1? 'selected':''):''}}{{@$editData->purpose == "1"? 'selected':''}} >Milk</option>
                                                    <option value="0" {{old('purpose')!=''? (old('purpose') == 0? 'selected':''):''}}{{@$editData->purpose == "0"? 'selected':''}} >Meat</option>
                                                </select>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('purpose'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong>{{ $errors->first('purpose') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                    
                                        
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-lg-4">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="input-effect">
                                                        <label>Wight /KG<span>*</span> </label>
                                                        <input class="primary-input date form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" type="text"
                                                        name="weight" onkeyup="isNumberKeyDecimal(this);" value="{{isset($editData)? @$editData->weight : '' }}" >
                                                        <span class="focus-border"></span>
                                                        
                                                        @if ($errors->has('weight'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('weight') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="input-effect">
                                                <label>Buy Price </label>
                                                <input class="primary-input form-control{{ $errors->has('buy_price') ? ' is-invalid' : '' }}" onkeyup="isNumberKeyDecimal(this);" type="text"  name="buy_price" value="{{isset($editData)? @$editData->buy_price : '' }}">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('buy_price'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('buy_price') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                <div class="row mt-20">
                                    <div class="col-lg-4  mt-20">
                                        @if (isset($editData))
                                            <img height="80px;" width="100px;"  src="{{asset('/')}}{{@$editData->image}}" class="img img-fluid">
                                        @endif
                                    
                                        <div class="form-group">
                                            <label> Cow Image </label>
                                            <input type="file" name="image" class="file-upload-default">
                                            <div class="input-group">
                                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Cow Image">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-effect">
                                            <label>Details <span>*</span> </label>
                                            <textarea class="primary-input form-control {{ $errors->has('details') ? 'is-invalid' : ''}}" cols="0" rows="6" name="details" id="details">{{isset($editData)? @$editData->details : '' }}</textarea>
                                            <span class="focus-border textarea"></span>
                                            @if ($errors->has('details'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('details') }}</strong>
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
                                    cow
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





