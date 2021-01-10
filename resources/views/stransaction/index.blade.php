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
    @if($role_id != '7')
        <div class="table-responsive">
            <table id="report-table" class="table table-hover">
                <thead>
                    <tr>                    
                        <th>{{trans('file.Seller Name')}}</th>
                        <th>{{trans('file.Invoice Id')}}</th>
                        <th>{{trans('file.Invoice Date')}}</th>
                        <th>{{trans('file.Sale Amount')}}</th>
                        <th>{{trans('file.Commision')}}</th>
                        <th>{{trans('file.Commision Amount')}}</th>
                        <th>{{trans('file.Payable Amount')}}</th>
                        <th>{{trans('file.Paid Mode')}}</th>
                        <th>{{trans('file.Seller Pay Status')}}</th>
                        
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
                        <td>{{ $transaction['invoice_date'] }}</td>
                        <td>{{ $transaction['sale_amount'] }}</td>                        
                        <td>{{ $transaction['commission'] }}</td>
                        <td>{{ $transaction['commission_amt'] }}</td>
                        <td>{{ $transaction['payable_amount'] }}</td>
                        <td>{{ $transaction['paid_mode'] }}</td>
                        <td>{{ $transaction['payable_status'] }}</td>
                        <td>{{ $transaction['sale_id'] }}</td>
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
                    <th>{{trans('file.Seller Name')}}</th>
                    <th>{{trans('file.Invoice Id')}}</th>
                    <th>{{trans('file.Invoice Date')}}</th>
                    <th>{{trans('file.Sale Amount')}}</th>                   
                    <th>{{trans('file.Payable Amount')}}</th>                    
                    <th>{{trans('file.Seller Pay Status')}}</th>
                    
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
                    <td>{{ $transaction['invoice_date'] }}</td>
                    <td>{{ $transaction['sale_amount'] }}</td>            
                    <td>{{ $transaction['payable_amount'] }}</td>                    
                    <td>{{ $transaction['payable_status'] }}</td>
                    <td>{{ $transaction['sale_id'] }}</td>
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
             "info":      '<small>{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
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

    

$(".daterangepicker-field").daterangepicker({
  callback: function(startDate, endDate, period){
    var start_date = startDate.format('YYYY-MM-DD');
    var end_date = endDate.format('YYYY-MM-DD');
    var title = start_date + ' To ' + end_date;
    $(this).val(title);
    $('input[name="start_date"]').val(start_date);
    $('input[name="end_date"]').val(end_date);
  }
});

</script>
   

@endsection