@extends('layout.main') @section('content')

@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Edit Subscription Plan')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        <form class="form-horizontal" action="{{route('package.update', $credit_package->credit_package_id )}}" method="POST" enctype="multipart/form-data" role="form">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Plan Name')}} *</strong> </label>
										<input type="text" value="{{ $credit_package->name }}" name="name" id="name" placeholder="Name" required class="form-control">
										@if($errors->has('name'))
                                       <span>
                                           <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Plan Description')}} *</strong> </label>
										<input type="text" value="{{ $credit_package->description }}" name="description" id="description" placeholder="Plan Description" required class="form-control">
										@if($errors->has('description'))
                                       <span>
                                           <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                        @endif
                                    </div>                                         
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Email')}} *</strong></label>
                                        <input type="text" value="{{ $credit_package->name }}" name="name" id="name" placeholder="Name" required class="form-control">
                                        @if($errors->has('email'))
                                       <span>
                                           <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                        <div class="form-group row">
                                            <label for="no_of_credit" class="col-xs-2 col-form-label">No. of Credit</label>
                                            <div class="col-xs-10">
                                                <input class="form-control" type="text" value="{{ $credit_package->face_value }}" name="no_of_credit"  id="no_of_credit" placeholder="No. of Credit">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="zipcode" class="col-xs-2 col-form-label"></label>
                                        <div class="col-xs-10">
                                            <button type="submit" class="btn btn-primary">Update Credit Package</button>
                                            <a href="{{route('package.index')}}" class="btn btn-default">Cancel</a>
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
</section>


@endsection
