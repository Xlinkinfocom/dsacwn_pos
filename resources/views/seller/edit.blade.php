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
                        <h4>{{trans('file.Update User')}}</h4>
                    </div>{!! Form::open(['route' => ['seller.update', $lims_user_data->id], 'method' => 'put', 'files' => true]) !!}
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="account_type" id="account_type" value="">
                       
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Account Type')}} *</strong> </label>
                                        <span style="display: block">
                                        <input type="radio" style="margin-top: 5px;" class="account_type" name="account_type" value="business">&nbsp; Business &nbsp;&nbsp;
                                        <input type="radio" style="margin-top: 5px;" class="account_type" name="account_type" value="personal">&nbsp;Personal
                                        </span>
                                        @if($errors->has('account_type'))
                                       <span>
                                           <strong>{{ $errors->first('account_type') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.UserName')}} *</strong> </label>
                                        <input type="text" name="name" required class="form-control" value="{{$lims_user_data->name}}">
                                        @if($errors->has('name'))
                                       <span>
                                           <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Change Password')}}</strong> </label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control">
                                            <div class="input-group-append">
                                                <button id="genbutton" type="button" class="btn btn-default">{{trans('file.Generate')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label><strong>{{trans('file.Email')}} *</strong></label>
                                        <input type="email" name="email" placeholder="example@example.com" required class="form-control" value="{{$lims_user_data->email}}">
                                        @if($errors->has('email'))
                                       <span>
                                           <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-3">
                                        <label><strong>{{trans('file.Phone Number')}} *</strong></label>
                                        <input type="text" name="phone" required class="form-control" value="{{$lims_user_data->phone}}">
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Address')}} *</strong> </label>
                                        <input type="text" name="address1" required class="form-control" placeholder="Address Line 1" value="{{--{{$lims_user_data->name}} --}}">
                                    </div>

                                    <div class="form-group">
                                        <label><strong>{{trans('file.Address Line 2')}} *</strong> </label>
                                        <input type="text" name="address2" required class="form-control" placeholder="Address Line 2" value="{{--{{$lims_user_data->name}} --}}">
                                    </div>

                                    <div class="form-group" id="country-id">
                                        <label><strong>{{trans('file.Country')}}</strong></label>
                                        <input type="hidden" name="country_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                        <select name="country" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select country...">
                                          {{-- @foreach($lims_biller_list as $biller)
                                              <option value="{{$biller->id}}">{{$biller->name}}</option>
                                          @endforeach --}}
                                          <option value="153">Nepal</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="state-id">
                                        <label><strong>{{trans('file.State/Province')}}</strong></label>
                                        <input type="hidden" name="state_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                        <select name="state" id="state" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select state/province...">
                                          {{-- @foreach($lims_biller_list as $biller)
                                              <option value="{{$biller->id}}">{{$biller->name}}</option>
                                          @endforeach --}}
                                          <option value="153">State One</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="district-id">
                                        <label><strong>{{trans('file.District')}}</strong></label>
                                        <input type="hidden" name="district_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                        <select name="district" id="district" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select district...">
                                          {{-- @foreach($lims_biller_list as $biller)
                                              <option value="{{$biller->id}}">{{$biller->name}}</option>
                                          @endforeach --}}
                                          <option value="153">District One</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Zip/Postal Code')}} </strong> </label>
                                        <input type="text" name="zipcode" required class="form-control" placeholder="Zip/Postal Code" value="{{--{{$lims_user_data->name}} --}}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Citizen Number')}} </strong> </label>
                                        <input type="text" name="citizennumber" required class="form-control" placeholder="Citizen Number" value="{{--{{$lims_user_data->name}} --}}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label><strong>{{trans('file.PAN Number')}} </strong> </label>
                                        <input type="text" name="panno" required class="form-control" placeholder="PAN Number" value="{{--{{$lims_user_data->name}} --}}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Vat Number')}} </strong> </label>
                                        <input type="text" name="vatno" required class="form-control" placeholder="Vat Number" value="{{--{{$lims_user_data->name}} --}}">
                                    </div>
                                  
                                    <div class="form-group">
                                        <label><strong>{{trans('file.CST/GST Number')}} </strong> </label>
                                        <input type="text" name="gstno" required class="form-control" placeholder="CST/GST Number" value="{{--{{$lims_user_data->name}} --}}">
                                    </div>
                                  
                                    <div class="form-group">
                                        <label><strong>{{trans('file.BANK ACCOUNT NAME')}} </strong> </label>
                                        <input type="text" name="bankaccountname" required class="form-control" placeholder="BANK ACCOUNT NAME" value="{{--{{$lims_user_data->name}} --}}">
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.BANK NAME')}} </strong> </label>
                                        <input type="text" name="bankname" required class="form-control" placeholder="BANK NAME" value="{{--{{$lims_user_data->name}} --}}">
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.ACCOUNT NUMBER')}} </strong> </label>
                                        <input type="text" name="accountnumber" required class="form-control" placeholder="ACCOUNT NUMBER" value="{{--{{$lims_user_data->name}} --}}">
                                    </div>
                                  
                                    
                                    <div class="form-group">
                                        <label><strong>{{trans('file.BRANCH NAME')}} </strong> </label>
                                        <input type="text" name="branchname" required class="form-control" placeholder="BRANCH NAME" value="{{--{{$lims_user_data->name}} --}}">
                                    </div>









                                    <div class="form-group">
                                        @if($lims_user_data->is_active)
                                        <input class="mt-2" type="checkbox" name="is_active" value="1" checked>
                                        @else
                                        <input class="mt-2" type="checkbox" name="is_active" value="1">
                                        @endif
                                        <label class="mt-2"><strong>{{trans('file.Active')}}</strong></label>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <label><strong>{{trans('file.Business Name')}}</strong></label>
                                         <input type="text" name="business_name" class="form-control" value="{{--{{$lims_user_data->business_name}}--}}"> 
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Seller Name')}}</strong></label>
                                        <input type="text" name="seller_name" class="form-control" value="{{--{{$lims_user_data->seller_name}}--}}"> 
                                    </div> 
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Company Name')}}</strong></label>
                                        <input type="text" name="company_name" class="form-control" value="{{$lims_user_data->company_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Role')}} *</strong></label>
                                        <input type="hidden" name="role_id_hidden" value="{{$lims_user_data->role_id}}">
                                        <select name="role_id" required class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Role...">
                                          @foreach($lims_role_list as $role)
                                              <option value="{{$role->id}}">{{$role->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="areaofinterest-id">
                                        <label><strong>{{trans('file.Business area of interest')}}</strong></label>
                                        <input type="hidden" name="areaofinterest_hidden" value="{{$lims_user_data->biller_id}}">
                                        <select name="areaofinterest" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select Business area of interest...">
                                          {{-- @foreach($lims_biller_list as $biller)
                                              <option value="{{$biller->id}}">{{$biller->name}}</option>
                                          @endforeach --}}
                                          <option value="Wholesale Selling to Rollo">Wholesale Selling to Rollo</option>
                                        <option value="Rollo Marketplace">Rollo Marketplace</option>
                                        <option value="Rollo Travels">Rollo Travels</option> 
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label><strong>{{trans('file.BILLING ADDRESS')}} </strong>(Same as Pick Address)  <input type="checkbox" name="add" class="sameaddress"></label>                                     
                                        <input type="text" name="baddress1" id="baddress1"  placeholder="Address Line 1" class="form-control" value="{{--{{$lims_user_data->seller_name}}--}}"> 
                                    </div>
                                   
                                    <div class="form-group">
                                        <label><strong>{{trans('file.BILLING ADDRESS 2')}} </strong></label>                                     
                                        <input type="text" name="baddress2" id="baddress2" placeholder="Address Line 2" class="form-control" value="{{--{{$lims_user_data->seller_name}}--}}"> 
                                    </div>
                                    
                                <div class="form-group" id="bcountry-id">
                                        <label><strong>{{trans('file.Country')}}</strong></label>
                                        <input type="hidden" name="bcountry_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                        <select name="bcountry" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select country...">
                                          {{-- @foreach($lims_biller_list as $biller)
                                              <option value="{{$biller->id}}">{{$biller->name}}</option>
                                          @endforeach --}}
                                          <option value="153">Nepal</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="bstate-id">
                                        <label><strong>{{trans('file.State/Province')}}</strong></label>
                                        <input type="hidden" name="bstate_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                        <select name="bstate" id="bstate" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select state/province...">
                                          {{-- @foreach($lims_biller_list as $biller)
                                              <option value="{{$biller->id}}">{{$biller->name}}</option>
                                          @endforeach --}}
                                          <option value="153">State One</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="bdistrict-id">
                                        <label><strong>{{trans('file.District')}}</strong></label>
                                        <input type="hidden" name="bdistrict_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                        <select name="bdistrict" id="bdistrict" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select district...">
                                          {{-- @foreach($lims_biller_list as $biller)
                                              <option value="{{$biller->id}}">{{$biller->name}}</option>
                                          @endforeach --}}
                                          <option value="153">District One</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="bzipcode-id">
                                        <label><strong>{{trans('file.Zip/Postal Code')}}</strong></label>
                                        <input type="hidden" name="bzipcode_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                        <select name="bzipcode" id="bzipcode" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select Zip/Postal Code...">
                                          {{-- @foreach($lims_biller_list as $biller)
                                              <option value="{{$biller->id}}">{{$biller->name}}</option>
                                          @endforeach --}}
                                          <option value="153">ZipCode One</option>
                                        </select>
                                    </div>
                                    




                                    {{-- <div class="form-group" id="biller-id">
                                        <label><strong>{{trans('file.Biller')}} *</strong></label>
                                        <input type="hidden" name="biller_id_hidden" value="{{$lims_user_data->biller_id}}">
                                        <select name="biller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Biller...">
                                          @foreach($lims_biller_list as $biller)
                                              <option value="{{$biller->id}}">{{$biller->name}}</option>
                                          @endforeach
                                        </select>
                                    </div> --}}
                                    {{-- <div class="form-group" id="warehouseId">
                                        <label><strong>{{trans('file.Warehouse')}} *</strong></label>
                                        <input type="hidden" name="warehouse_id_hidden" value="{{$lims_user_data->warehouse_id}}">
                                        <select name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Warehouse...">
                                          @foreach($lims_warehouse_list as $warehouse)
                                              <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                          @endforeach
                                        </select>
                                    </div> --}}
                                </div>                              
                            </div>
                        
                    </div>
                    <div class="card-body"> 
                        <div class="col-md-3"> 
                            <span id="message"> </span>
                        </div>
                        <div class="col-md-9"> 
                        </div>
                        <div class="clearfix"></div>
          
                        <div class="row">
                            <div class="col-md-6">
                              
                                
                                
                                
                                 
                               
                            </div> 
                            <div class="col-md-6">
                               
                               
                                <div class="input-group mb-3">
                                   
                                </div> 
                          
                            </div>
                        </div>
                     
                        <div class="row"> 
                            <div class="col-md-6" style="padding-left:0px;padding-right:0px;"> 
                                <div class="col-md-12"> <p style="font-size: 18px;text-align: left;">&nbsp;</p> </div>
                               
                            </div>
                            <div class="col-md-6" style="padding-left:0px;padding-right:0px;">
                                <label class="container-checkbox">Billing Address  
                                   
                                    <span class="checkmark"></span>
                                </label>
                                <br>
                                <br>
                                <div class="col-md-12"> 
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text" id="">Country</span></div>  
                                        <select id="bcountry" name="bcountry" class="form-control bcountry"> 
                                            <optgroup label="Please select state"> 
                                                 
                                                <option value="">Select</option>
                                                                                                        <option value="153">Nepal</option>
                                                                                                    </optgroup> 
                                        </select>  
                                    </div> 
                                </div>  
                                <div class="col-md-12"> 
                                    <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text" id="">State/Province</span></div>  
                                    <select id="bstate" name="bstate" class="form-control bstate"> 
                                        <optgroup label="Please select state"> 
                                                                                            </optgroup> 
                                    </select>  
                                    </div>  
                                </div>  
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text" id="">District</span></div>  
                                    <select id="bcity" name="bcity" class="form-control bcity"> 
                                        <optgroup label="Please select city"> 
                                                                                        </optgroup> 
                                    </select>  
                                    </div>  
                                </div> 
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text" id="">Zip/Postal Code </span></div>  
                                    <input type="text" class="form-control" name="bzipcode" id="bzipcode" value="" placeholder="" required=""> 
                                    </div> 
                                </div>
                            </div>
                        </div> 
                                     
                        
                        <div class="row">
                            <div class="col-md-6"> 
                                    <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text" id="">Status</span></div> 
                                    <select name="status" class="form-control ">
                                          <option value="1">Enable</option>
                                        <option value="0">Disable</option> 
                                    </select>
                                </div> 
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="">Show on fashion outlet</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" style="margin-top: 5px;" class="show_on_fashion_outlet" name="show_on_fashion_outlet" value="1">&nbsp;   &nbsp;&nbsp; 
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="">Lock Account</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" style="margin-top: 5px;" class="is_lock" name="is_lock" value="1">&nbsp;   &nbsp;&nbsp; 
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="">Verify Kyc</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" style="margin-top: 5px;" class="is_kyc_verified" name="is_kyc_verified" value="1">&nbsp;   &nbsp;&nbsp; 
                                </div>
                            </div>  
                            <div class="col-md-6">
                                                                        
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text" id=""> Upload Outlet Logo</span></div> 
                                        <input class="form-control" type="file" name="outlet_logo" placeholder=""> 
                                    </div>
                                                                                <div class="input-group mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text" id="">Upload PAN Card</span></div>  
                                        <input class="form-control" type="file" name="panno_image[]" placeholder="">  
                                    </div>
                                    
                                    
                                                                                
                                    
                                                                                                                                                                                                                                    
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text" id=""> Upload Citizenship</span></div> 
                                        <input class="form-control" type="file" name="citizenship_document" placeholder="">  
                                    </div>
                                                                                <div class="input-group mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text" id=""> Upload Passport Size Photo</span></div> 
                                        <input class="form-control" type="file" name="passportsizephoto" placeholder="">  
                                    </div>
                                                                                <div class="input-group mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text" id=""> Upload GST</span></div> 
                                        <input class="form-control" type="file" name="gst_document" placeholder="">  
                                    </div> 
                                                                                                                            
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text" id=""> UPLOAD CANCELLED CHEQUE </span></div> 
                                        <input class="form-control" type="file" name="check_image" placeholder="">  
                                    </div> 
                                                                        </div>  
                        </div> 
                        
                        
                        <button type="submit" class="seller btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button>
                    </div> 
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");
    $('#biller-id').hide();
    $('#warehouseId').hide();
    
    

    $('select[name=role_id]').val($("input[name='role_id_hidden']").val());
    if($('select[name=role_id]').val() > 2){
        $('#warehouseId').show();
        $('select[name=warehouse_id]').val($("input[name='warehouse_id_hidden']").val());
        $('#biller-id').show();
        $('select[name=biller_id]').val($("input[name='biller_id_hidden']").val());
    }
    $('.selectpicker').selectpicker('refresh');

    $('select[name="role_id"]').on('change', function() {
        if($(this).val() > 2 && $(this).val() != 8 ){
            $('select[name="warehouse_id"]').prop('required',true);
            $('select[name="biller_id"]').prop('required',true);
            $('#biller-id').show();
            $('#warehouseId').show();
        }
        else{
            $('select[name="warehouse_id"]').prop('required',false);
            $('select[name="biller_id"]').prop('required',false);
            $('#biller-id').hide();
            $('#warehouseId').hide();
        }
    });

    $('#genbutton').on("click", function(){
      $.get('../genpass', function(data){
        $("input[name='password']").val(data);
      });
    });

</script>
@endsection