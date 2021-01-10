@extends('layout.main') @section('content')

@if(empty($transactions))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{'No Data exist between this date range!'}}</div>
@endif

    <section class="forms">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header mt-2">
                <h3 class="text-center">{{trans('file.Transaction Report')}}</h3>
            </div>
            {!! Form::open(['route' => 'stransaction.store', 'method' => 'post']) !!}
            <div class="row mb-3">
                <div class="col-md-4 offset-md-1 mt-4">
                    <div class="form-group row">
                        <label class="d-tc mt-2"><strong>{{trans('file.Choose Your Date')}}</strong> &nbsp;</label>
                        <div class="d-tc">
                            <div class="input-group">
                                <input type="text" class="daterangepicker-field form-control" value="" required />
                                <input type="hidden" name="start_date" value="" />
                                <input type="hidden" name="end_date" value="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="form-group row">
                        <label class="d-tc mt-2"><strong>{{trans('file.Choose Seller')}}</strong> &nbsp;</label>
                        <div class="d-tc">
                            <input type="hidden" name="warehouse_id_hidden" value="" />
                            <select id="seller_id" name="seller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" >
                                <option value="0">{{trans('file.All Seller')}}</option>
                                @foreach($sellers as $seller)
                                <option value="{{$seller->id}}">{{$seller->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">{{trans('file.submit')}}</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div> 
    <div class="table-responsive">
        <table id="report-table" class="table table-hover">
            <thead>
                <tr>                    
                    <th>{{trans('file.Seller Name')}}</th>
                    <th>{{trans('file.Invoice Id')}}</th>
                    <th>{{trans('file.Invoice Date')}}</th>
                    <th>{{trans('file.Commision')}}</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($transactions))
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction['seller_name'] }}</td>
                    <td>{{ $transaction['invoice_id'] }}</td>
                    <td>{{ $transaction['invoice_date'] }}</td>
                    <td>{{ $transaction['commission'] }}</td>                                        
                </tr>
                @endforeach
                @endif
            </tbody>
            
        </table>
    </div>   
</section>
   

@endsection