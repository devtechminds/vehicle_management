@extends('layouts.master')
@section('content')
<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-6">
<div class="page-header-title">
<i class="feather icon-clipboard bg-c-blue"></i>
<div class="d-inline">
<h2>Consignment Master Show</h2>

</div>
</div>
</div>
<div class="col-lg-6">
<div class="page-header-breadcrumb">
<ul class=" breadcrumb breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.html"><i class="feather icon-home"></i></a>
</li>
<li class="breadcrumb-item"><a href="#!">Consignment Master</a></li>
<li class="breadcrumb-item"><a href="#!">Consignment Master Show</a></li>
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
                              <label class="col-sm-2 col-form-label">Consignment Type</label>
                              <div class="col-sm-4">
                                 <input type="text" readonly name="consignment_type" value="{{ ($agent->consignment_type?$agent->consignment_type:old('consignment_type')) }}" class="form-control" placeholder="Enter Agent Name">
                              </div>
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
                              <a  href="{{route('consignments.index')}}" class="btn btn-success waves-effect waves-light">Back</a>
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