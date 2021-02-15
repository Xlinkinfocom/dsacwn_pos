<header class="header">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <a id="toggle-btn" href="#" class="menu-btn"><i class="fa fa-bars"> </i></a>
                <span class="brand-big"><?php if($general_setting->site_logo): ?><img src="<?php echo e(url('public/logo', $general_setting->site_logo)); ?>" width="50">&nbsp;&nbsp;<?php endif; ?>
                            <a href="<?php echo e(url('/')); ?>">
                                <h1 class="d-inline"><?php echo e($general_setting->site_title); ?></h1>
                            </a>
                        </span>
                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    <?php
                        $role = DB::table('roles')->find(Auth::user()->role_id);

                        $general_setting_permission = DB::table('permissions')->where('name', 'general_setting')->first();
                        $general_setting_permission_active = DB::table('role_has_permissions')->where([
                            ['permission_id', $general_setting_permission->id],
                            ['role_id', $role->id]
                        ])->first();

                        $add_permission = DB::table('permissions')->where('name', 'sales-add')->first();
                        $add_permission_active = DB::table('role_has_permissions')->where([
                            ['permission_id', $add_permission->id],
                            ['role_id', $role->id]
                            ])->first();

                        $empty_database_permission = DB::table('permissions')->where('name', 'empty_database')->first();
                        $empty_database_permission_active = DB::table('role_has_permissions')->where([
                            ['permission_id', $empty_database_permission->id],
                            ['role_id', $role->id]
                            ])->first();
                    ?>
                    <?php if($add_permission_active): ?>
                        <li class="nav-item"><a class="dropdown-item btn-pos btn-sm" href="<?php echo e(route('sale.pos')); ?>"><i class="dripicons-shopping-bag"></i><span> POS</span></a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a id="btnFullscreen"><i class="dripicons-expand"></i></a></li>
                    <?php if($alert_product > 0): ?>
                        <li class="nav-item">
                            <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item">
                                <i class="dripicons-bell"></i>
                                <span class="badge badge-danger"><?php echo e($alert_product); ?></span>
                            </a>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default notifications" user="menu">
                                <li class="notifications">
                                    <a href="<?php echo e(route('report.qtyAlert')); ?>" class="btn btn-link"> <?php echo e($alert_product); ?> product exceeds alert quantity</a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="dropdown-item" href="<?php echo e(url('read_me')); ?>" target="_blank"><i class="dripicons-information"></i> <?php echo e(trans('Help')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item">
                            <i class="dripicons-user"></i>
                            <span><?php echo e(ucfirst(Auth::user()->name)); ?></span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                            <li>
                                <?php if($role->id==7): ?>
                                    <a href="<?php echo e(route('user.profile', ['id' => Auth::id()])); ?>"><i class="dripicons-user"></i> <?php echo e(trans('User Profile')); ?></a>
                                    <a href="<?php echo e(route('seller.edit', ['id' => Auth::id()])); ?>"><i class="dripicons-user"></i> <?php echo e(trans('Business Profile')); ?></a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('user.profile', ['id' => Auth::id()])); ?>"><i class="dripicons-user"></i> <?php echo e(trans('Profile')); ?></a>
                                <?php endif; ?>
                            </li>
                            <?php if($general_setting_permission_active): ?>
                                <li>
                                    <a href="<?php echo e(route('setting.general')); ?>"><i class="dripicons-gear"></i> <?php echo e(trans('Settings')); ?></a>
                                </li>
                            <?php endif; ?>
                            <li>

                                <?php if(!empty($seller_id) && !empty($start_date) && !empty($end_date)): ?>
                                    <a href="<?php echo e(route('seller_transaction/' . $seller_id .'/'. $start_date .'/'. $end_date)); ?>"><i class="dripicons-swap"></i><?php echo e(trans('Seller Transaction')); ?></a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('seller_transaction')); ?>"><i class="dripicons-swap"></i><?php echo e(trans('Seller Transaction')); ?></a>
                                <?php endif; ?>
                            </li>
                            <li>
                                <a href="<?php echo e(url('holidays/my-holiday/'.date('Y').'/'.date('m'))); ?>"><i class="dripicons-vibrate"></i> <?php echo e(trans('My Holiday')); ?></a>
                            </li>
                            <?php if($empty_database_permission_active): ?>
                                <li>
                                    <a onclick="return confirm('Are you sure want to delete? If you do this all of your data will be lost.')" href="<?php echo e(route('setting.emptyDatabase')); ?>"><i class="dripicons-stack"></i> <?php echo e(trans('Empty Database')); ?></a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><i class="dripicons-power"></i>
                                    <?php echo e(trans('Logout')); ?>

                                </a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>