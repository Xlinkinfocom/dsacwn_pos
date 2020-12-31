@extends('layout.main') @section('content')

@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif

<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if($isNew == true)
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
                                        <input type="radio" style="margin-top: 5px;" class="account_type" name="account_type"  value="business">&nbsp; Business &nbsp;&nbsp;
                                        <input type="radio" style="margin-top: 5px;" class="account_type" name="account_type"  value="personal">&nbsp;Personal
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
                                        <input type="text" name="address1" id="address1" required class="form-control" placeholder="Address Line 1" value="">
                                    </div>

                                    <div class="form-group">
                                        <label><strong>{{trans('file.Address Line 2')}}</strong> </label>
                                        <input type="text" name="address2" id="address2" required class="form-control" placeholder="Address Line 2" value="">
                                    </div>

                                    <div class="form-group" id="country-id">
                                        <label><strong>{{trans('file.Country')}}</strong></label>
                                        <input type="hidden" name="country_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                        <select name="country" id="country" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select country...">
                                          {{-- @foreach($lims_biller_list as $biller)
                                              <option value="{{$biller->id}}">{{$biller->name}}</option>
                                          @endforeach --}}
                                          <option value="1">India</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="state-id">
                                        <label><strong>{{trans('file.State/Province')}}</strong></label>
                                        <input type="hidden" name="state_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                        <select name="state" id="state" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select state/province...">
                                            @foreach($states as $state)
                                                <option value="{{$state->id}}" >{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="district-id">
                                        <label><strong>{{trans('file.District')}}</strong></label>
                                        <input type="hidden" name="district_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                        <select name="district" id="district" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select district...">
                                          @foreach($districts as $district)
                                              <option value="{{$district->id}}" >{{$district->name}}</option>
                                          @endforeach                                        
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Zip/Postal Code')}} </strong> </label>
                                        <input type="text" name="zipcode" id="zipcode" required class="form-control" placeholder="Zip/Postal Code" value="">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Citizen Number')}} </strong> </label>
                                        <input type="text" name="citizennumber" required class="form-control" placeholder="Citizen Number" value="">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label><strong>{{trans('file.PAN Number')}} </strong> </label>
                                        <input type="text" name="panno" required class="form-control" placeholder="PAN Number" value="">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Vat Number')}} </strong> </label>
                                        <input type="text" name="vatno" required class="form-control" placeholder="Vat Number" value="">
                                    </div>
                                  
                                    <div class="form-group">
                                        <label><strong>{{trans('file.CST/GST Number')}} </strong> </label>
                                        <input type="text" name="gstno" required class="form-control" placeholder="CST/GST Number" value="">
                                    </div>
                                  
                                    <div class="form-group">
                                        <label><strong>{{trans('file.BANK ACCOUNT NAME')}} </strong> </label>
                                        <input type="text" name="bankaccountname" required class="form-control" placeholder="BANK ACCOUNT NAME" value="">
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.BANK NAME')}} </strong> </label>
                                        <input type="text" name="bankname" required class="form-control" placeholder="BANK NAME" value="">
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.ACCOUNT NUMBER')}} </strong> </label>
                                        <input type="text" name="accountnumber" required class="form-control" placeholder="ACCOUNT NUMBER" value="">
                                    </div>                      
                                    <div class="form-group">
                                        <label><strong>{{trans('file.BRANCH NAME')}} </strong> </label>
                                        <input type="text" name="branchname" required class="form-control" placeholder="BRANCH NAME" value="">
                                    </div>
                                    <div class="form-group">                                       
                                        <input class="mt-2" type="checkbox" name="is_kyc_verified" id="is_kyc_verified" value="0">
                                        
                                        <label class="mt-2"><strong>{{trans('file.Verify Kyc')}}</strong></label>
                                    </div>
                                    <div class="form-group">
                                        
                                        <input class="mt-2" type="checkbox" name="is_active" id="is_active"  value="0">                                       
                                        <label class="mt-2"><strong>{{trans('file.Active')}}</strong></label>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <label><strong>{{trans('file.Business Name')}}</strong></label>
                                         <input type="text" name="business_name" class="form-control" value=""> 
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Seller Name')}}</strong></label>
                                        <input type="text" name="seller_name" class="form-control" value=""> 
                                    </div> 
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Company Name')}}</strong></label>
                                        <input type="text" name="company_name" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Role')}} *</strong></label>
                                        <input type="hidden" name="role_id_hidden" value="{{$lims_user_data->role_id}}">
                                        <select name="role_id" required class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Role...">
                                          @foreach($lims_role_list as $role)
                                              <option value="{{$role->id}}" {{ $lims_user_data->role_id == $role->id ? 'selected' : '' }}>{{$role->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="areaofinterest-id">
                                        <label><strong>{{trans('file.Business area of interest')}}</strong></label>
                                        <input type="hidden" name="areaofinterest_hidden" value="{{$lims_user_data->biller_id}}">
                                        <select name="areaofinterest" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select Business area of interest...">                                          
                                          <option value="Wholesale Selling to Rollo" >Wholesale Selling to Rollo</option>
                                        <option value="Rollo Marketplace" >Rollo Marketplace</option>
                                        <option value="Rollo Travels" >Rollo Travels</option> 
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label><strong>{{trans('file.BILLING ADDRESS')}} </strong>(Same as Pick Address)  <input type="checkbox" name="add" id="chkAdd" class="sameaddress"></label>                                     
                                        <input type="text" name="baddress1" id="baddress1"  placeholder="Address Line 1" class="form-control" value=""> 
                                    </div>
                                   
                                    <div class="form-group">
                                        <label><strong>{{trans('file.BILLING ADDRESS 2')}} </strong></label>                                     
                                        <input type="text" name="baddress2" id="baddress2" placeholder="Address Line 2" class="form-control" value=""> 
                                    </div>
                                    
                                <div class="form-group" id="bcountry-id">
                                        <label><strong>{{trans('file.Country')}}</strong></label>
                                        <input type="hidden" name="bcountry_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                        <select name="bcountry"  id="bcountry" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select country...">
                                          {{-- @foreach($lims_biller_list as $biller)
                                              <option value="{{$biller->id}}">{{$biller->name}}</option>
                                          @endforeach --}}
                                          <option value="1" >India</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="bstate-id">
                                        <label><strong>{{trans('file.State/Province')}}</strong></label>
                                        <input type="hidden" name="bstate_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                        <select name="bstate" id="bstate" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select state/province...">
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}" >{{$state->name}}</option>
                                        @endforeach                                          
                                        </select>
                                    </div>
                                    <div class="form-group" id="bdistrict-id">
                                        <label><strong>{{trans('file.District')}}</strong></label>
                                        <input type="hidden" name="bdistrict_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                        <select name="bdistrict" id="bdistrict" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select district...">
                                        @foreach($bdistricts as $district)
                                              <option value="{{$district->id}}" >{{$district->name}}</option>
                                          @endforeach                                          
                                        </select>
                                    </div>
                                  
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Zip/Postal Code')}} </strong></label>                                     
                                        <input type="text" name="bzipcode" id="bzipcode" placeholder="Zip/Postal Code" class="form-control" value=""> 
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Upload PAN Card')}} </strong></label>                                     
                                        <input class="form-control" type="file" name="panno_image" placeholder="">

                                    </div>

                                    <div class="form-group">
                                        <label><strong>{{trans('file.Upload Citizenship')}} </strong></label>                                     
                                        <input class="form-control" type="file" name="citizenship_document" placeholder="">  
                                    </div>

                                    <div class="form-group">
                                        <label><strong>{{trans('file.Upload Passport Size Photo')}} </strong></label>                                     
                                        <input class="form-control" type="file" name="passportsizephoto" placeholder="">  
                                    </div>

                                    <div class="form-group">
                                        <label><strong>{{trans('file.Upload GST')}} </strong></label>                                     
                                        <input class="form-control" type="file" name="gst_document" placeholder="">  
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.UPLOAD CANCELLED CHEQUE')}} </strong></label>                                     
                                        <input class="form-control" type="file" name="check_image" placeholder="">  
                                    </div>                                    
                                </div>                              
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                @else
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
                                            <input type="radio" style="margin-top: 5px;" class="account_type" name="account_type" {{ old('aacount_type', $seller->aacount_type) == "business" ? 'checked' : '' }} value="business">&nbsp; Business &nbsp;&nbsp;
                                            <input type="radio" style="margin-top: 5px;" class="account_type" name="account_type" {{ old('aacount_type', $seller->aacount_type) == "personal" ? 'checked' : '' }} value="personal">&nbsp;Personal
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
                                            <input type="text" name="address1" id="address1" required class="form-control" placeholder="Address Line 1" value="{{$seller->address_1}}">
                                        </div>

                                        <div class="form-group">
                                            <label><strong>{{trans('file.Address Line 2')}}</strong> </label>
                                            <input type="text" name="address2" id="address2" required class="form-control" placeholder="Address Line 2" value="{{$seller->address_2}}">
                                        </div>

                                        <div class="form-group" id="country-id">
                                            <label><strong>{{trans('file.Country')}}</strong></label>
                                            <input type="hidden" name="country_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                            <select name="country" id="country" class="selectpicker form-control" data-live-search="true" 
                                            data-live-search-style="begins" title="Select country...">
                                            {{-- @foreach($lims_biller_list as $biller)
                                                <option value="{{$biller->id}}">{{$biller->name}}</option>
                                            @endforeach --}}
                                            <option value="1" {{ old('country', $seller->country) == "1" ? 'selected' : '' }}>India</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="state-id">
                                            <label><strong>{{trans('file.State/Province')}}</strong></label>
                                            <input type="hidden" name="state_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                            <select name="state" id="state" class="selectpicker form-control" data-live-search="true" 
                                            data-live-search-style="begins" title="Select state/province...">
                                                @foreach($states as $state)
                                                    <option value="{{$state->id}}" {{ old('id', $seller->state->id) == $state->id ? 'selected' : '' }}>{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group" id="district-id">
                                            <label><strong>{{trans('file.District')}}</strong></label>
                                            <input type="hidden" name="district_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                            <select name="district" id="district" class="selectpicker form-control" data-live-search="true" 
                                            data-live-search-style="begins" title="Select district...">
                                            @foreach($districts as $district)
                                                <option value="{{$district->id}}" {{ old('id', $seller->district->id) == $district->id ? 'selected' : '' }}>{{$district->name}}</option>
                                            @endforeach                                        
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Zip/Postal Code')}} </strong> </label>
                                            <input type="text" name="zipcode" id="zipcode" required class="form-control" placeholder="Zip/Postal Code" value="{{$seller->zip_code}}">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Citizen Number')}} </strong> </label>
                                            <input type="text" name="citizennumber" required class="form-control" placeholder="Citizen Number" value="{{$seller->citizennumber}}">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label><strong>{{trans('file.PAN Number')}} </strong> </label>
                                            <input type="text" name="panno" required class="form-control" placeholder="PAN Number" value="{{$seller->panno}}">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Vat Number')}} </strong> </label>
                                            <input type="text" name="vatno" required class="form-control" placeholder="Vat Number" value="{{$seller->vatno}}">
                                        </div>
                                    
                                        <div class="form-group">
                                            <label><strong>{{trans('file.CST/GST Number')}} </strong> </label>
                                            <input type="text" name="gstno" required class="form-control" placeholder="CST/GST Number" value="{{$seller->gstno}}">
                                        </div>
                                    
                                        <div class="form-group">
                                            <label><strong>{{trans('file.BANK ACCOUNT NAME')}} </strong> </label>
                                            <input type="text" name="bankaccountname" required class="form-control" placeholder="BANK ACCOUNT NAME" value="{{$seller->bankaccountname}}">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>{{trans('file.BANK NAME')}} </strong> </label>
                                            <input type="text" name="bankname" required class="form-control" placeholder="BANK NAME" value="{{$seller->bankname}}">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>{{trans('file.ACCOUNT NUMBER')}} </strong> </label>
                                            <input type="text" name="accountnumber" required class="form-control" placeholder="ACCOUNT NUMBER" value="{{$seller->accountnumber}}">
                                        </div>                      
                                        <div class="form-group">
                                            <label><strong>{{trans('file.BRANCH NAME')}} </strong> </label>
                                            <input type="text" name="branchname" required class="form-control" placeholder="BRANCH NAME" value="{{$seller->branchname}}">
                                        </div>
                                        <div class="form-group">
                                            @if($seller->is_kyc_verified)
                                            <input class="mt-2" type="checkbox" name="is_kyc_verified" id="is_kyc_verified" value="1" checked>
                                            @else
                                            <input class="mt-2" type="checkbox" name="is_kyc_verified" id="is_kyc_verified" value="0">
                                            @endif
                                            <label class="mt-2"><strong>{{trans('file.Verify Kyc')}}</strong></label>
                                        </div>
                                        <div class="form-group">
                                            @if($seller->is_active)
                                            <input class="mt-2" type="checkbox" name="is_active"  id="is_active" value="1" checked>
                                            @else
                                            <input class="mt-2" type="checkbox" name="is_active" id="is_active"  value="0">
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
                                            <input type="text" name="business_name" class="form-control" value="{{$seller->business_name}}"> 
                                        </div>
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Seller Name')}}</strong></label>
                                            <input type="text" name="seller_name" class="form-control" value="{{$seller->seller_name}}"> 
                                        </div> 
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Company Name')}}</strong></label>
                                            <input type="text" name="company_name" class="form-control" value="{{$seller->company_name}}">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Role')}} *</strong></label>
                                            <input type="hidden" name="role_id_hidden" value="{{$lims_user_data->role_id}}">
                                            <select name="role_id" required class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Role...">
                                            @foreach($lims_role_list as $role)
                                                <option value="{{$role->id}}" {{ $lims_user_data->role_id == $role->id ? 'selected' : '' }}>{{$role->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group" id="areaofinterest-id">
                                            <label><strong>{{trans('file.Business area of interest')}}</strong></label>
                                            <input type="hidden" name="areaofinterest_hidden" value="{{$lims_user_data->biller_id}}">
                                            <select name="areaofinterest" class="selectpicker form-control" data-live-search="true" 
                                            data-live-search-style="begins" title="Select Business area of interest...">                                          
                                            <option value="Wholesale Selling to Rollo" {{ $seller->areaofinterest == "Wholesale Selling to Rollo" ? 'selected' : '' }}>Wholesale Selling to Rollo</option>
                                            <option value="Rollo Marketplace" {{ $seller->areaofinterest == "Rollo Marketplace" ? 'selected' : '' }}>Rollo Marketplace</option>
                                            <option value="Rollo Travels" {{ $seller->areaofinterest == "Rollo Travels" ? 'selected' : '' }}>Rollo Travels</option> 
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label><strong>{{trans('file.BILLING ADDRESS')}} </strong>(Same as Pick Address)  <input type="checkbox" id="chkAdd" name="add" class="sameaddress"></label>                                     
                                            <input type="text" name="baddress1" id="baddress1"  placeholder="Address Line 1" class="form-control" value="{{$seller->baddress1}}"> 
                                        </div>
                                    
                                        <div class="form-group">
                                            <label><strong>{{trans('file.BILLING ADDRESS 2')}} </strong></label>                                     
                                            <input type="text" name="baddress2" id="baddress2" placeholder="Address Line 2" class="form-control" value="{{$seller->baddress2}}"> 
                                        </div>
                                        
                                    <div class="form-group" id="bcountry-id">
                                            <label><strong>{{trans('file.Country')}}</strong></label>
                                            <input type="hidden" name="bcountry_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                            <select name="bcountry"  id="bcountry" class="selectpicker form-control" data-live-search="true" 
                                            data-live-search-style="begins" title="Select country...">
                                            {{-- @foreach($lims_biller_list as $biller)
                                                <option value="{{$biller->id}}">{{$biller->name}}</option>
                                            @endforeach --}}
                                            <option value="1" {{ old('bcountry', $seller->bcountry) == "1" ? 'selected' : '' }}>India</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="bstate-id">
                                            <label><strong>{{trans('file.State/Province')}}</strong></label>
                                            <input type="hidden" name="bstate_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                            <select name="bstate" id="bstate" class="selectpicker form-control" data-live-search="true" 
                                            data-live-search-style="begins" title="Select state/province...">
                                            @foreach($states as $state)
                                                <option value="{{$state->id}}" {{ old('id', $seller->bstate->id) == $state->id ? 'selected' : '' }}>{{$state->name}}</option>
                                            @endforeach                                          
                                            </select>
                                        </div>
                                        <div class="form-group" id="bdistrict-id">
                                            <label><strong>{{trans('file.District')}}</strong></label>
                                            <input type="hidden" name="bdistrict_hidden" value="{{--{{$lims_user_data->biller_id}}--}}">
                                            <select name="bdistrict" id="bdistrict" class="selectpicker form-control" data-live-search="true" 
                                            data-live-search-style="begins" title="Select district...">
                                            @foreach($bdistricts as $district)
                                                <option value="{{$district->id}}" {{ old('id', $seller->bdistrict->id) == $district->id ? 'selected' : '' }}>{{$district->name}}</option>
                                            @endforeach                                          
                                            </select>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Zip/Postal Code')}} </strong></label>                                     
                                            <input type="text" name="bzipcode" id="bzipcode" placeholder="Zip/Postal Code" class="form-control" value="{{$seller->bzipcode}}"> 
                                        </div>
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Upload PAN Card')}} </strong></label>                                     
                                            <input class="form-control" type="file" name="panno_image" placeholder="">

                                        </div>

                                        <div class="form-group">
                                            <label><strong>{{trans('file.Upload Citizenship')}} </strong></label>                                     
                                            <input class="form-control" type="file" name="citizenship_document" placeholder="">  
                                        </div>

                                        <div class="form-group">
                                            <label><strong>{{trans('file.Upload Passport Size Photo')}} </strong></label>                                     
                                            <input class="form-control" type="file" name="passportsizephoto" placeholder="">  
                                        </div>

                                        <div class="form-group">
                                            <label><strong>{{trans('file.Upload GST')}} </strong></label>                                     
                                            <input class="form-control" type="file" name="gst_document" placeholder="">  
                                        </div>
                                        <div class="form-group">
                                            <label><strong>{{trans('file.UPLOAD CANCELLED CHEQUE')}} </strong></label>                                     
                                            <input class="form-control" type="file" name="check_image" placeholder="">  
                                        </div>
                                    </div>                              
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                @endif

                

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

    <script type="text/javascript">
    $(document).ready(function () {

        $('#genbutton').on("click", function(){
            $.get('genpass', function(data){
                $("input[name='password']").val(data);
            });
        });

       $('#state').on('change', function() {
           var state_id = $(this).val();
            var html_district = "";
           $.ajax({
               url: "{{ route('get-districts') }}",
               type: "GET",
               data: { state_id: state_id },
               success: function(response) {
                   if(response.length >= 1)
                   {
                    //console.log(response);
                    $('#district').find('option').remove();
                    //$("#chapter_id").remove();
                    var html_option = "";                    
                       for(var i=0; i<response.length; i++)
                       {
                            var id = response[i].id;
                            var name = response[i].name;

                            html_option += '<option value="'+id+'">'+name+'</option>';
                       }
                       $("#district").append(html_option);
                       $('.selectpicker').selectpicker('refresh');
                   }
               }
           });
       });


       $('#bstate').on('change', function() {
           var state_id = $(this).val();
            var html_district = "";
           $.ajax({
               url: "{{ route('get-districts') }}",
               type: "GET",
               data: { state_id: state_id },
               success: function(response) {
                   if(response.length >= 1)
                   {
                    //console.log(response);
                    $('#bdistrict').find('option').remove();
                    //$("#chapter_id").remove();
                    var html_option = "";                    
                       for(var i=0; i<response.length; i++)
                       {
                            var id = response[i].id;
                            var name = response[i].name;

                            html_option += '<option value="'+id+'">'+name+'</option>';
                       }
                       $("#bdistrict").append(html_option);
                       $('.selectpicker').selectpicker('refresh');
                   }
               }
           });
       });

       $('#chkAdd').on('click', function() {
           if($(this).prop('checked') === true || $(this).is(":checked") === true)
           {
               $('#baddress1').val($('#address1').val());
               $('#baddress2').val($('#address2').val());
               $('#bcountry option:selected').text($('#country option:selected').text());
               $('#bcountry option:selected').val($('#country option:selected').val());               
               $('#bstate option:selected').text($('#state option:selected').text());
               $('#bstate option:selected').val($('#state option:selected').val());
               $('#bdistrict option:selected').text($('#district option:selected').text());
               $('#bdistrict option:selected').val($('#district option:selected').val());
               $('.selectpicker').selectpicker('refresh');
               $('#bzipcode').val($('#zipcode').val());
           }
       });

       $('#is_kyc_verified').on('click', function() {
           if($(this).prop('checked') === true || $(this).is(":checked") === true)
            {
                $(this).val('1');
            }
            else
            {
                $(this).val('0');
            }
       });

       $('#is_active').on('click', function() {
           if($(this).prop('checked') === true || $(this).is(":checked") === true)
            {
                $(this).val('1');
            }
            else
            {
                $(this).val('0');
            }
       });
   });
</script>

</script>
@endsection