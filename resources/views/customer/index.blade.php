@extends('layouts.master')
@section('content')
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-6">
            <div class="page-header-title">
                <i class="feather icon-clipboard bg-c-blue"></i>
                <div class="d-inline">
                    <h2>Customer Master List </h2>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="page-header-breadcrumb">
                <ul class=" breadcrumb breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="feather icon-home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Customer Master</a></li>
                    <li class="breadcrumb-item"><a href="#!">Customer Master List</a></li>
                    <li class="breadcrumb-item"><a href="{{route('customer.create')}}"
                            class="btn btn-info btn-sm waves-effect waves-light btnspace">Add Customer</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="pcoded-inner-content">
    @if (session('create'))
    <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong> {{ session('create') }} </strong>
    </div>
    @endif
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-body">
                <div class="row">






                    <div class="col-md-12">
                        <div class="card table-card">

                            <div class="card-header flthd">

                                <div class="form-group row">

                                    <div class="col boxspace">
                                    <a href="{{ route('customer.index')}}" title="Clear filter"><i class="fa fa-filter flt"></i></a>
                                    </div>
                                    <div class="col-sm-1 boxspace">
                                    <input type="text" id="tin_no" class="form-control hgt" placeholder="TIN No">
                                    </div>
                                    <div class="col-sm-1 boxspace">

                                        <input type="text"   id="vrn_no"  class="form-control hgt" placeholder="VRN No">

                                    </div>
                                    <div class="col boxspace">
                                        <select name="select"  id="status"   class="form-control boxbrd hgt">
                                            <option value="">Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>

                                    </div>
                                    <!-- <div class="col boxspace">
<select name="select" class="form-control boxbrd hgt">
<option value="opt1">Cargo Type</option>
<option value="opt2">Transit Full Container comes and Empty container goes out with vehicle</option>
<option value="opt3">Transit Full Container comes and Full container goes out with vehicle</option>
<option value="opt4">Transit Full Container comes and Empty vehicle goes out</option>
<option value="opt5">Transit Loose Material comes in and Empty vehicle goes out</option>
<option value="opt6">Local Full Container comes and Empty container goes out with vehicle</option>
<option value="opt7">Local Full Container comes and Full container goes out with vehicle</option>
<option value="opt8">Local Full Container comes and Empty vehicle goes out </option>
<option value="opt8">Local Loose Material comes in and Empty vehicle goes out</option>
<option value="opt9">Empty container comes in and Empty Vehicle goes out.</option>
<option value="opt10">Empty vehicle comes in and Empty Container goes out with vehicle</option>
<option value="opt11">Empty Vechile comes in and Full container goes with vehicle</option>
</select>

</div> -->
                                    <div class="col boxspace">
                                        <input type="date" id="created_date" onkeydown="return false" class="form-control hgt" placeholder="Date">

                                    </div>
                                    <div class="col-sm-1 boxspace">
                                        <button  id="filter" class="btn btn-info waves-effect waves-light btnspace">Filter</button>

                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12 boxspace">
                                <button class="btn viewModal btn-info" data-title="Active Customers" data-msg="Do you want to active all records"  data-name="" data-url="{{route('customer.status',['status'=>'active'])}}"  data-type="active" data-id="" data-type="active" data-id="" title="Active">Active</button>
                                <button class="btn viewModal btn-info" data-title="Inactive Customers" data-msg="Do you want to inactive all records"  data-name="" data-url="{{route('customer.status',['status'=>'inactive'])}}"  data-type="inactive" data-id="" data-type="inactive" data-id="" title="Inactive">Inactive</button>
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table id="agent_datatable" class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th class="hd">Id </th>
                                                <th class="hd">Customer Name</th>
                                                <th class="hd">TIN Number </th>
                                                <th class="hd">VRN Number</th>
                                                <th class="hd">Mobile Number</th>
                                                <th class="hd">Email</th>
                                                <th class="hd">Country</th>
                                                <th class="hd">Province</th>

                                                <th class="hd">Place</th>
                                                <th class="hd">Pincode</th>
                                                <th class="hd">Address</th>
                                                <th class="hd">Status</th>
                                                <th class="hd">Created Date</th>
                                                <th class="hd">Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        </tbody>




                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//code.jquery.com/jquery.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
       var tbl =  $('#agent_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('list.customer') }}",
                type: 'GET',
                data: function (d) {
                    d.tin_no = $('#tin_no').val();
                    d.vrn_no = $('#vrn_no').val();
                    d.status = $('#status').val();
                    d.created_date = $('#created_date').val();
                    
                }
            },
            columns: [
                {
                    "data": "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'customer_name', name: 'customer_name' },
                { data: 'tin_no', name: 'tin_no' },
                { data: 'vrn_no', name: 'vrn_no' },
                { data: 'mobile_number', name: 'mobile_number' },
                { data: 'email', name: 'email' },
                { data: 'country', name: 'country' },
                { data: 'province', name: 'province' },
                { data: 'place', name: 'place' },
                { data: 'pincode', name: 'pincode' },
                { data: 'address', name: 'address' },
                {
                    data: 'status', name: 'status', render: function (data, type, row) {
                        if (row.status == '1') {
                            return 'Active';
                        }
                        else {
                            return "Inactive";
                        }
                    }
                },


                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action' }
            ],
            'columnDefs': [{
                'targets': [], /* column index */
                'orderable'
                    :
                    false, /* true or false */
            }]
        });
        $('#filter').on('click', function(e) {
            tbl.draw();
            e.preventDefault();
            
        });


    });
</script>

@endsection