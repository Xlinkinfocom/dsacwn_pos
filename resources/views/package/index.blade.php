@extends('layout.main') @section('content')
@if(session()->has('message1'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message1') !!}</div> 
@endif
@if(session()->has('message2'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message2') }}</div> 
@endif
@if(session()->has('message3'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message3') }}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif

    <div class="content-area py-1">
        <div class="container-fluid">
            
            <div class="box box-block bg-white">
                <h5 class="mb-1">Credit Package</h5>
                {{-- <a href="{{ route('admin.credit.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Package</a> --}}
                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>No. of Credit</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($credit_packages as $index => $credit_package)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$credit_package->name}}</td>
                            <td>{{$credit_package->face_value}}</td>
                            <th>{{$credit_package->cost}}</th>
                            <td>
                                <a href="{{ route('package.index', $credit_package->credit_package_id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                                {{-- <form action="{{ route('admin.credit.destroy', $credit_package->credit_package_id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</button>
                                </form> --}}
                            </td>
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
    </div>
