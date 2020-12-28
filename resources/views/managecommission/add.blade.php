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
                        <h4>{{trans('file.Add Commission')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        <form class="form-horizontal" action="{{route('managecommission.create')}}" method="POST" enctype="multipart/form-data" role="form">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" id="category-id">
                                        <label><strong>{{trans('file.Category')}}</strong></label>
                                        <input type="hidden" name="category_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                        <select name="category" id="category" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select Category">
                                        @foreach($category as $Categorys)
                                            <option value="{{$Categorys->id}}">{{$Categorys->name}}</option>
                                        @endforeach                                         
                                        </select>
                                    </div>
                                    <div class="form-group" id="subcat-id">
                                        <label><strong>{{trans('file.Sub Category')}}</strong></label>
                                        <input type="hidden" name="subcat_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                        <select name="subcat" id="subcat" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select Sub Category...">
                                          {{-- @foreach($lims_biller_list as $biller)
                                              <option value="{{$biller->id}}">{{$biller->name}}</option>
                                          @endforeach --}}                                          
                                        </select>
                                    </div>                                     
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Commssion')}} *</strong></label>
                                        <input type="text" value="" name="commssion" id="commssion" placeholder="Commssion" required class="form-control">
                                        @if($errors->has('commssion'))
                                       <span>
                                           <strong>{{ $errors->first('commssion') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Payment Fee')}} *</strong></label>
                                        <input type="text" value="" name="payment_fee" id="payment_fee" placeholder="Payment Fee" required class="form-control">
                                        @if($errors->has('payment_fee'))
                                       <span>
                                           <strong>{{ $errors->first('payment_fee') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Vat')}} *</strong></label>
                                        <input type="text" value="" name="vat" id="vat" placeholder="Vat" required class="form-control">
                                        @if($errors->has('vat'))
                                       <span>
                                           <strong>{{ $errors->first('vat') }}</strong>
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
                                            <button type="submit" class="btn btn-primary">Add Commission</button>
                                            <a href="{{route('managecommission.index')}}" class="btn btn-default">Cancel</a>
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

<script>
$('#category').on('change', function() {
           var id = $(this).val();
            var html_district = "";
           $.ajax({
               url: "{{ route('managecommission.getsubCat',['id'=>'']) }}/"+id,
               type: "GET",
               success: function(response) {
                   if(response.length >= 1)
                   {
                    //console.log(response);
                    $('#subcat').find('option').remove();
                    //$("#chapter_id").remove();
                    var html_option = "";                    
                       for(var i=0; i<response.length; i++)
                       {
                            var id = response[i].id;
                            var name = response[i].name;

                            html_option += '<option value="'+id+'">'+name+'</option>';
                       }
                       $("#subcat").append(html_option);
                       $('.selectpicker').selectpicker('refresh');
                   }
               }
           });
       });


</script>

@endsection
