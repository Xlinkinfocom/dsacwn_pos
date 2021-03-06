@extends('layout.main') @section('content')

@if(empty($transactions))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{'No Data exist between this date range!'}}</div>
@endif

<section class="forms">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header mt-2">
                <h3 class="text-center">{{ trans('Seller Transaction Report') }}</h3>
            </div>
            {!! Form::open(['route' => 'stransaction.store', 'method' => 'post']) !!}
            <div class="row md-12" style="margin-left: 7px; !important;">
                <div class="col-md-3 mt-4">
                    <div class="form-group">
                        <select name="seller_id" id="seller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Choose Seller">
                        @foreach($sellers as $seller)
                            <option value="{{ $seller->id }}">{{  $seller->name }}</option>
                        @endforeach
                        </select>
                    </div>                    
                </div>
                <div class="col-md-4 mt-4">
                    <div class="row">                        
                        <div class="d-tc">
                            <div class="input-group">
                                <input name="start_date" type="date" class="form-control" value=""  />
                                <input name="end_date" type="date" class="form-control" value=""  />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <div class="row">                        
                        <div class="d-tc">
                            <div class="input-group">
                                <select name="payment_type" id="payment_type" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Choose Payment type">
                                    <option value="Debit Card">Debit Card</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Gift Card">Gift Card</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Mix Payment">Mix Payment</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-2 mt-4">
                    <div class="form-group row">
                        <button class="btn btn-primary" type="submit">{{  trans('submit') }}</button>
                    </div>
                </div>               
            </div>
            {!! Form::close() !!}
        </div>
    </div> 
    @if($role_id != '7')
    <div class="table-responsive">
        <table id="report-table" class="table table-hover">
            <thead>
                <tr>
                    <th>{{ trans('Seller Name') }}</th>
                    <th>{{ trans('Invoice Id') }}</th>
                    <th>{{ trans('Invoice Date') }}</th>
                    <th>{{ trans('Sale Amount') }}</th>
                    <th>{{ trans('By Cash') }}</th>
                    <th>{{ trans('By Card') }}</th>
                    <th>{{ trans('Commision') }}</th>
                    <th>{{ trans('Commision Amount') }}</th>
                    <th>{{ trans('Payable Amount') }}</th>
                    <th>{{ trans('Paid Mode') }}</th>
                    <th>{{ trans('Seller Pay Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($transactions))
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>
                            <input type="hidden" name[]="sale_id" value="{{ $transaction['sale_id'] }}" />
                            {{ $transaction['seller_name'] }}
                        </td>
                        <td>{{ $transaction['invoice_id'] }}</td>
                        <td>{{ date('d-m-Y', strtotime($transaction['invoice_date'])) }}</td>
                        <td>{{ number_format($transaction['sale_amount'], 2) }}</td>
                        <td>{{ number_format($transaction['by_cash'], 2) }}</td>
                        <td>{{ number_format($transaction['by_card'], 2) }}</td>
                        <td>{{ $transaction['commission'] }}</td>
                        <td>{{ number_format($transaction['commission_amt'], 2) }}</td>
                        <td>{{ number_format($transaction['payable_amount'], 2) }}</td>
                        <td>{{ $transaction['paid_mode'] }}</td>
                        <td>
                            <a href="{{ route('paid-status', ['id' => $transaction['sale_id'], 'status' => $transaction['payable_status'] ]) }}" onclick="return confirm('Are you sure want to change status of this record?')" >
                                @if ( $transaction['payable_status'] == '0' )
                                        <span>Unpaid</span>
                                @elseif($transaction['payable_status'] == '1' && $transaction['paid_mode'] == 'Cash')
                                        <span>Cash Payment</span>
                                @else
                                        <span>Paid</span>
                                @endif
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    @else
    <div class="table-responsive">
        <table id="report-table" class="table table-hover">
            <thead>
                <tr>                    
                    <th>{{ trans('Seller Name') }}</th>
                    <th>{{ trans('Invoice Id') }}</th>
                    <th>{{ trans('Invoice Date') }}</th>
                    <th>{{ trans('Sale Amount') }}</th>
                    <th>{{ trans('By Cash') }}</th>
                    <th>{{ trans('By Card') }}</th>
                    <th>{{ trans('Payable Amount') }}</th>
                    <th>{{ trans('Paid Mode') }}</th>
                    <th>{{ trans('Seller Pay Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($transactions))
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>
                            <input type="hidden" name[]="sale_id" value="{{ $transaction['sale_id'] }}" />
                            {{ $transaction['seller_name'] }}
                        </td>
                        <td>{{ $transaction['invoice_id'] }}</td>
                        <td>{{ date('d-m-Y', strtotime($transaction['invoice_date'])) }}</td>
                        <td>{{ number_format($transaction['sale_amount'], 2) }}</td>
                        <td>{{ number_format($transaction['by_cash'], 2) }}</td>
                        <td>{{ number_format($transaction['by_card'], 2) }}</td>
                        <td>{{ number_format($transaction['payable_amount'], 2) }}</td>
                        <td>{{ $transaction['paid_mode'] }}</td>
                        <td>                            
                            @if ( $transaction['payable_status'] == '0' )
                                        <span>Unpaid</span>
                                @else
                                        <span>Paid</span>
                                @endif                            
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>            
        </table>
    </div>
    @endif
</section>

<script type="text/javascript">
    $("ul#report").siblings('a').attr('aria-expanded','true');
    $("ul#report").addClass("show");
    $("ul#report #sale-report-menu").addClass("active");
    $('#warehouse_id').val($('input[name="warehouse_id_hidden"]').val());
    $('.selectpicker').selectpicker('refresh');

    $('#report-table').DataTable( {
        "order": [],
        'language': {
            'lengthMenu': '_MENU_ {{trans("file.records per page")}}',
            "info":   '<small>{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
            "search":  '{{trans("file.Search")}}',
            'paginate': {
                'previous': '<i class="dripicons-chevron-left"></i>',
                'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        'columnDefs': [
            {
                "orderable": false,
                'targets': 0
            },
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                text: '{{trans("file.PDF")}}',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'csv',
                text: '{{trans("file.CSV")}}',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'print',
                text: '{{trans("file.Print")}}',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'colvis',
                text: '{{trans("file.Column visibility")}}',
                columns: ':gt(0)'
            }
        ],
    } );
</script>

@endsection