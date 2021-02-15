 <?php $__env->startSection('content'); ?>

<?php if(empty($transactions)): ?>
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e('No Data exist between this date range!'); ?></div>
<?php endif; ?>

<section class="forms">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header mt-2">
                <h3 class="text-center"><?php echo e(trans('Seller Transaction Report')); ?></h3>
            </div>
            <?php echo Form::open(['route' => 'stransaction.store', 'method' => 'post']); ?>

            <div class="row md-12" style="margin-left: 7px; !important;">
                <div class="col-md-3 mt-4">
                    <div class="form-group">
                        <select name="seller_id" id="seller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Choose Seller">
                        <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($seller->id); ?>"><?php echo e($seller->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>                    
                </div>
                <div class="col-md-3 mt-4">
                    <div class="row">
                        <label class="d-tc mt-2"><strong><?php echo e(trans('Date')); ?></strong> &nbsp;</label>
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
                                    <option value="Mix Payment">Mix Payment</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-3 mt-4">
                    <div class="form-group row">
                        <button class="btn btn-primary" type="submit"><?php echo e(trans('submit')); ?></button>
                    </div>
                </div>
                <div class="col-md-3 mt-4">

                </div>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div> 
    <?php if($role_id != '7'): ?>
    <div class="table-responsive">
        <table id="report-table" class="table table-hover">
            <thead>
                <tr>
                    <th><?php echo e(trans('Seller Name')); ?></th>
                    <th><?php echo e(trans('Invoice Id')); ?></th>
                    <th><?php echo e(trans('Invoice Date')); ?></th>
                    <th><?php echo e(trans('Sale Amount')); ?></th>
                    <th><?php echo e(trans('By Cash')); ?></th>
                    <th><?php echo e(trans('By Card')); ?></th>
                    <th><?php echo e(trans('Commision')); ?></th>
                    <th><?php echo e(trans('Commision Amount')); ?></th>
                    <th><?php echo e(trans('Payable Amount')); ?></th>
                    <th><?php echo e(trans('Paid Mode')); ?></th>
                    <th><?php echo e(trans('Seller Pay Status')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($transactions)): ?>
                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <input type="hidden" name[]="sale_id" value="<?php echo e($transaction['sale_id']); ?>" />
                            <?php echo e($transaction['seller_name']); ?>

                        </td>
                        <td><?php echo e($transaction['invoice_id']); ?></td>
                        <td><?php echo e(date('d-m-Y', strtotime($transaction['invoice_date']))); ?></td>
                        <td><?php echo e(number_format($transaction['sale_amount'], 2)); ?></td>
                        <td><?php echo e(number_format($transaction['by_cash'], 2)); ?></td>
                        <td><?php echo e(number_format($transaction['by_card'], 2)); ?></td>
                        <td><?php echo e($transaction['commission']); ?></td>
                        <td><?php echo e(number_format($transaction['commission_amt'], 2)); ?></td>
                        <td><?php echo e(number_format($transaction['payable_amount'], 2)); ?></td>
                        <td><?php echo e($transaction['paid_mode']); ?></td>
                        <td>
                            <a href="<?php echo e(route('paid-status', ['id' => $transaction['sale_id'], 'status' => $transaction['payable_status'] ])); ?>" onclick="return confirm('Are you sure want to change status of this record?')" >
                                <?php if( $transaction['payable_status'] == '0' ): ?>
                                        <span>Unpaid</span>
                                <?php else: ?>
                                        <span>Paid</span>
                                <?php endif; ?>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div class="table-responsive">
        <table id="report-table" class="table table-hover">
            <thead>
                <tr>                    
                    <th><?php echo e(trans('Seller Name')); ?></th>
                    <th><?php echo e(trans('Invoice Id')); ?></th>
                    <th><?php echo e(trans('Invoice Date')); ?></th>
                    <th><?php echo e(trans('Sale Amount')); ?></th>
                    <th><?php echo e(trans('By Cash')); ?></th>
                    <th><?php echo e(trans('By Card')); ?></th>
                    <th><?php echo e(trans('Payable Amount')); ?></th>
                    <th><?php echo e(trans('Paid Mode')); ?></th>
                    <th><?php echo e(trans('Seller Pay Status')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($transactions)): ?>
                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <input type="hidden" name[]="sale_id" value="<?php echo e($transaction['sale_id']); ?>" />
                            <?php echo e($transaction['seller_name']); ?>

                        </td>
                        <td><?php echo e($transaction['invoice_id']); ?></td>
                        <td><?php echo e(date('d-m-Y', strtotime($transaction['invoice_date']))); ?></td>
                        <td><?php echo e(number_format($transaction['sale_amount'], 2)); ?></td>
                        <td><?php echo e(number_format($transaction['by_cash'], 2)); ?></td>
                        <td><?php echo e(number_format($transaction['by_card'], 2)); ?></td>
                        <td><?php echo e(number_format($transaction['payable_amount'], 2)); ?></td>
                        <td><?php echo e($transaction['paid_mode']); ?></td>
                        <td>                            
                            <?php if( $transaction['payable_status'] == '0' ): ?>
                                        <span>Unpaid</span>
                                <?php else: ?>
                                        <span>Paid</span>
                                <?php endif; ?>                            
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>            
        </table>
    </div>
    <?php endif; ?>
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
            'lengthMenu': '_MENU_ <?php echo e(trans("file.records per page")); ?>',
            "info":   '<small><?php echo e(trans("file.Showing")); ?> _START_ - _END_ (_TOTAL_)</small>',
            "search":  '<?php echo e(trans("file.Search")); ?>',
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
                text: '<?php echo e(trans("file.PDF")); ?>',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'csv',
                text: '<?php echo e(trans("file.CSV")); ?>',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'print',
                text: '<?php echo e(trans("file.Print")); ?>',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'colvis',
                text: '<?php echo e(trans("file.Column visibility")); ?>',
                columns: ':gt(0)'
            }
        ],
    } );
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>