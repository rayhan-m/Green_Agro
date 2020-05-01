@extends('admin.master')
@section('mainContent')
     <div class="main-content pt-4">
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">Human Resources</a></li>
                        <li>Staff Details</li>
                    </ul>
                </div>
                <div class="separator-breadcrumb border-top"></div>
                <div class="card user-profile o-hidden mb-4">
                    <div class="header-cover" style="background-image: url('{{asset('/')}}backend/uploads/staff/banner.png'); height:200px !important;"></div>
                    <div class="user-info" style="    margin-top: -70px;">
                        <img class="" style="height:160px; width:140px;border-radius: 22px;" src="{{asset('/')}}{{$staffDetails->staff_photo}}"  alt="">
                        <p class="m-0 text-24">@if(isset($staffDetails)){{$staffDetails->full_name}}@endif</p>
                        <p class="text-muted m-0">{{@$staffDetails->mobile}}</p>
                    </div>
                    <div class="card-body">
                       
                        <div class="tab-content">

                            <div >
                                <hr />
                                <div class="row">
                                    <div class="col-md-3 col-6" style="margin-left:60px;">
                                        <div class="mb-4">
                                            <p class="text-primary mb-1"> Name : <span> {{@$staffDetails->full_name}}</span></p>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-primary mb-1"> Staff ID : <span># {{@$staffDetails->id}}</span></p>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-primary mb-1"> Basic Salary : <span>${{@$staffDetails->basic_salary}}</span></p>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-primary mb-1"> Phone No : <span> {{@$staffDetails->mobile}}</span></p>
                                        </div>
                                        
                                    </div>




                                    <div class="col-md-7 col-6" style="border-left: 1px solid #000; padding-left:60px;">
                                        <h4>Personal Info:</h4>
                                         <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1"> Gender :<span> @if ($staffDetails->gender_id==1)
                                                Male
                                            @else
                                                Female
                                            @endif</span></p>
                                        </div>
                                        <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1"> Birth Date : <span> {{@$staffDetails->date_of_birth}}</span></p>
                                        </div>
                                        <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1"> Date of Joining : <span> {{@$staffDetails->date_of_joining}}</span></p>
                                        </div>
                                        <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1"> Marital Status : <span> {{@$staffDetails->marital_status}}</span></p>
                                        </div>
                                        <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1"> Father Name : <span> {{@$staffDetails->fathers_name}}</span></p>
                                        </div>
                                        <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1">  Mother Name : <span> {{@$staffDetails->mothers_name}}</span></p>
                                        </div>
                                        <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1"> Email : <span> {{@$staffDetails->email}}</span></p>
                                        </div>
                                        <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1"> NID No : <span> {{@$staffDetails->nid}}</span></p>
                                        </div>
                                        <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1"> Emergency Mobile : <span> {{@$staffDetails->emergency_mobile}}</span></p>
                                        </div>
                                        <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1"> Current Address : <span> {{@$staffDetails->current_address}}</span></p>
                                        </div>
                                        <div class="mb-4" style="border-bottom: 1px solid;">
                                            <p class="text-primary mb-1"> Permanent Address : <span> {{@$staffDetails->permanent_address}}</span></p>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <h4>Qualification</h4>
                                <p>
                                    {{$staffDetails->qualification}}
                                </p>
                                <hr />
                                <h4>Work Experience</h4>
                                <p class="mb-4">{{$staffDetails->experience}}</p>
                               
                            </div>
                        </div>
                    </div>
                </div><!-- end of main-content -->
            </div>
@endsection





