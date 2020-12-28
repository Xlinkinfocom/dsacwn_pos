@extends('layout.main') @section('content')
<section>
        {{-- @if(in_array("users-add", $all_permission)) --}}
            <div class="container-fluid">
                <a href="{{route('package.create')}}" class="btn btn-info"><i class="dripicons-plus"></i> {{trans('file.Add Plan')}}</a>
            </div>
        {{-- @endif --}}
        <div class="table-responsive">
            <table id="user-table" class="table sale-list dataTable">
                <thead>
                    <tr>
                       
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Commission (%)</th>
                        <th>Payment Fee (%)</th>   
                        <th>Vat (%)</th>   
                        <th>Total Commission (%)</th>                     
                        <th>{{trans('file.Status')}}</th>
                        <th class="not-exported">{{trans('file.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($CommissionMst as $index => $Commission)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$Commission['categoryName']}}</td>
                            <td>{{$Commission['commssion']}}</td>
                            <td>{{$Commission['payment_fee']}}</td>
                            <td>{{$Commission['vat']}}</td>
                            <td>{{$Commission['total_commission']}}</td>
                        @if($Commission->is_active)
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
                                        <a href="{{ route('package.edit', $Commission['commission_id']) }}" class="btn btn-link"><i class="dripicons-document-edit"></i> {{trans('file.edit')}}</a>
                                    </li>
                                    {{-- @endif --}}
                                    <li class="divider"></li>
                                    {{-- @if(in_array("users-delete", $all_permission)) --}}
                                    {{ Form::open(['route' => ['package.destroy', $Commission['commission_id'], 'method' => 'DELETE'] ) }}
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