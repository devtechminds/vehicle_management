@extends('layouts.master')
@section('content')
<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-6">
<div class="page-header-title">
<i class="feather icon-clipboard bg-c-blue"></i>
<div class="d-inline">
<h2>Material  Update </h2>

</div>
</div>
</div>
<div class="col-lg-6">
<div class="page-header-breadcrumb">
<ul class=" breadcrumb breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.html"><i class="feather icon-home"></i></a>
</li>
<li class="breadcrumb-item"><a href="#!">Material Master</a></li>
<li class="breadcrumb-item"><a href="#!">Material Master Update</a></li>
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
                        <form action="{{route('material.update')}}" id="myform" method="post">
                        @csrf
                        {{method_field('put')}}
                        <input type="hidden" name="id" value="{{$material->id}}">
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Material Name</label>
                              <div class="col-sm-4">
                                 <input type="text" name="material_name" value="{{ $material->material_name?$material->material_name:old('material_name') }}" class="form-control" placeholder="Enter Material Name">
                              </div>
                             
                              <label class="col-sm-2 col-form-label">Unit Weight</label>
                              <div class="col-sm-4">
                                 <input type="number" name="unit_weight" value="{{ $material->unit_weight?$material->unit_weight:old('unit_weight') }}" class="form-control" placeholder="Enter Unit Weight">
                              </div>

                           </div>
                           <div class="form-group row">   
                              <label class="col-sm-2 col-form-label">UOM</label>
                              <div class="col-sm-4">
                              <select name="uom_id" class="form-control boxbrd fill">
                              <option value=''>Select UOM</option>
                              @foreach($uom as $value)
                              <option value="{{ $value['id']}}" {{ $value['id']== $material->uom_id  ? 'selected' : ''}}>{{  ucwords($value['unit_entry_filed'])}}</option>
                              @endforeach
                              </select>
                              </div>
                              <label class="col-sm-2 col-form-label">Commodity</label>
                              <div class="col-sm-4">
                              <select name="commodity_id" class="form-control boxbrd fill">
                              <option value=''>Select Commodity</option>
                              @foreach($commodity as $value)
                              <option value="{{ $value['commodity_code']}}"  {{ $value['commodity_code']== $material->commodity_id  ? 'selected' : ''}}>{{  ucwords($value['commodity_name'])}}</option>
                              @endforeach
                              </select>
                              </div>

                              
                           </div>

                           <div class="form-group row">          
                            <label class="col-sm-2 col-form-label">Status</label>
                              <div class="col-sm-4">
                              <select name="status" class="form-control boxbrd fill">
                              <option value="">Select Status</option>
                              <option value="1" {{  $material->status == 1 ? 'selected' : ''}}>Active</option>
                              <option value="0" {{ $material->status != 1   ? 'selected' : ''}}>Inactive</option>
                              </select>
                              </div>
                              
                           </div>

                        
                           <div class="card">
                     <div class="card-block height">
                        <div class="row">
                           <div class="col-sm-12" style="text-align: center;">
                              <button class="btn btn-success waves-effect waves-light">Update</button>
                              <a  href="{{route('material.index')}}" class="btn btn-success waves-effect waves-light">Cancel</a>
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
      material_name: {
            required: true,
            lettersonly: true
        },
        
        status: {
            required: true,
            
        },
        uom_id: {
            required: true,
            
        },
        commodity_id: {
            required: true,
            
        },unit_weight: {
            required: true,
            
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