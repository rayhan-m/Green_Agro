@extends('admin.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section('mainContent')

    
        <div class="breadcrumb">
            <ul>
                <li><a href="#">System Setting</a></li>
                <li>Profile</li>
            </ul>
        </div>
    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
            <div class="col-md-4" style="text-align: center;">
                <div class="col-md-12 grid-margin stretch-card mb-40">
                    <div class="card">
                        <div class="card-body">
                            <img style="height: 150px; width:140px; margin-bottom: 20px;" src="{{ file_exists(@$profile->image) ? asset(@$profile->image) : asset('backend/uploads/staff/admin.PNG') }}" class="img-lg rounded" alt="profile image" />
                            <div class="d-flex flex-row">
                                {{-- <img src="{{asset('/')}}public/frontEnd/images/logo.png" class="img-lg rounded" alt="profile image" /> --}}
                                
                                <div class="ml-2">
                                    <form method="POST" action="{{route('update-profile-image')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="file" name="image" class="file-upload-default">
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                </span>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary mt-20" type="submit"> Change Image</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Profile Info  --}}
            <div class="col-md-4" style="text-align: center;">
                <div class="col-md-12 grid-margin stretch-card mb-40">
                    <div class="card">
                        <div class="card-body">
                            <h4>Update Your Profile</h4>

                            <!-- FORM -->
                            <form method="POST" action="{{ route('update-profile-info') }}">
                                @csrf
                            <ul class="row" style="list-style:none;">
                                <li class="col-sm-12" style="margin-left:0px;">
                                <label>Full Name
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ @$profile->name }}" required autocomplete="name" autofocus>
                                </label>
                                </li>
                                <li class="col-sm-12" style="margin-left:0px;">
                                <label>Email
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ @$profile->email }}" required autocomplete="email">
                                </label>
                                </li>
                                
                                <li class="col-sm-12">
                                <label>Phone No
                                    <input type="text" onkeypress="return isNumberKey(event)" value="{{ @$profile->phone }}" class="form-control" name="phone" placeholder="">
                                </label>
                                </li>
                                <li class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary mt-20">Update</button>
                                </li>
                            </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Password Change --}}
            <div class="col-md-4" style="text-align: center;">
                <div class="col-md-12 grid-margin stretch-card mb-40">
                    <div class="card">
                        <div class="card-body">
                            <h4>Change Your Password</h4>

                            <!-- FORM -->
                            <form method="POST" action="{{url('admin/change-pass')}}" enctype="multipart/form-data">
                                @csrf
                            <ul class="row" style="list-style:none;">
                                
                                <li class="col-sm-12">
                                <label>Current Password
                                    <input id="password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required >
                                    @if ($errors->has('current_password'))
                                        <span class="invalid-feedback text-left pl-3" role="alert">
                                            <strong style="color:red;">{{ $errors->first('current_password') }}</strong>
                                        </span>
                                    @endif
                                </label>
                                </li>
                                <li class="col-sm-12">
                                <label>New Password
                                    <input id="password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required>
                                    @if ($errors->has('new_password'))
                                        <span class="invalid-feedback text-left pl-3" role="alert">
                                            <strong style="color:red;">{{ $errors->first('new_password') }}</strong>
                                        </span>
                                    @endif
                                </label>
                                </li>
                                <li class="col-sm-12">
                                <label>Confirm Password
                                    <input id="password-confirm" type="password" class="form-control" name="confirm_password" required >
                                    @if ($errors->has('confirm_password'))
                                        <span class="invalid-feedback text-left pl-3" role="alert">
                                            <strong style="color:red;">{{ $errors->first('confirm_password') }}</strong>
                                        </span>
                                    @endif
                                </label>
                                </li>
                                
                                <li class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary mt-20">Update</button>
                                </li>
                            </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                    
    @endsection