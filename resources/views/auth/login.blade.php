
@php
    $setting=App\GeneralSetting::findorfail(1);
@endphp
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signin | {{@$setting->site_name}}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('backend/css/themes/lite-purple.css') }}" rel="stylesheet" />
</head>
<div class="auth-layout-wrap" style="background-image: url({{asset('/')}}backend/images/photo-wide-4.jpg)">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-4" style="margin: 0px 130px;">
                    <div class="auth-logo text-center mb-4"><img src="{{asset('/')}}{{@$setting->logo}}" alt=""></div>
                        <h1 class="mb-3 text-18">Sign In</h1>
                        {{-- demo login  --}}
                        <form method="POST" class="loginForm" action="<?php echo e(route('login')); ?>">
                            <?php 
                            echo csrf_field();
                            $user =  DB::table('users')->select('email')->where('role_id',1)->first();
                            $email = $user->email;
                            

                            ?>
                            <input type="hidden" name="email" value="{{$email}}">
                            <input type="hidden" name="password" value="12345678">
                            <button type="submit" class="btn btn-rounded btn-primary mt-2 mb-2">Super Admin</button>
                        </form> 
                        {{-- demo login  --}}

                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="form-group">
                                <label for="email">Email address</label>
                                {{-- <input class="form-control form-control-rounded" id="email" type="email"> --}}
                                <input id="email" type="email" class="form-control-rounded form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group" style="margin-bottom:30px;">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control-rounded form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                {{-- <input class="form-control form-control-rounded" id="password" type="password"> --}}
                            </div>
                            <button class="btn btn-rounded btn-primary btn-block mt-2" type="submit">Sign In</button>
                        </form>
                        <div class="mt-3 text-center" style="margin-bottom:40px;" ><a class="text-muted" href="forgot.html">
                                <u>Forgot Password?</u></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>