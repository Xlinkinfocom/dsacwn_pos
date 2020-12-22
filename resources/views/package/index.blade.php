@extends('layout.main') @section('content')
{{-- 
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif

    <div class="content-area py-1">
        <div class="container-fluid">
            
            <div class="box box-block bg-white">
                <h5 class="mb-1">Credit Package</h5> --}}
                {{-- <a href="{{ route('admin.credit.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Package</a> --}}
                {{-- <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($credit_packages as $index => $credit_package)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$credit_package->name}}</td>
                            <td>{{$credit_package->description}}</td>
                            <th>{{$credit_package->cost}}</th>
                            <td>
                                <a href="{{ route('package.edit', $credit_package->credit_package_id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                                {{-- <form action="{{ route('admin.credit.destroy', $credit_package->credit_package_id) }}" method="POST"> --}}
                                    {{-- {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</button>
                                </form> --}}
                            {{-- </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>No. of Credit</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div> --}}

 



    <section>
        {{-- @if(in_array("users-add", $all_permission)) --}}
            <div class="container-fluid">
                <a href="{{route('user.create')}}" class="btn btn-info"><i class="dripicons-plus"></i> {{trans('file.Add User')}}</a>
            </div>
        {{-- @endif --}}
        <div class="table-responsive">
            <table id="user-table" class="table">
                <thead>
                    <tr>
                       
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>                        
                        <th>{{trans('file.Status')}}</th>
                        <th class="not-exported">{{trans('file.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($credit_packages as $index => $credit_package)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$credit_package->name}}</td>
                            <td>{{$credit_package->description}}</td>
                            <th>{{$credit_package->cost}}</th>
                        @if($credit_package->is_active)
                        <td><div class="badge badge-success">Active</div></td>
                        @else
                        <td><div class="badge badge-danger">Inactive</div></td>
                        @endif
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans('file.action')}}
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                    {{-- @if(in_array("users-edit", $all_permission)) --}}
                                    <li>
                                        <a href="{{ route('package.edit', $credit_package->credit_package_id) }}" class="btn btn-link"><i class="dripicons-document-edit"></i> {{trans('file.edit')}}</a>
                                    </li>
                                    {{-- @endif --}}
                                    <li class="divider"></li>
                                    {{-- @if(in_array("users-delete", $all_permission)) --}}
                                    {{ Form::open(['route' => ['package.destroy', $credit_package->credit_package_id], 'method' => 'DELETE'] ) }}
                                    <li>
                                        <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> {{trans('file.delete')}}</button>
                                    </li>
                                    {{ Form::close() }}
                                    {{-- @endif --}}
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    






    @endsection