@php
    $setting=App\GeneralSetting::where('active_status',1)->first();
    $profile=App\User::where('id','=',Auth::user()->id)->first();
@endphp
@include('admin.include.header')

@include('admin.include.sidebar')

@yield('mainContent')

@include('admin.include.footer')      