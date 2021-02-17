@extends('layouts.master')
@section('content')
<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-6">
<div class="page-header-title">
<i class="feather icon-clipboard bg-c-blue"></i>
<div class="d-inline">
<h2>Customer Master Create </h2>

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
<li class="breadcrumb-item"><a href="#!">Customer Master Create</a></li>
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
                        <form action="{{route('customer.store')}}" id="myform" method="post">
                        @csrf
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Customer Name</label>
                              <div class="col-sm-4">
                                 <input type="text" name="customer_name" value="{{old('customer_name')}}" class="form-control" placeholder="Enter Custoemr Name">
                              </div>
                              <label class="col-sm-2 col-form-label">Tin Number</label>
                              <div class="col-sm-4">
                                 <input type="number" name="tin_no" min="1" value="{{old('tin_no')}}" class="form-control" placeholder="Enter Tin Number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  maxlength="15">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">VRN Number</label>
                              <div class="col-sm-4">
                                 <input type="text"  name="vrn_no" value="{{old('vrn_no')}}" class="form-control" placeholder="Enter VRN Number">
                              </div>
                              <label class="col-sm-2 col-form-label">Mobile Number</label>
                              <div class="col-sm-4">
                                 <input type="number" name="mobile_number" value="{{old('mobile_number')}}" class="form-control" placeholder="Enter Mobile Number">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Email </label>
                              <div class="col-sm-4">
                                 <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter Email">
                              </div>
                              
                              <label class="col-sm-2 col-form-label">Country </label>
                              <div class="col-sm-4">
                                 <input type="text" name="country"  value="{{old('country')}}" class="form-control" placeholder="Enter Country">
                              </div>
                           </div>
                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Province </label>
                              <div class="col-sm-4">
                                 <input type="text" name="province" value="{{ old('province')}}" class="form-control" placeholder="Enter Province">
                              </div>
                              <label class="col-sm-2 col-form-label">Place  </label>
                              <div class="col-sm-4">
                                 <input type="text"  name="place" value="{{ old('place')}}" class="form-control" placeholder="Enter Place">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Address</label>
                              <div class="col-sm-4">
                                 <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="Enter Address">
                              </div>
                              <label class="col-sm-2 col-form-label">Pincode</label>
                              <div class="col-sm-4">
                                 <input type="number" name="pincode" value="{{old('pincode')}}" class="form-control" placeholder="Enter Pincode">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Status</label>
                              <div class="col-sm-4">
                              <select name="status" class="form-control boxbrd fill">
                              <option value=''>Select Status</option>
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                              </select>
                              </div>
                           </div>
                           <div class="card">
                     <div class="card-block height">
                        <div class="row">
                           <div class="col-sm-12" style="text-align: center;">
                              <button class="btn btn-success waves-effect waves-light">Create</button>
                              <a  href="{{route('customer.index')}}" class="btn btn-success waves-effect waves-light">Cancel</a>
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
<style>
 .error {
      color: red;
   }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/additional-methods.js"></script>
<script>

$(document).ready(function () {

$('#myform').validate({ // initialize the plugin
    rules: {
      customer_name: {
            required: true,
            lettersonly: true
        },
        tin_no: {
            required: true,
            
        },
        vrn_no: {
            required: true,
            
        },
        status: {
            required: true,
            
        },
        email: {
            required: true,
            email: true
        } 
       
    },
    submitHandler: function (form) { // for demo
      $('#myform').submit();
    }
});

jQuery.validator.addMethod("lettersonly", function(value, element) {
return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "Enter vaild agent name.");
});


</script>
@endsection