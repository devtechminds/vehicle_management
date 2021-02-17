@extends('layouts.master')
@section('content')
<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-6">
<div class="page-header-title">
<i class="feather icon-clipboard bg-c-blue"></i>
<div class="d-inline">
<h2>Transport Master Show</h2>

</div>
</div>
</div>
<div class="col-lg-6">
<div class="page-header-breadcrumb">
<ul class=" breadcrumb breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.html"><i class="feather icon-home"></i></a>
</li>
<li class="breadcrumb-item"><a href="#!">Transport Master</a></li>
<li class="breadcrumb-item"><a href="#!">Transport Master Show</a></li>
</ul>
</div>
</div>
</div>
</div>
<div class="pcoded-inner-content">
   <div class="main-body">
      <div class="page-wrapper">
         <div class="page-body">
         @if(count($errors) > 0 )
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <ul class="p-0 m-0" style="list-style: none;">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-block">
                        <form action="{{route('agent.update')}}" id="myform" method="post">
                        @csrf
                        {{method_field('put')}}
                        <input type="hidden" name="id" value="{{$agent->agent_code}}">
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Transport Name</label>
                              <div class="col-sm-4">
                                 <input type="text" readonly name="transport_name" value="{{ ($agent->transport_name?$agent->transport_name:old('transport_name')) }}" class="form-control" placeholder="Enter Agent Name">
                              </div>
                              <label class="col-sm-2 col-form-label">Tin Number</label>
                              <div class="col-sm-4">
                                 <input type="number" readonly name="tin_no" value="{{ ($agent->tin_no?$agent->tin_no:old('tin_no')) }}" class="form-control" placeholder="Enter Tin Number">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">VRN Number</label>
                              <div class="col-sm-4">
                                 <input type="number" readonly  name="vrn_no" value="{{ ($agent->vrn_no?$agent->vrn_no:old('vrn_no')) }}" class="form-control" placeholder="Enter VRN Number">
                              </div>
                              <label class="col-sm-2 col-form-label">Mobile Number</label>
                              <div class="col-sm-4">
                                 <input type="number" readonly name="mobile_number" value="{{ ($agent->mobile_number?$agent->mobile_number:old('mobile_number')) }}" class="form-control" placeholder="Enter Mobile Number">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Email </label>
                              <div class="col-sm-4">
                                 <input type="text" readonly name="email" value="{{ ($agent->email?$agent->email:old('email')) }}" class="form-control" placeholder="Enter Email">
                              </div>
                              
                              <label class="col-sm-2 col-form-label">Country </label>
                              <div class="col-sm-4">
                                 <input type="text" readonly name="country"  value="{{ ($agent->country?$agent->country:old('country')) }}" class="form-control" placeholder="Enter Country">
                              </div>
                           </div>
                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Province </label>
                              <div class="col-sm-4">
                                 <input type="text"readonly name="province" value="{{ ($agent->province?$agent->province:old('province')) }}" class="form-control" placeholder="Enter Province">
                              </div>
                              <label class="col-sm-2 col-form-label">Place  </label>
                              <div class="col-sm-4">
                                 <input type="text" readonly  name="place" value="{{ ($agent->place?$agent->place:old('place')) }}" class="form-control" placeholder="Enter Place">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Address</label>
                              <div class="col-sm-4">
                                 <input type="text" readonly name="address" value="{{ ($agent->address?$agent->address:old('address')) }}" class="form-control" placeholder="Enter Address">
                              </div>
                              <label class="col-sm-2 col-form-label">Pincode</label>
                              <div class="col-sm-4">
                                 <input type="number" readonly name="pincode" value="{{ ($agent->pincode?$agent->pincode:old('pincode')) }}" class="form-control" placeholder="Enter Pincode">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Status</label>
                              <div class="col-sm-4">
                              <select name="status" class="form-control boxbrd fill" readonly>
                              <option value=''>Select Status</option>
                              <option value="1" {{ $agent->status=='1'?'selected':'' }}>Active</option>
                              <option value="0" {{ $agent->status=='1'?'':'selected' }}>Inactive</option>
                              </select>
                              </div>
                           </div>
                           <div class="card">
                     <div class="card-block height">
                        <div class="row">
                           <div class="col-sm-12" style="text-align: center;">
                              <a  href="{{route('transport.index')}}" class="btn btn-success waves-effect waves-light">Back</a>
                           </div>
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
</div>

@endsection