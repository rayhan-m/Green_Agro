@extends('admin.master') @section('mainContent')
<div class="breadcrumb">
    <ul>
        <li><a href="#">Foods</a></li>
        <li>Feed Food</li>
    </ul>
</div>
<div class=" border-top"></div>
<div class="mt-20 mb-20">
    <a href="{{route('feed_food')}}">
        <button type="button" class="btn btn-primary"> Go Back</button>
    </a>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5 ">
            <div class="card-body col-md-12">
                <div class="mb-40">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{route('feed_food_create')}}" enctype="multipart/form-data" >
                                @csrf
                                <div class="white-box">
                                <div class="row mt-20">
                                    <div class="col-lg-12">
                                        <div class="main-title">
                                            <h4>Feed Food List</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <hr>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <div class="card text-left">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="display table table-striped table-bordered" id="myTable" style="width:100%; font-size:12px;">
                                                    <thead>
                                                        <tr>
                                                            <th>Food Name</th>
                                                            <th>Quantity</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>

                                                            {{--
                                                            <td>
                                                                <input type="text" name="keywords">
                                                            </td> --}}
                                                            <td>
                                                                <div class="input-effect" id="fooditem">
                                                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('food_id') ? ' is-invalid' : '' }}" name="food_id[]" id="food_id">
                                                                        <option data-display="Select Bread *" value="">Select Food</option>
                                                                        @foreach(@$food_list as $key=>$value)
                                                                        <option value="{{@$value->id}}">{{@$value->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input class="primary-input form-control" type="number" name="quantity[]">
                                                            </td>
                                                            <td>
                                                                <input type="button" class="btn btn-primary" value="Add" onclick="addField(); clickCounter()">
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>

                                                <table id="">

                                                </table>

                                                <input type="text" hidden value="{{url('/')}}" id="url">
                                                <input type="text" hidden  value="" id="counter">
                                                <script type="text/javascript">
                                                    var clicks = 1;
                                                    function clickCounter() {
                                                        clicks += 1;
                                                        document.getElementById("counter").value = clicks;
                                                    };
                                                    </script>
                                                <script>
                                                    function addField(finish_type) {
                                                            var clicks=document.getElementById("counter").value ;
                                                            var myTable = document.getElementById(myTable);
                                                            var url = $("#url").val();

                                                        var formData = {};

                                                        $.ajax({
                                                            type: "GET",
                                                            data: formData,
                                                            dataType: "json",
                                                            url: url + "/" + "admin/get-food-item",
                                                            success: function(data) {
                                                                // console.log(data);
                                                                var dynamicProductList = "";
                                                                dynamicProductList += `
                                                                        <tr id='foodrow'>
                                                                        <td>
                                                                            <select class='niceSelect w-100 bb form-control' id="food_list`+clicks+`" name="food_id[]" >
                                                                                <option value=''>Select Food</option> 
                                                                                </select>
                                                                        </td>
                                                                        <td><input type='number' class='form-control' name='quantity[]'></td>
                                                                        <td><input type="button" class='btn btn-danger' onclick="removeRow(this)" value="Delete" /></td>
                                                                        </tr>`;
                                                                
                                                                $("#myTable").append(dynamicProductList);

                                                                //=========================
                                                                Object.keys(data).forEach(function(key) {
                                                                    var select=document.getElementById('food_list'+clicks);
                                                                    var option = document.createElement("option");
                                                                        option.text = data[key].name;
                                                                        option.value = data[key].id;
                                                                    select.appendChild(option);

                                                                });
                                                                //=========================
                                                            },
                                                            error: function(data) {
                                                                console.log("no");
                                                                setTimeout(function() {
                                                                    toastr.error("Operation Success!", "Error Alert", {
                                                                        timeOut: 5000,
                                                                    });
                                                                }, 500);
                                                            },
                                                        });
                                                    }

                                                    function removeRow(rows) {
                                                        var _row = rows.parentElement.parentElement;
                                                        document.getElementById('myTable').deleteRow(_row.rowIndex);
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="btn btn-primary">
                                            <span class="ti-check"></span> Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
