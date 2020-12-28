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
                        <h4>{{trans('file.Add Subscription Plan')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        <form class="form-horizontal" action="{{route('package.create')}}" method="POST" enctype="multipart/form-data" role="form">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" id="category-id">
                                        <label><strong>{{trans('file.Category')}}</strong></label>
                                        <input type="hidden" name="category_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                        <select name="category" id="category" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select Category">
                                        @foreach($Category as $Categorys)
                                            <option value="{{$Categorys->id}}">{{$Categorys->name}}</option>
                                        @endforeach                                         
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Plan Description')}} *</strong> </label>
										<input type="text" value="" name="description" id="description" placeholder="Plan Description" required class="form-control">
										@if($errors->has('description'))
                                       <span>
                                           <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                        @endif
                                    </div>                                         
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Plan Value Per Month')}} *</strong></label>
                                        <input type="text" value="" name="no_of_credit" id="no_of_credit" placeholder="Plan Value Per Month" required class="form-control">
                                        @if($errors->has('no_of_credit'))
                                       <span>
                                           <strong>{{ $errors->first('no_of_credit') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">                                        
                                        <input class="mt-2" type="checkbox" name="is_active" value="1" >                                       
                                        <label class="mt-2"><strong>{{trans('file.Active')}}</strong></label>
                                    </div>
                                   
                                    <div class="form-group row">
                                        <label for="zipcode" class="col-xs-2 col-form-label"></label>
                                        <div class="col-xs-10">
                                            <button type="submit" class="btn btn-primary">Add Subscription Plan</button>
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
