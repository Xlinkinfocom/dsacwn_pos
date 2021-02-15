 <?php $__env->startSection('content'); ?>
<?php if(session()->has('message1')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('message1'); ?></div> 
<?php endif; ?>
<?php if(session()->has('message2')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message2')); ?></div> 
<?php endif; ?>
<?php if(session()->has('message3')): ?>
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message3')); ?></div> 
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>

<section>
    <?php if(in_array("users-add", $all_permission)): ?>
        <div class="container-fluid">
            <a href="<?php echo e(route('user.create')); ?>" class="btn btn-info"><i class="dripicons-plus"></i> <?php echo e(trans('Add User')); ?></a>
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table id="user-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('UserName')); ?></th>
                    <th><?php echo e(trans('Email')); ?></th>
                    <th><?php echo e(trans('Company Name')); ?></th>
                    <th><?php echo e(trans('Phone Number')); ?></th>
                    <th><?php echo e(trans('Role')); ?></th>
                    <th><?php echo e(trans('Status')); ?></th>
                    <th class="not-exported"><?php echo e(trans('Action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $lims_user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr data-id="<?php echo e($user->id); ?>">
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td><?php echo e($user->company_name); ?></td>
                    <td><?php echo e($user->phone); ?></td>
                    <?php $role = DB::table('roles')->find($user->role_id);?>
                    <td><?php echo e($role->name); ?></td>
                    <?php if($user->is_active): ?>
                    <td><div class="badge badge-success">Active</div></td>
                    <?php else: ?>
                    <td><div class="badge badge-danger">Inactive</div></td>
                    <?php endif; ?>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('Action')); ?>

                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <?php if(in_array("users-edit", $all_permission)): ?>
                                <li>
                                	<a href="<?php echo e(route('seller.edit', ['id' => $user->id])); ?>" class="btn btn-link"><i class="dripicons-document-edit"></i> <?php echo e(trans('Edit')); ?></a>
                                </li>
                                <?php endif; ?>
                               
                                <li>
                                	<a href="<?php echo e(route('seller.login', ['id' => $user->id])); ?>" class="btn btn-link"><i class="dripicons-document-edit"></i> <?php echo e(trans('Login')); ?></a>
                                </li>

                                <span id="status<?php echo e($user->id); ?>">
                                    <?php if($user->is_active==1){?>
                                        <a href="javascript:GetSellerStatus('<?php echo $user->id; ?>','<?php echo $user->is_active; ?>');" class="btn btn-success">Active </a>&emsp;
                                    <?php } else{?>
                                        <a href="javascript:GetSellerStatus('<?php echo $user->id; ?>','<?php echo $user->is_active; ?>');" class="btn btn-warning" >Inactive </a>&emsp;
                                    <?php } ?>
                                </span>
                               
                                <li class="divider"></li>
                                <?php if(in_array("users-delete", $all_permission)): ?>
                                <?php echo e(Form::open(['route' => ['seller.destroy', $user->id], 'method' => 'DELETE'] )); ?>

                                <li>
                                    <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> <?php echo e(trans('Delete')); ?></button>
                                </li>
                                <?php echo e(Form::close()); ?>

                                <?php endif; ?>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</section>

<script type="text/javascript">

    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");
    $("ul#people #user-list-menu").addClass("active");

    var user_id        = [];
    var user_verified  = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    var all_permission = <?php echo json_encode($all_permission) ?>;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var Inactive = 0;
    var Active   = 1;
    function GetSellerStatus(id,is_active) {
        $.ajax({
            type: "post",
            url: '<?php echo e(route('get-status')); ?>',
            data: {
                _token: '<?php echo csrf_token();?>',
                id: id,
                is_active:is_active
            },
            success: function (data) {
                var resp = JSON.parse(data);
                $('#status'+resp.id).html(resp.html);
                $(document).find('.child #status'+resp.id).html(resp.html);
            }
        });
    }

	function confirmDelete() {
	    if (confirm("Are you sure want to delete?")) {
	        return true;
	    }
	    return false;
	}

    $('#user-table').DataTable( {
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
                'targets': [0, 7]
            },
            {
                'render': function(data, type, row, meta){
                    if(type === 'display'){
                        data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                    }

                   return data;
                },
                'checkboxes': {
                   'selectRow': true,
                   'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                },
                'targets': [0]
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                text: '<?php echo e(trans("file.PDF")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'csv',
                text: '<?php echo e(trans("file.CSV")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'print',
                text: '<?php echo e(trans("file.Print")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                text: '<?php echo e(trans("file.delete")); ?>',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    if(user_verified == '1') {
                        user_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                user_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(user_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'user/deletebyselection',
                                data:{
                                    userIdArray: user_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!user_id.length)
                            alert('No user is selected!');
                    }
                    else
                        alert('This feature is disable for demo!');
                }
            },
            {
                extend: 'colvis',
                text: '<?php echo e(trans("file.Column visibility")); ?>',
                columns: ':gt(0)'
            },
        ],
    } );

    if(all_permission.indexOf("users-delete") == -1)
        $('.buttons-delete').addClass('d-none');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>