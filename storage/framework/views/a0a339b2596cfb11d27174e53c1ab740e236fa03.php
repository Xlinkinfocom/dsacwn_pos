 <?php $__env->startSection('content'); ?>
<section>
        
            <div class="container-fluid">
                <a href="<?php echo e(route('managecommission.create')); ?>" class="btn btn-info"><i class="dripicons-plus"></i> <?php echo e(trans('file.Add Commission')); ?></a>
            </div>
        
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
                        <th><?php echo e(trans('file.Status')); ?></th>
                        <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $CommissionMst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $Commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($Commission['categoryName']); ?></td>
                            <td><?php echo e($Commission['commssion']); ?></td>
                            <td><?php echo e($Commission['payment_fee']); ?></td>
                            <td><?php echo e($Commission['vat']); ?></td>
                            <td><?php echo e($Commission['total_commission']); ?></td>
                        <?php if($Commission['is_active']): ?>
                        <td><div class="badge badge-success">Active</div></td>
                        <?php else: ?>
                        <td><div class="badge badge-danger">Inactive</div></td>
                        <?php endif; ?>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('file.action')); ?>

                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                    
                                    <li>
                                        <a href="<?php echo e(route('managecommission.edit', $Commission['commission_id'])); ?>" class="btn btn-link"><i class="dripicons-document-edit"></i> <?php echo e(trans('file.edit')); ?></a>
                                    </li>
                                    
                                    <li class="divider"></li>
                                    
                                    <?php echo e(Form::open(['route' => ['managecommission.destroy', $Commission['commission_id']], 'method' => 'DELETE'] )); ?>                                    
                                    <li>
                                        <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> <?php echo e(trans('file.delete')); ?></button>
                                    </li>
                                    <?php echo e(Form::close()); ?>

                                    
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>
    






    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>