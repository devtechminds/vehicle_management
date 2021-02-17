@extends('layouts.master')
@section('content')
<div class="row">
<div class="col-xl-3 col-md-6 colheg">
    <div class="card prod-p-card card-red chgt">
        <div class="card-body">
            <div class="row align-items-center m-b-30">
            <div class="col">
                <h6 class="m-b-5 text-white">Total Vehicle In</h6>
                <h3 class="m-b-0 f-w-700 text-white">180</h3>
            </div>
            <div class="col-auto">
                <!--<i class="fas fa-money-bill-alt text-c-red f-18"></i>-->
                <i class="fa fa-bus text-c-red"></i>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6 colheg">
    <div class="card prod-p-card card-blue chgt">
        <div class="card-body">
            <div class="row align-items-center m-b-30">
            <div class="col">
                <h6 class="m-b-5 text-white">Total Vehicle Out</h6>
                <h3 class="m-b-0 f-w-700 text-white">135</h3>
            </div>
            <div class="col-auto">
                <!--<i class="fas fa-database text-c-blue f-18"></i>-->
                <i class="fa fa-bus text-c-blue"></i>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6 colheg">
    <div class="card prod-p-card card-green chgt">
        <div class="card-body">
            <div class="row align-items-center m-b-30 colh">
            <div class="col">
                <h6 class="m-b-5 text-white">Vehicle at Weigh Bridge</h6>
                <h3 class="m-b-0 f-w-700 text-white">30</h3>
            </div>
            <div class="col-auto">
                <!--<i class="fas fa-dollar-sign text-c-green f-18"></i>-->
                <i class="fa fa-car text-c-green"></i>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6 colheg">
    <div class="card prod-p-card card-yellow chgt">
        <div class="card-body">
            <div class="row align-items-center m-b-30">
            <div class="col">
                <h6 class="m-b-5 text-white">Tokens Generated</h6>
                <h3 class="m-b-0 f-w-700 text-white">110</h3>
            </div>
            <div class="col-auto">
                <i class="fas fa-tags text-c-yellow f-18"></i>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-12">
    <div class="card proj-progress-card">
        <div class="card-block">
            <div class="row">
            <div class="col-xl-4 col-md-6">
                <h6>Transit Container </h6>
                <h5 class="m-b-30 f-w-700">90<span class="text-c-green m-l-10">+50.00%</span></h5>
                <div class="progress">
                    <div class="progress-bar bg-c-red" style="width:50%"></div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <h6>Local Container</h6>
                <h5 class="m-b-30 f-w-700">40<span class="text-c-red m-l-10">22.2%</span></h5>
                <div class="progress">
                    <div class="progress-bar bg-c-blue" style="width:22%"></div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <h6>Empty Container </h6>
                <h5 class="m-b-30 f-w-700">50<span class="text-c-green m-l-10">+27.8%</span></h5>
                <div class="progress">
                    <div class="progress-bar bg-c-green" style="width:27%"></div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-6 col-md-12">
    <div class="card table-card">
        <div class="card-header">
            <h5>Vehicle In</h5>
            <div class="card-header-right">
            <ul class="list-unstyled card-option">
                <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                <li><i class="feather icon-maximize full-card"></i></li>
                <li><i class="feather icon-minus minimize-card"></i></li>
                <li><i class="feather icon-refresh-cw reload-card"></i></li>
                <li><i class="feather icon-trash close-card"></i></li>
                <li><i class="feather icon-chevron-left open-card-option"></i></li>
            </ul>
            </div>
        </div>
        <div class="card-block">
            <div class="table-responsive">
            <table class="table table-hover m-b-0  table-borderless">
                <thead>
                    <tr>
                        <th>Ref No</th>
                        <th>Cargo Ref No</th>
                        <th>Type of Consignment</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                        <div class="d-inline-block align-middle">
                            001
                        </div>
                        </td>
                        <td>16,300</td>
                        <td>
                        Transit
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <div class="d-inline-block align-middle">
                            002
                        </div>
                        </td>
                        <td>26,421</td>
                        <td>
                        Transit
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <div class="d-inline-block align-middle">
                            003
                        </div>
                        </td>
                        <td>10,652</td>
                        <td>
                        Transit
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-6 col-md-12">
    <div class="card table-card">
        <div class="card-header">
            <h5>Vehicle Out</h5>
            <div class="card-header-right">
            <ul class="list-unstyled card-option">
                <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                <li><i class="feather icon-maximize full-card"></i></li>
                <li><i class="feather icon-minus minimize-card"></i></li>
                <li><i class="feather icon-refresh-cw reload-card"></i></li>
                <li><i class="feather icon-trash close-card"></i></li>
                <li><i class="feather icon-chevron-left open-card-option"></i></li>
            </ul>
            </div>
        </div>
        <div class="card-block">
            <div class="table-responsive">
            <table class="table table-hover m-b-0  table-borderless">
                <thead>
                    <tr>
                        <th>Ref No</th>
                        <th>Cargo Ref No</th>
                        <th>Type of Consignment</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                        <div class="d-inline-block align-middle">
                            111
                        </div>
                        </td>
                        <td>16,300</td>
                        <td>
                        Empty
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <div class="d-inline-block align-middle">
                            112
                        </div>
                        </td>
                        <td>26,421</td>
                        <td>
                        Empty
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <div class="d-inline-block align-middle">
                            113
                        </div>
                        </td>
                        <td>10,652</td>
                        <td>
                        Empty
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card table-card">
        <div class="card-header">
            <h5>All Ref Numbers</h5>
            <div class="card-header-right">
            <ul class="list-unstyled card-option">
                <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                <li><i class="feather icon-maximize full-card"></i></li>
                <li><i class="feather icon-minus minimize-card"></i></li>
                <li><i class="feather icon-refresh-cw reload-card"></i></li>
                <li><i class="feather icon-trash close-card"></i></li>
                <li><i class="feather icon-chevron-left open-card-option"></i></li>
            </ul>
            </div>
        </div>
        <div class="card-block p-b-0">
            <div class="table-responsive">
            <table class="table table-hover m-b-0">
                <thead>
                    <tr>
                        <th>Ref No</th>
                        <th>Cargo Ref No<br>
                        D.N.No/B.No
                        </th>
                        <th>Total</th>
                        <th>Remaining</th>
                        <th>Type of Consignment</th>
                        <th>Type of Cargo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>011</td>
                        <td>#PHD001</td>
                        <td>4</td>
                        <td>3</td>
                        <td>Local</td>
                        <td>Container</td>
                        <td><label class="label label-success">Vehicle In authorize</label></td>
                    </tr>
                    <tr>
                        <td>012</td>
                        <td>#PHD001</td>
                        <td>5</td>
                        <td>1</td>
                        <td>Empty</td>
                        <td>Full</td>
                        <td><label class="label label-danger">Gate Pass Printed</label></td>
                    </tr>
                    <tr>
                        <td>013</td>
                        <td>#PHD001</td>
                        <td>6</td>
                        <td>0</td>
                        <td>Transit</td>
                        <td>Full</td>
                        <td><label class="label label-success">Container Out Authorize</label></td>
                    </tr>
                    <tr>
                        <td>014</td>
                        <td>#PHD001</td>
                        <td>7</td>
                        <td>0</td>
                        <td>Local</td>
                        <td>Full</td>
                        <td><label class="label label-danger">Out Pass Printed</label></td>
                    </tr>
                    <tr>
                        <td>015</td>
                        <td>#PHD001</td>
                        <td>7</td>
                        <td>5</td>
                        <td>Transit</td>
                        <td>Full</td>
                        <td><label class="label label-success">Vehicle Return Authorize</label></td>
                    </tr>
                    <tr>
                        <td>016</td>
                        <td>#PHD001</td>
                        <td>8</td>
                        <td>0</td>
                        <td>Transit</td>
                        <td>Full</td>
                        <td><label class="label label-danger">Weigh Bridge Entry</label></td>
                    </tr>
                    <tr>
                        <td>017</td>
                        <td>#PHD001</td>
                        <td>9</td>
                        <td>2</td>
                        <td>Empty</td>
                        <td>Container</td>
                        <td><label class="label label-success">Container Out Approved</label></td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection