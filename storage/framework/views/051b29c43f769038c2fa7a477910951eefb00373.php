<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
            <?php
                $role = DB::table('roles')->find(Auth::user()->role_id);
                $user_id = Auth::user()->id;
                $check_is_subscribed = 0;
                if($role->id == '7' )
                {
                    $get_subscripe = DB::table('subscriptions')->select('expire_date')->where('user_id', $user_id)->first();
            ?>
            <?php if($get_subscripe): ?>
                <?php
                $current_time = date('Y-m-d H:i:s');
                $expire_date = date('Y-m-d H:i:s', strtotime($get_subscripe->expire_date));
                if($current_time > $expire_date)
                {
                    $check_is_subscribed = 0;
                }
                else {
                    $check_is_subscribed = 1;
                }
                ?>
            <?php else: ?>
                <?php $check_is_subscribed = 0; ?>
            <?php endif; ?>
            <?php } else {
                $check_is_subscribed = 1;
            }
            ?>
            <ul id="side-main-menu" class="side-menu list-unstyled">
                <li><a href="<?php echo e(url('/')); ?>"> <i class="dripicons-meter"></i><span><?php echo e(__('file.dashboard')); ?></span></a></li>
                <li><div id="google_translate_element"></div></li>
                <?php
                    $role = DB::table('roles')->find(Auth::user()->role_id);

                    $index_permission = DB::table('permissions')->where('name', 'products-index')->first();
                    $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();

                    $print_barcode = DB::table('permissions')->where('name', 'print_barcode')->first();
                    $print_barcode_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $print_barcode->id],
                        ['role_id', $role->id]
                    ])->first();

                    $stock_count = DB::table('permissions')->where('name', 'stock_count')->first();
                    $stock_count_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $stock_count->id],
                        ['role_id', $role->id]
                    ])->first();

                    $adjustment = DB::table('permissions')->where('name', 'adjustment')->first();
                    $adjustment_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $adjustment->id],
                        ['role_id', $role->id]
                    ])->first();
                ?>

                <?php if($check_is_subscribed == '1') { ?>

                <li><a href="#product" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-list"></i><span><?php echo e(__('Product')); ?></span><span></a>
                    <ul id="product" class="collapse list-unstyled ">
                        <li id="category-menu"><a href="<?php echo e(route('category.index')); ?>"><?php echo e(__('Category')); ?></a></li>
                        <?php if($index_permission_active): ?>
                            <li id="product-list-menu"><a href="<?php echo e(route('products.index')); ?>"><?php echo e(__('Product List')); ?></a></li>
                            <?php
                            $add_permission = DB::table('permissions')->where('name', 'products-add')->first();
                            $add_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $add_permission->id],
                                ['role_id', $role->id]
                            ])->first();
                            ?>
                            <?php if($add_permission_active): ?>
                                <li id="product-create-menu"><a href="<?php echo e(route('products.create')); ?>"><?php echo e(__('Add Product')); ?></a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if($print_barcode_active): ?>
                            <li id="printBarcode-menu"><a href="<?php echo e(route('product.printBarcode')); ?>"><?php echo e(__('Print Barcode')); ?></a></li>
                        <?php endif; ?>
                        <?php if($adjustment_active): ?>
                            <li id="adjustment-list-menu"><a href="<?php echo e(route('qty_adjustment.index')); ?>"><?php echo e(trans('Adjustment List')); ?></a></li>
                            <li id="adjustment-create-menu"><a href="<?php echo e(route('qty_adjustment.create')); ?>"><?php echo e(trans('Add Adjustment')); ?></a></li>
                        <?php endif; ?>
                        <?php if($stock_count_active): ?>
                            <li id="stock-count-menu"><a href="<?php echo e(route('stock-count.index')); ?>"><?php echo e(trans('Stock Count')); ?></a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php
                    $index_permission = DB::table('permissions')->where('name', 'purchases-index')->first();
                    $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
                ?>
                <?php if($index_permission_active): ?>
                    <li><a href="#purchase" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-card"></i><span><?php echo e(trans('Purchase')); ?></span></a>
                        <ul id="purchase" class="collapse list-unstyled ">
                            <li id="purchase-list-menu"><a href="<?php echo e(route('purchases.index')); ?>"><?php echo e(trans('Purchase List')); ?></a></li>
                            <?php
                                $add_permission = DB::table('permissions')->where('name', 'purchases-add')->first();
                                $add_permission_active = DB::table('role_has_permissions')->where([
                                    ['permission_id', $add_permission->id],
                                    ['role_id', $role->id]
                                ])->first();
                            ?>
                            <?php if($add_permission_active): ?>
                                <li id="purchase-create-menu"><a href="<?php echo e(route('purchases.create')); ?>"><?php echo e(trans('Add Purchase')); ?></a></li>
                                <li id="purchase-import-menu"><a href="<?php echo e(url('purchases/purchase_by_csv')); ?>"><?php echo e(trans('Import Purchase By CSV')); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php
                    $index_permission = DB::table('permissions')->where('name', 'sales-index')->first();
                    $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();

                    $index_quick_permission = DB::table('permissions')->where('name', 'quick-sales-index')->first();
                    $index_quick_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_quick_permission->id],
                        ['role_id', $role->id]
                    ])->first();

                    $gift_card_permission = DB::table('permissions')->where('name', 'gift_card')->first();
                    $gift_card_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $gift_card_permission->id],
                        ['role_id', $role->id]
                    ])->first();

                    $coupon_permission = DB::table('permissions')->where('name', 'coupon')->first();
                    $coupon_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $coupon_permission->id],
                        ['role_id', $role->id]
                    ])->first();
                ?>
                <li><a href="#sale" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-cart"></i><span><?php echo e(trans('Sale')); ?></span></a>
                    <ul id="sale" class="collapse list-unstyled ">
                        <?php if($index_permission_active): ?>
                            <li id="sale-list-menu"><a href="<?php echo e(route('sales.index')); ?>"><?php echo e(trans('Sale List')); ?></a></li>
                            <?php if($index_quick_permission_active): ?>
                                <li id="quick-sale-list-menu"><a href="<?php echo e(route('sale.view_quick_sale')); ?>"><?php echo e(trans('Quick Sale List')); ?></a></li>
                            <?php endif; ?>
                            <?php
                                $add_permission = DB::table('permissions')->where('name', 'sales-add')->first();
                                $add_permission_active = DB::table('role_has_permissions')->where([
                                    ['permission_id', $add_permission->id],
                                    ['role_id', $role->id]
                                ])->first();
                            ?>
                            <?php if($add_permission_active): ?>
                                <li><a href="<?php echo e(route('sale.pos')); ?>">POS</a></li>
                                <li id="sale-create-menu"><a href="<?php echo e(route('sales.create')); ?>"><?php echo e(trans('Add Sale')); ?></a></li>
                                <li id="sale-import-menu"><a href="<?php echo e(url('sales/sale_by_csv')); ?>"><?php echo e(trans('Import Sale By CSV')); ?></a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if($gift_card_permission_active): ?>
                            <li id="gift-card-menu"><a href="<?php echo e(route('gift_cards.index')); ?>"><?php echo e(trans('Gift Card List')); ?></a> </li>
                        <?php endif; ?>
                        <?php if($coupon_permission_active): ?>
                            <li id="coupon-menu"><a href="<?php echo e(route('coupons.index')); ?>"><?php echo e(trans('Coupon List')); ?></a> </li>
                        <?php endif; ?>
                        <li id="delivery-menu"><a href="<?php echo e(route('delivery.index')); ?>"><?php echo e(trans('Delivery List')); ?></a></li>
                    </ul>
                </li>
                <?php
                    $index_permission = DB::table('permissions')->where('name', 'expenses-index')->first();
                    $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
                ?>
                <?php if($index_permission_active): ?>
                    <li><a href="#expense" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-wallet"></i><span><?php echo e(trans('Expense')); ?></span></a>
                        <ul id="expense" class="collapse list-unstyled ">
                            <li id="exp-cat-menu"><a href="<?php echo e(route('expense_categories.index')); ?>"><?php echo e(trans('Expense Category')); ?></a></li>
                            <li id="exp-list-menu"><a href="<?php echo e(route('expenses.index')); ?>"><?php echo e(trans('Expense List')); ?></a></li>
                            <?php
                                $add_permission = DB::table('permissions')->where('name', 'expenses-add')->first();
                                $add_permission_active = DB::table('role_has_permissions')->where([
                                    ['permission_id', $add_permission->id],
                                    ['role_id', $role->id]
                                ])->first();
                            ?>
                            <?php if($add_permission_active): ?>
                                <li><a id="add-expense" href=""> <?php echo e(trans('Add Expense')); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php
                    $index_permission = DB::table('permissions')->where('name', 'quotes-index')->first();
                    $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
                ?>
                <?php if($index_permission_active): ?>
                    <li><a href="#quotation" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-document"></i><span><?php echo e(trans('Quotation')); ?></span><span></a>
                        <ul id="quotation" class="collapse list-unstyled ">
                            <li id="quotation-list-menu"><a href="<?php echo e(route('quotations.index')); ?>"><?php echo e(trans('Quotation List')); ?></a></li>
                            <?php
                                $add_permission = DB::table('permissions')->where('name', 'quotes-add')->first();
                                $add_permission_active = DB::table('role_has_permissions')->where([
                                    ['permission_id', $add_permission->id],
                                    ['role_id', $role->id]
                                ])->first();
                            ?>
                            <?php if($add_permission_active): ?>
                                <li id="quotation-create-menu"><a href="<?php echo e(route('quotations.create')); ?>"><?php echo e(trans('Add Quotation')); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php
                    $index_permission = DB::table('permissions')->where('name', 'transfers-index')->first();
                    $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
                ?>
                <?php if($index_permission_active): ?>
                    <li><a href="#transfer" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-export"></i><span><?php echo e(trans('Transfer')); ?></span></a>
                        <ul id="transfer" class="collapse list-unstyled ">
                            <li id="transfer-list-menu"><a href="<?php echo e(route('transfers.index')); ?>"><?php echo e(trans('Transfer List')); ?></a></li>
                            <?php
                                $add_permission = DB::table('permissions')->where('name', 'transfers-add')->first();
                                $add_permission_active = DB::table('role_has_permissions')->where([
                                    ['permission_id', $add_permission->id],
                                    ['role_id', $role->id]
                                ])->first();
                            ?>
                            <?php if($add_permission_active): ?>
                                <li id="transfer-create-menu"><a href="<?php echo e(route('transfers.create')); ?>"><?php echo e(trans('Add Transfer')); ?></a></li>
                                <li id="transfer-import-menu"><a href="<?php echo e(url('transfers/transfer_by_csv')); ?>"><?php echo e(trans('Import Transfer By CSV')); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <li><a href="#return" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-archive"></i><span><?php echo e(trans('Return')); ?></span></a>
                    <ul id="return" class="collapse list-unstyled ">
                        <?php
                            $index_permission = DB::table('permissions')->where('name', 'returns-index')->first();
                            $index_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $index_permission->id],
                                ['role_id', $role->id]
                            ])->first();
                        ?>
                        <?php if($index_permission_active): ?>
                            <li id="sale-return-menu"><a href="<?php echo e(route('return-sale.index')); ?>"><?php echo e(trans('Sale')); ?></a></li>
                        <?php endif; ?>
                        <?php
                            $index_permission = DB::table('permissions')->where('name', 'purchase-return-index')->first();
                            $index_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $index_permission->id],
                                ['role_id', $role->id]
                            ])->first();
                        ?>
                        <?php if($index_permission_active): ?>
                            <li id="purchase-return-menu"><a href="<?php echo e(route('return-purchase.index')); ?>"><?php echo e(trans('Purchase')); ?></a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php
                    $index_permission = DB::table('permissions')->where('name', 'account-index')->first();
                    $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();

                    $money_transfer_permission = DB::table('permissions')->where('name', 'money-transfer')->first();
                    $money_transfer_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $money_transfer_permission->id],
                        ['role_id', $role->id]
                    ])->first();

                    $balance_sheet_permission = DB::table('permissions')->where('name', 'balance-sheet')->first();
                    $balance_sheet_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $balance_sheet_permission->id],
                        ['role_id', $role->id]
                    ])->first();

                    $account_statement_permission = DB::table('permissions')->where('name', 'account-statement')->first();
                    $account_statement_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $account_statement_permission->id],
                        ['role_id', $role->id]
                    ])->first();
                ?>
                <?php if($index_permission_active || $balance_sheet_permission_active || $account_statement_permission_active): ?>
                    <li class=""><a href="#account" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-briefcase"></i><span><?php echo e(trans('Accounting')); ?></span></a>
                        <ul id="account" class="collapse list-unstyled ">
                            <?php if($index_permission_active): ?>
                                <li id="account-list-menu"><a href="<?php echo e(route('accounts.index')); ?>"><?php echo e(trans('Account List')); ?></a></li>
                                <li><a id="add-account" href=""><?php echo e(trans('Add Account')); ?></a></li>
                            <?php endif; ?>
                            <?php if($money_transfer_permission_active): ?>
                                <li id="money-transfer-menu"><a href="<?php echo e(route('money-transfers.index')); ?>"><?php echo e(trans('Money Transfer')); ?></a></li>
                            <?php endif; ?>
                            <?php if($balance_sheet_permission_active): ?>
                                <li id="balance-sheet-menu"><a href="<?php echo e(route('accounts.balancesheet')); ?>"><?php echo e(trans('Balance Sheet')); ?></a></li>
                            <?php endif; ?>
                            <?php if($account_statement_permission_active): ?>
                                <li id="account-statement-menu"><a id="account-statement" href=""><?php echo e(trans('Account Statement')); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php
                    $index_permission = DB::table('permissions')->where('name', 'manageSubscription-index')->first();
                    $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
                    $index_permission_add = DB::table('permissions')->where('name', 'manageSubscription-add')->first();
                    $index_permission_active_add = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission_add->id],
                        ['role_id', $role->id]
                    ])->first();
                ?>
                <?php if($index_permission_active || $index_permission_active_add): ?>
                    <li class=""><a href="#subscription" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-briefcase"></i><span><?php echo e(trans('Manage Subscription')); ?></span></a>
                        <ul id="subscription" class="collapse list-unstyled ">
                            <?php if($index_permission_active): ?>
                                <li id="subscription-list-menu"><a href="<?php echo e(route('package.index')); ?>"><?php echo e(trans('Subscription List')); ?></a></li>
                            <?php endif; ?>
                            <?php if($index_permission_active_add): ?>
                                <li id="subscription-list-menu"><a href="<?php echo e(route('package.create')); ?>"><?php echo e(trans('Subscription Add')); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php
                    $index_permission = DB::table('permissions')->where('name', 'mySubscription-index')->first();
                    $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();

                    $index_permission_add = DB::table('permissions')->where('name', 'mySubscription-add')->first();
                    $index_permission_active_add = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission_add->id],
                        ['role_id', $role->id]
                    ])->first();
                ?>
                <?php if($index_permission_active || $index_permission_active_add): ?>
                    <li class=""><a href="#subscription" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-briefcase"></i><span><?php echo e(trans('My Subscription')); ?></span></a>
                        <ul id="subscription" class="collapse list-unstyled ">
                            <?php if($index_permission_active): ?>
                                <li id="subscription-list-menu"><a href="<?php echo e(route('sellerpackage.add')); ?>"><?php echo e(trans('Subscription List')); ?></a></li>
                            <?php endif; ?>
                            <?php if($index_permission_active_add): ?>
                                <li id="subscription-list-menu"><a href="<?php echo e(route('sellerpackage.add')); ?>"><?php echo e(trans('Subscription Add')); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php } ?>

                <?php
                    $index_permission = DB::table('permissions')->where('name', 'seller-index')->first();
                    $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();

                    $index_permission_add = DB::table('permissions')->where('name', 'seller-add')->first();
                    $index_permission_active_add = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission_add->id],
                        ['role_id', $role->id]
                    ])->first();
                ?>
                <li class=""><a href="#seller" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-briefcase"></i><span>Manage Seller</span></a>
                    <ul id="seller" class="collapse list-unstyled ">

                        <?php if(!empty($seller_id) && !empty($start_date) && !empty($end_date)): ?>
                            <li id="seller-transaction"><a href="<?php echo e(route('seller_transaction/'. $seller_id .'/'. $start_date .'/'. $end_date)); ?>"><?php echo e(trans('Seller Transaction')); ?></a></li>
                        <?php else: ?>
                            <li id="seller-transaction"><a href="<?php echo e(route('seller_transaction')); ?>"><?php echo e(trans('Seller Transaction')); ?></a></li>
                        <?php endif; ?>
                        <?php if($index_permission_active || $index_permission_active_add): ?>
                            <?php if($index_permission_active): ?>
                                <li id="seller-list-menu"><a href="<?php echo e(route('seller.index')); ?>"><?php echo e(trans('Seller List')); ?></a></li>
                            <?php endif; ?>
                            <?php if($index_permission_active_add): ?>
                                <li id="seller-create-menu"><a href="<?php echo e(route('seller.create')); ?>"><?php echo e(trans('Add Seller')); ?></a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </li>

                <?php
                    $index_permission = DB::table('permissions')->where('name', 'managecommission-index')->first();
                    $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();

                    $index_permission_add = DB::table('permissions')->where('name', 'managecommission-add')->first();
                    $index_permission_active_add = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission_add->id],
                        ['role_id', $role->id]
                    ])->first();
                ?>
                <?php if($index_permission_active || $index_permission_active_add): ?>
                    <li class=""><a href="#managecommission" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-briefcase"></i><span>Manage Commission</span></a>
                        <ul id="managecommission" class="collapse list-unstyled ">
                            <?php if($index_permission_active): ?>
                                <li id="managecommission-list-menu"><a href="<?php echo e(route('managecommission.index')); ?>"><?php echo e(trans('Commission List')); ?></a></li>
                            <?php endif; ?>
                            <?php if($index_permission_active_add): ?>
                                <li id="managecommission-create-menu"><a href="<?php echo e(route('managecommission.create')); ?>"><?php echo e(trans('Add Commission')); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php
                    $department = DB::table('permissions')->where('name', 'department')->first();
                    $department_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $department->id],
                        ['role_id', $role->id]
                    ])->first();

                    $index_employee = DB::table('permissions')->where('name', 'employees-index')->first();
                    $index_employee_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_employee->id],
                        ['role_id', $role->id]
                    ])->first();

                    $attendance = DB::table('permissions')->where('name', 'attendance')->first();
                    $attendance_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $attendance->id],
                        ['role_id', $role->id]
                    ])->first();

                    $payroll = DB::table('permissions')->where('name', 'payroll')->first();
                    $payroll_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $payroll->id],
                        ['role_id', $role->id]
                    ])->first();
                ?>
                <li class=""><a href="#hrm" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-user-group"></i><span>HRM</span></a>
                    <ul id="hrm" class="collapse list-unstyled ">
                        <?php if($department_active): ?>
                            <li id="dept-menu"><a href="<?php echo e(route('departments.index')); ?>"><?php echo e(trans('Department')); ?></a></li>
                        <?php endif; ?>
                        <?php if($index_employee_active): ?>
                            <li id="employee-menu"><a href="<?php echo e(route('employees.index')); ?>"><?php echo e(trans('Employee')); ?></a></li>
                        <?php endif; ?>
                        <?php if($attendance_active): ?>
                            <li id="attendance-menu"><a href="<?php echo e(route('attendance.index')); ?>"><?php echo e(trans('Attendance')); ?></a></li>
                        <?php endif; ?>
                        <?php if($payroll_active): ?>
                            <li id="payroll-menu"><a href="<?php echo e(route('payroll.index')); ?>"><?php echo e(trans('Payroll')); ?></a></li>
                        <?php endif; ?>
                        <li id="holiday-menu"><a href="<?php echo e(route('holidays.index')); ?>"><?php echo e(trans('Holiday')); ?></a></li>
                    </ul>
                </li>
                <li><a href="#people" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-user"></i><span><?php echo e(trans('People')); ?></span></a>
                    <ul id="people" class="collapse list-unstyled ">
                        <?php
                            $index_permission_active = DB::table('permissions')
                                ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                                ->where([
                                    ['permissions.name', 'users-index'],
                                    ['role_id', $role->id]
                                ])->first();
                        ?>
                        <?php if($index_permission_active): ?>
                            <li id="user-list-menu"><a href="<?php echo e(route('user.index')); ?>"><?php echo e(trans('User List')); ?></a></li>
                            <?php
                                $add_permission_active = DB::table('permissions')
                                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                                    ->where([
                                        ['permissions.name', 'users-add'],
                                        ['role_id', $role->id]
                                    ])->first();
                            ?>
                            <?php if($add_permission_active): ?>
                                <li id="user-create-menu"><a href="<?php echo e(route('user.create')); ?>"><?php echo e(trans('Add User')); ?></a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php
                            $index_permission = DB::table('permissions')->where('name', 'customers-index')->first();
                            $index_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $index_permission->id],
                                ['role_id', $role->id]
                            ])->first();
                        ?>
                        <?php if($index_permission_active): ?>
                            <li id="customer-list-menu"><a href="<?php echo e(route('customer.index')); ?>"><?php echo e(trans('Customer List')); ?></a></li>
                            <?php
                                $add_permission = DB::table('permissions')->where('name', 'customers-add')->first();
                                $add_permission_active = DB::table('role_has_permissions')->where([
                                    ['permission_id', $add_permission->id],
                                    ['role_id', $role->id]
                                ])->first();
                            ?>
                            <?php if($add_permission_active): ?>
                                <li id="customer-create-menu"><a href="<?php echo e(route('customer.create')); ?>"><?php echo e(trans('Add Customer')); ?></a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php
                            $index_permission = DB::table('permissions')->where('name', 'billers-index')->first();
                            $index_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $index_permission->id],
                                ['role_id', $role->id]
                            ])->first();
                        ?>
                        <?php if($index_permission_active): ?>
                            <li id="biller-list-menu"><a href="<?php echo e(route('biller.index')); ?>"><?php echo e(trans('Biller List')); ?></a></li>
                            <?php
                                $add_permission = DB::table('permissions')->where('name', 'billers-add')->first();
                                $add_permission_active = DB::table('role_has_permissions')->where([
                                    ['permission_id', $add_permission->id],
                                    ['role_id', $role->id]
                                ])->first();
                            ?>
                            <?php if($add_permission_active): ?>
                                <li id="biller-create-menu"><a href="<?php echo e(route('biller.create')); ?>"><?php echo e(trans('Add Biller')); ?></a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php
                            $index_permission = DB::table('permissions')->where('name', 'suppliers-index')->first();
                            $index_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $index_permission->id],
                                ['role_id', $role->id]
                            ])->first();
                        ?>
                        <?php if($index_permission_active): ?>
                            <li id="supplier-list-menu"><a href="<?php echo e(route('supplier.index')); ?>"><?php echo e(trans('Supplier List')); ?></a></li>
                            <?php
                                $add_permission = DB::table('permissions')->where('name', 'suppliers-add')->first();
                                $add_permission_active = DB::table('role_has_permissions')->where([
                                    ['permission_id', $add_permission->id],
                                    ['role_id', $role->id]
                                ])->first();
                            ?>
                            <?php if($add_permission_active): ?>
                                <li id="supplier-create-menu"><a href="<?php echo e(route('supplier.create')); ?>"><?php echo e(trans('Add Supplier')); ?></a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </li>

                <?php if($check_is_subscribed == '1') { ?>

                <li><a href="#report" aria-expanded="false" data-toggle="collapse">
                        <i class="dripicons-document-remove"></i>
                        <span><?php echo e(trans('Reports')); ?></span>
                    </a>
                    <?php
                        $profit_loss_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'profit-loss'],
                                ['role_id', $role->id]
                            ])->first();

                        $best_seller_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'best-seller'],
                                ['role_id', $role->id]
                            ])->first();

                        $warehouse_report_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'warehouse-report'],
                                ['role_id', $role->id]
                            ])->first();

                        $warehouse_stock_report_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'warehouse-stock-report'],
                                ['role_id', $role->id]
                            ])->first();

                        $product_report_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'product-report'],
                                ['role_id', $role->id]
                            ])->first();

                        $daily_sale_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'daily-sale'],
                                ['role_id', $role->id]
                            ])->first();

                        $monthly_sale_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'monthly-sale'],
                                ['role_id', $role->id]
                            ])->first();

                        $daily_purchase_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'daily-purchase'],
                                ['role_id', $role->id]
                            ])->first();

                        $monthly_purchase_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'monthly-purchase'],
                                ['role_id', $role->id]
                            ])->first();

                        $purchase_report_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'purchase-report'],
                                ['role_id', $role->id]
                            ])->first();

                        $sale_report_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'sale-report'],
                                ['role_id', $role->id]
                            ])->first();

                        $payment_report_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'payment-report'],
                                ['role_id', $role->id]
                            ])->first();

                        $product_qty_alert_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'product-qty-alert'],
                                ['role_id', $role->id]
                            ])->first();

                        $user_report_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'user-report'],
                                ['role_id', $role->id]
                            ])->first();

                        $customer_report_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'customer-report'],
                                ['role_id', $role->id]
                            ])->first();

                        $supplier_report_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'supplier-report'],
                                ['role_id', $role->id]
                            ])->first();

                        $due_report_active = DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where([
                                ['permissions.name', 'due-report'],
                                ['role_id', $role->id]
                            ])->first();
                    ?>
                    <ul id="report" class="collapse list-unstyled ">
                        <?php if($profit_loss_active): ?>
                            <li id="profit-loss-report-menu">
                                <?php echo Form::open(['route' => 'report.profitLoss', 'method' => 'post', 'id' => 'profitLoss-report-form']); ?>

                                <input type="hidden" name="start_date" value="<?php echo e(date('Y-m').'-'.'01'); ?>" />
                                <input type="hidden" name="end_date" value="<?php echo e(date('Y-m-d')); ?>" />
                                <a id="profitLoss-link" href=""><?php echo e(trans('Summary Report')); ?></a>
                                <?php echo Form::close(); ?>

                            </li>
                        <?php endif; ?>
                        <?php if($best_seller_active): ?>
                            <li id="best-seller-report-menu">
                                <a href="<?php echo e(url('report/best_seller')); ?>"><?php echo e(trans('Best Seller')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($product_report_active): ?>
                            <li id="product-report-menu">
                                <?php echo Form::open(['route' => 'report.product', 'method' => 'post', 'id' => 'product-report-form']); ?>

                                <input type="hidden" name="start_date" value="1988-04-18" />
                                <input type="hidden" name="end_date" value="<?php echo e(date('Y-m-d')); ?>" />
                                <input type="hidden" name="warehouse_id" value="0" />
                                <a id="report-link" href=""><?php echo e(trans('Product Report')); ?></a>
                                <?php echo Form::close(); ?>

                            </li>
                        <?php endif; ?>
                        <?php if($daily_sale_active): ?>
                            <li id="daily-sale-report-menu">
                                <a href="<?php echo e(url('report/daily_sale/'.date('Y').'/'.date('m'))); ?>"><?php echo e(trans('Daily Sale')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($monthly_sale_active): ?>
                            <li id="monthly-sale-report-menu">
                                <a href="<?php echo e(url('report/monthly_sale/'.date('Y'))); ?>"><?php echo e(trans('file.Monthly Sale')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($daily_purchase_active): ?>
                            <li id="daily-purchase-report-menu">
                                <a href="<?php echo e(url('report/daily_purchase/'.date('Y').'/'.date('m'))); ?>"><?php echo e(trans('Daily Purchase')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($monthly_purchase_active): ?>
                            <li id="monthly-purchase-report-menu">
                                <a href="<?php echo e(url('report/monthly_purchase/'.date('Y'))); ?>"><?php echo e(trans('Monthly Purchase')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($sale_report_active): ?>
                            <li id="sale-report-menu">
                                <?php echo Form::open(['route' => 'report.sale', 'method' => 'post', 'id' => 'sale-report-form']); ?>

                                <input type="hidden" name="start_date" value="1988-04-18" />
                                <input type="hidden" name="end_date" value="<?php echo e(date('Y-m-d')); ?>" />
                                <input type="hidden" name="warehouse_id" value="0" />
                                <a id="sale-report-link" href=""><?php echo e(trans('Sale Report')); ?></a>
                                <?php echo Form::close(); ?>

                            </li>
                        <?php endif; ?>
                        <?php if($payment_report_active): ?>
                            <li id="payment-report-menu">
                                <?php echo Form::open(['route' => 'report.paymentByDate', 'method' => 'post', 'id' => 'payment-report-form']); ?>

                                <input type="hidden" name="start_date" value="1988-04-18" />
                                <input type="hidden" name="end_date" value="<?php echo e(date('Y-m-d')); ?>" />
                                <a id="payment-report-link" href=""><?php echo e(trans('Payment Report')); ?></a>
                                <?php echo Form::close(); ?>

                            </li>
                        <?php endif; ?>
                        <?php if($purchase_report_active): ?>
                            <li id="purchase-report-menu">
                                <?php echo Form::open(['route' => 'report.purchase', 'method' => 'post', 'id' => 'purchase-report-form']); ?>

                                <input type="hidden" name="start_date" value="1988-04-18" />
                                <input type="hidden" name="end_date" value="<?php echo e(date('Y-m-d')); ?>" />
                                <input type="hidden" name="warehouse_id" value="0" />
                                <a id="purchase-report-link" href=""><?php echo e(trans('Purchase Report')); ?></a>
                                <?php echo Form::close(); ?>

                            </li>
                        <?php endif; ?>
                        <?php if($warehouse_report_active): ?>
                            <li id="warehouse-report-menu">
                                <a id="warehouse-report-link" href=""><?php echo e(trans('Warehouse Report')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($warehouse_stock_report_active): ?>
                            <li id="warehouse-stock-report-menu">
                                <a href="<?php echo e(route('report.warehouseStock')); ?>"><?php echo e(trans('Warehouse Stock Chart')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($product_qty_alert_active): ?>
                            <li id="qtyAlert-report-menu">
                                <a href="<?php echo e(route('report.qtyAlert')); ?>"><?php echo e(trans('Product Quantity Alert')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($user_report_active): ?>
                            <li id="user-report-menu">
                                <a id="user-report-link" href=""><?php echo e(trans('User Report')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($customer_report_active): ?>
                            <li id="customer-report-menu">
                                <a id="customer-report-link" href=""><?php echo e(trans('Customer Report')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($supplier_report_active): ?>
                            <li id="supplier-report-menu">
                                <a id="supplier-report-link" href=""><?php echo e(trans('Supplier Report')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($due_report_active): ?>
                            <li id="due-report-menu">
                                <?php echo Form::open(['route' => 'report.dueByDate', 'method' => 'post', 'id' => 'due-report-form']); ?>

                                <input type="hidden" name="start_date" value="1988-04-18" />
                                <input type="hidden" name="end_date" value="<?php echo e(date('Y-m-d')); ?>" />
                                <a id="due-report-link" href=""><?php echo e(trans('Due Report')); ?></a>
                                <?php echo Form::close(); ?>

                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php } ?>

                <li><a href="#setting" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-gear"></i><span><?php echo e(trans('Settings')); ?></span></a>
                    <ul id="setting" class="collapse list-unstyled ">
                        <?php
                            $warehouse_permission = DB::table('permissions')->where('name', 'warehouse')->first();
                            $warehouse_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $warehouse_permission->id],
                                ['role_id', $role->id]
                            ])->first();

                            $customer_group_permission = DB::table('permissions')->where('name', 'customer_group')->first();
                            $customer_group_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $customer_group_permission->id],
                                ['role_id', $role->id]
                            ])->first();

                            $brand_permission = DB::table('permissions')->where('name', 'brand')->first();
                            $brand_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $brand_permission->id],
                                ['role_id', $role->id]
                            ])->first();

                            $unit_permission = DB::table('permissions')->where('name', 'unit')->first();
                            $unit_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $unit_permission->id],
                                ['role_id', $role->id]
                            ])->first();

                            $tax_permission = DB::table('permissions')->where('name', 'tax')->first();
                            $tax_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $tax_permission->id],
                                ['role_id', $role->id]
                            ])->first();

                            $general_setting_permission = DB::table('permissions')->where('name', 'general_setting')->first();
                            $general_setting_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $general_setting_permission->id],
                                ['role_id', $role->id]
                                ])->first();

                            $mail_setting_permission = DB::table('permissions')->where('name', 'mail_setting')->first();
                            $mail_setting_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $mail_setting_permission->id],
                                ['role_id', $role->id]
                                ])->first();

                            $sms_setting_permission = DB::table('permissions')->where('name', 'sms_setting')->first();
                            $sms_setting_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $sms_setting_permission->id],
                                ['role_id', $role->id]
                                ])->first();

                            $create_sms_permission = DB::table('permissions')->where('name', 'create_sms')->first();
                            $create_sms_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $create_sms_permission->id],
                                ['role_id', $role->id]
                                ])->first();

                            $pos_setting_permission = DB::table('permissions')->where('name', 'pos_setting')->first();
                            $pos_setting_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $pos_setting_permission->id],
                                ['role_id', $role->id]
                                ])->first();

                            $hrm_setting_permission = DB::table('permissions')->where('name', 'hrm_setting')->first();
                            $hrm_setting_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $hrm_setting_permission->id],
                                ['role_id', $role->id]
                                ])->first();
                        ?>

                        <?php if($check_is_subscribed == '1') { ?>
                        <li id="role-menu"><a href="<?php echo e(route('role.index')); ?>"><?php echo e(trans('Role Permission')); ?></a></li>
                        <?php } ?>
                        <?php if($warehouse_permission_active): ?>
                            <li id="warehouse-menu"><a href="<?php echo e(route('warehouse.index')); ?>"><?php echo e(trans('Warehouse')); ?></a></li>
                        <?php endif; ?>
                        <?php if($customer_group_permission_active): ?>
                            <li id="customer-group-menu"><a href="<?php echo e(route('customer_group.index')); ?>"><?php echo e(trans('Customer Group')); ?></a></li>
                        <?php endif; ?>
                        <?php if($brand_permission_active): ?>
                            <li id="brand-menu"><a href="<?php echo e(route('brand.index')); ?>"><?php echo e(trans('Brand')); ?></a></li>
                        <?php endif; ?>
                        <?php if($unit_permission_active): ?>
                            <li id="unit-menu"><a href="<?php echo e(route('unit.index')); ?>"><?php echo e(trans('Unit')); ?></a></li>
                        <?php endif; ?>
                        <?php if($tax_permission_active): ?>
                            <li id="tax-menu"><a href="<?php echo e(route('tax.index')); ?>"><?php echo e(trans('Tax')); ?></a></li>
                        <?php endif; ?>
                        <li id="user-menu"><a href="<?php echo e(route('user.profile', ['id' => Auth::id()])); ?>"><?php echo e(trans('User Profile')); ?></a></li>
                        <?php if($create_sms_permission_active): ?>
                            <li id="create-sms-menu"><a href="<?php echo e(route('setting.createSms')); ?>"><?php echo e(trans('Create SMS')); ?></a></li>
                        <?php endif; ?>
                        <?php if($general_setting_permission_active): ?>
                            <li id="general-setting-menu"><a href="<?php echo e(route('setting.general')); ?>"><?php echo e(trans('General Setting')); ?></a></li>
                        <?php endif; ?>
                        <?php if($mail_setting_permission_active): ?>
                            <li id="mail-setting-menu"><a href="<?php echo e(route('setting.mail')); ?>"><?php echo e(trans('Mail Setting')); ?></a></li>
                        <?php endif; ?>
                        <?php if($sms_setting_permission_active): ?>
                            <li id="sms-setting-menu"><a href="<?php echo e(route('setting.sms')); ?>"><?php echo e(trans('SMS Setting')); ?></a></li>
                        <?php endif; ?>
                        <?php if($pos_setting_permission_active): ?>
                            <li id="pos-setting-menu"><a href="<?php echo e(route('setting.pos')); ?>">POS <?php echo e(trans('settings')); ?></a></li>
                        <?php endif; ?>
                        <?php if($hrm_setting_permission_active): ?>
                            <li id="hrm-setting-menu"><a href="<?php echo e(route('setting.hrm')); ?>"> <?php echo e(trans('HRM Setting')); ?></a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>