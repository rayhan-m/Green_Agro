@extends('admin.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section('mainContent')


<div class="breadcrumb">
    <ul>
        <li><a href="#">Cows</a></li>
        <li>Bread List</li>
    </ul>
</div>
<div class=" border-top"></div>
<div class="mt-20 mb-20">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> <span>+</span>
        Bread</button>
</div>

<!-- Table row-->
<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card text-left">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display table table-striped table-bordered" id="zero_configuration_table"
                        style="width:100%; font-size:12px;">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Bread Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $count=1;
                            @endphp
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#editModal{{$item->id}}" href="#">
                                        <i class="fa fa-pencil-square-o" title="Edit" aria-hidden="true"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#deleteModal{{$item->id}}" href="#">
                                        <i class="fa fa-trash" title="Delete" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            <!--Edit Modal starts -->

                            <div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel-2">Edit Bread</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{route('bread_update')}}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{@$item->id}}">
                                            <div class="modal-body">
                                                <div class="row mb-20">
                                                    <div class="col-lg-10 col-lg-offset-1" style="margin-left: 40px;">

                                                        <div class="input-effect mt-20">
                                                            <label>Bread Name *</label>
                                                            <input
                                                                class="primary-input date form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                                type="text" name="name" value="{{@$item->name}}"
                                                                autocomplete="off">
                                                            <span class="focus-border"></span>
                                                            @if ($errors->has('name'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-info">Submit</button>
                                                <button type="button" class="btn btn-light"
                                                    data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--Edit Modal Ends -->
                            {{-- Delete Modal--}}
                            <div class="modal fade" id="deleteModal{{$item->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete Bread</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="text-center">
                                                <h4>Are You Sure To Delete Bread ?</h4>
                                            </div>
                                            <div class="mt-20 d-flex justify-content-between">
                                                <button type="button" class="btn btn-info"
                                                    data-dismiss="modal">Cancel</button>
                                                <a href="{{url('admin/bread-delete/'.$item->id)}}"><button
                                                        class="btn btn-danger">Delete</button></a>
                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- End Delete Modal --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal starts -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">Bread Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('bread_submit')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-20">
                            <div class="col-lg-10 col-lg-offset-1" style="margin-left: 40px;">

                                <div class="input-effect mt-20">
                                    <label>Bread Name *</label>
                                    <input
                                        class="primary-input date form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        type="text" name="name" autocomplete="off">
                                    <span class="focus-border"></span>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
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