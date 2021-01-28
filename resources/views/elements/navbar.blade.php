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
            @if($get_subscripe)
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
            @else
                <?php $check_is_subscribed = 0; ?>
            @endif
            <?php } else {
                $check_is_subscribed = 1;
            }
            ?>
            <ul id="side-main-menu" class="side-menu list-unstyled">
                <li><a href="{{url('/')}}"> <i class="dripicons-meter"></i><span>{{ __('file.dashboard') }}</span></a></li>
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

                <li><a href="#product" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-list"></i><span>{{__('Product')}}</span><span></a>
                    <ul id="product" class="collapse list-unstyled ">
                        <li id="category-menu"><a href="{{route('category.index')}}">{{__('Category')}}</a></li>
                        @if($index_permission_active)
                            <li id="product-list-menu"><a href="{{route('products.index')}}">{{__('Product List')}}</a></li>
                            <?php
                            $add_permission = DB::table('permissions')->where('name', 'products-add')->first();
                            $add_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $add_permission->id],
                                ['role_id', $role->id]
                            ])->first();
                            ?>
                            @if($add_permission_active)
                                <li id="product-create-menu"><a href="{{route('products.create')}}">{{__('Add Product')}}</a></li>
                            @endif
                        @endif
                        @if($print_barcode_active)
                            <li id="printBarcode-menu"><a href="{{route('product.printBarcode')}}">{{__('Print Barcode')}}</a></li>
                        @endif
                        @if($adjustment_active)
                            <li id="adjustment-list-menu"><a href="{{route('qty_adjustment.index')}}">{{trans('Adjustment List')}}</a></li>
                            <li id="adjustment-create-menu"><a href="{{route('qty_adjustment.create')}}">{{trans('Add Adjustment')}}</a></li>
                        @endif
                        @if($stock_count_active)
                            <li id="stock-count-menu"><a href="{{route('stock-count.index')}}">{{trans('Stock Count')}}</a></li>
                        @endif
                    </ul>
                </li>
                <?php
                    $index_permission = DB::table('permissions')->where('name', 'purchases-index')->first();
                    $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
                ?>
                @if($index_permission_active)
                    <li><a href="#purchase" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-card"></i><span>{{trans('Purchase')}}</span></a>
                        <ul id="purchase" class="collapse list-unstyled ">
                            <li id="purchase-list-menu"><a href="{{route('purchases.index')}}">{{trans('Purchase List')}}</a></li>
                            <?php
                                $add_permission = DB::table('permissions')->where('name', 'purchases-add')->first();
                                $add_permission_active = DB::table('role_has_permissions')->where([
                                    ['permission_id', $add_permission->id],
                                    ['role_id', $role->id]
                                ])->first();
                            ?>
                            @if($add_permission_active)
                                <li id="purchase-create-menu"><a href="{{route('purchases.create')}}">{{trans('Add Purchase')}}</a></li>
                                <li id="purchase-import-menu"><a href="{{url('purchases/purchase_by_csv')}}">{{trans('Import Purchase By CSV')}}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
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
                <li><a href="#sale" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-cart"></i><span>{{trans('Sale')}}</span></a>
                    <ul id="sale" class="collapse list-unstyled ">
                        @if($index_permission_active)
                            <li id="sale-list-menu"><a href="{{route('sales.index')}}">{{trans('Sale List')}}</a></li>
                            @if($index_quick_permission_active)
                                <li id="quick-sale-list-menu"><a href="{{route('sale.view_quick_sale')}}">{{trans('Quick Sale List')}}</a></li>
                            @endif
                            <?php
                                $add_permission = DB::table('permissions')->where('name', 'sales-add')->first();
                                $add_permission_active = DB::table('role_has_permissions')->where([
                                    ['permission_id', $add_permission->id],
                                    ['role_id', $role->id]
                                ])->first();
                            ?>
                            @if($add_permission_active)
                                <li><a href="{{route('sale.pos')}}">POS</a></li>
                                <li id="sale-create-menu"><a href="{{route('sales.create')}}">{{trans('Add Sale')}}</a></li>
                                <li id="sale-import-menu"><a href="{{url('sales/sale_by_csv')}}">{{trans('Import Sale By CSV')}}</a></li>
                            @endif
                        @endif
                        @if($gift_card_permission_active)
                            <li id="gift-card-menu"><a href="{{route('gift_cards.index')}}">{{trans('Gift Card List')}}</a> </li>
                        @endif
                        @if($coupon_permission_active)
                            <li id="coupon-menu"><a href="{{route('coupons.index')}}">{{trans('Coupon List')}}</a> </li>
                        @endif
                        <li id="delivery-menu"><a href="{{route('delivery.index')}}">{{trans('Delivery List')}}</a></li>
                    </ul>
                </li>
                <?php
                    $index_permission = DB::table('permissions')->where('name', 'expenses-index')->first();
                    $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
                ?>
                @if($index_permission_active)
                    <li><a href="#expense" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-wallet"></i><span>{{ trans('Expense') }}</span></a>
                        <ul id="expense" class="collapse list-unstyled ">
                            <li id="exp-cat-menu"><a href="{{ route('expense_categories.index') }}">{{ trans('Expense Category') }}</a></li>
                            <li id="exp-list-menu"><a href="{{ route('expenses.index') }}">{{ trans('Expense List') }}</a></li>
                            <?php
                                $add_permission = DB::table('permissions')->where('name', 'expenses-add')->first();
                                $add_permission_active = DB::table('role_has_permissions')->where([
                                    ['permission_id', $add_permission->id],
                                    ['role_id', $role->id]
                                ])->first();
                            ?>
                            @if($add_permission_active)
                                <li><a id="add-expense" href=""> {{trans('Add Expense')}}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                <?php
                    $index_permission = DB::table('permissions')->where('name', 'quotes-index')->first();
                    $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
                ?>
                @if($index_permission_active)
                    <li><a href="#quotation" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-document"></i><span>{{trans('Quotation')}}</span><span></a>
                        <ul id="quotation" class="collapse list-unstyled ">
                            <li id="quotation-list-menu"><a href="{{route('quotations.index')}}">{{trans('Quotation List')}}</a></li>
                            <?php
                                $add_permission = DB::table('permissions')->where('name', 'quotes-add')->first();
                                $add_permission_active = DB::table('role_has_permissions')->where([
                                    ['permission_id', $add_permission->id],
                                    ['role_id', $role->id]
                                ])->first();
                            ?>
                            @if($add_permission_active)
                                <li id="quotation-create-menu"><a href="{{route('quotations.create')}}">{{trans('Add Quotation')}}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                <?php
                    $index_permission = DB::table('permissions')->where('name', 'transfers-index')->first();
                    $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
                ?>
                @if($index_permission_active)
                    <li><a href="#transfer" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-export"></i><span>{{trans('Transfer')}}</span></a>
                        <ul id="transfer" class="collapse list-unstyled ">
                            <li id="transfer-list-menu"><a href="{{route('transfers.index')}}">{{trans('Transfer List')}}</a></li>
                            <?php
                                $add_permission = DB::table('permissions')->where('name', 'transfers-add')->first();
                                $add_permission_active = DB::table('role_has_permissions')->where([
                                    ['permission_id', $add_permission->id],
                                    ['role_id', $role->id]
                                ])->first();
                            ?>
                            @if($add_permission_active)
                                <li id="transfer-create-menu"><a href="{{ route('transfers.create') }}">{{ trans('Add Transfer') }}</a></li>
                                <li id="transfer-import-menu"><a href="{{ url('transfers/transfer_by_csv') }}">{{ trans('Import Transfer By CSV') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                <li><a href="#return" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-archive"></i><span>{{ trans('Return') }}</span></a>
                    <ul id="return" class="collapse list-unstyled ">
                        <?php
                            $index_permission = DB::table('permissions')->where('name', 'returns-index')->first();
                            $index_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $index_permission->id],
                                ['role_id', $role->id]
                            ])->first();
                        ?>
                        @if($index_permission_active)
                            <li id="sale-return-menu"><a href="{{route('return-sale.index')}}">{{ trans('Sale') }}</a></li>
                        @endif
                        <?php
                            $index_permission = DB::table('permissions')->where('name', 'purchase-return-index')->first();
                            $index_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $index_permission->id],
                                ['role_id', $role->id]
                            ])->first();
                        ?>
                        @if($index_permission_active)
                            <li id="purchase-return-menu"><a href="{{route('return-purchase.index')}}">{{ trans('Purchase') }}</a></li>
                        @endif
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
                @if($index_permission_active || $balance_sheet_permission_active || $account_statement_permission_active)
                    <li class=""><a href="#account" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-briefcase"></i><span>{{ trans('Accounting') }}</span></a>
                        <ul id="account" class="collapse list-unstyled ">
                            @if($index_permission_active)
                                <li id="account-list-menu"><a href="{{route('accounts.index')}}">{{ trans('Account List') }}</a></li>
                                <li><a id="add-account" href="">{{ trans('Add Account') }}</a></li>
                            @endif
                            @if($money_transfer_permission_active)
                                <li id="money-transfer-menu"><a href="{{route('money-transfers.index')}}">{{ trans('Money Transfer') }}</a></li>
                            @endif
                            @if($balance_sheet_permission_active)
                                <li id="balance-sheet-menu"><a href="{{route('accounts.balancesheet')}}">{{ trans('Balance Sheet') }}</a></li>
                            @endif
                            @if($account_statement_permission_active)
                                <li id="account-statement-menu"><a id="account-statement" href="">{{ trans('Account Statement') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
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
                @if($index_permission_active || $index_permission_active_add)
                    <li class=""><a href="#subscription" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-briefcase"></i><span>{{ trans('Manage Subscription') }}</span></a>
                        <ul id="subscription" class="collapse list-unstyled ">
                            @if($index_permission_active)
                                <li id="subscription-list-menu"><a href="{{route('package.index')}}">{{ trans('Subscription List') }}</a></li>
                            @endif
                            @if($index_permission_active_add)
                                <li id="subscription-list-menu"><a href="{{route('package.create')}}">{{ trans('Subscription Add') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
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
                @if($index_permission_active || $index_permission_active_add)
                    <li class=""><a href="#subscription" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-briefcase"></i><span>{{ trans('My Subscription') }}</span></a>
                        <ul id="subscription" class="collapse list-unstyled ">
                            @if($index_permission_active)
                                <li id="subscription-list-menu"><a href="{{route('sellerpackage.add')}}">{{ trans('Subscription List') }}</a></li>
                            @endif
                            @if($index_permission_active_add)
                                <li id="subscription-list-menu"><a href="{{route('sellerpackage.add')}}">{{ trans('Subscription Add') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

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
{{--                        <li id="seller-transaction"><a href="{{ route('stransaction.index') }}">{{ trans('Seller Transaction') }}</a></li>--}}
                        @if(!empty($seller_id) && !empty($start_date) && !empty($end_date))
                            <li id="seller-transaction"><a href="{{ route('seller_transaction/'. $seller_id .'/'. $start_date .'/'. $end_date) }}">{{ trans('Seller Transaction') }}</a></li>
                        @else
                            <li id="seller-transaction"><a href="{{ route('seller_transaction') }}">{{ trans('Seller Transaction') }}</a></li>
                        @endif
                        @if($index_permission_active || $index_permission_active_add)
                            @if($index_permission_active)
                                <li id="seller-list-menu"><a href="{{ route('seller.index') }}">{{ trans('Seller List') }}</a></li>
                            @endif
                            @if($index_permission_active_add)
                                <li id="seller-create-menu"><a href="{{ route('seller.create') }}">{{ trans('Add Seller') }}</a></li>
                            @endif
                        @endif
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
                @if($index_permission_active || $index_permission_active_add)
                    <li class=""><a href="#managecommission" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-briefcase"></i><span>Manage Commission</span></a>
                        <ul id="managecommission" class="collapse list-unstyled ">
                            @if($index_permission_active)
                                <li id="managecommission-list-menu"><a href="{{route('managecommission.index')}}">{{ trans('Commission List') }}</a></li>
                            @endif
                            @if($index_permission_active_add)
                                <li id="managecommission-create-menu"><a href="{{route('managecommission.create')}}">{{ trans('Add Commission') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
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
                        @if($department_active)
                            <li id="dept-menu"><a href="{{route('departments.index')}}">{{trans('Department')}}</a></li>
                        @endif
                        @if($index_employee_active)
                            <li id="employee-menu"><a href="{{route('employees.index')}}">{{trans('Employee')}}</a></li>
                        @endif
                        @if($attendance_active)
                            <li id="attendance-menu"><a href="{{route('attendance.index')}}">{{trans('Attendance')}}</a></li>
                        @endif
                        @if($payroll_active)
                            <li id="payroll-menu"><a href="{{route('payroll.index')}}">{{trans('Payroll')}}</a></li>
                        @endif
                        <li id="holiday-menu"><a href="{{route('holidays.index')}}">{{ trans('Holiday') }}</a></li>
                    </ul>
                </li>
                <li><a href="#people" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-user"></i><span>{{ trans('People') }}</span></a>
                    <ul id="people" class="collapse list-unstyled ">
                        <?php
                            $index_permission_active = DB::table('permissions')
                                ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                                ->where([
                                    ['permissions.name', 'users-index'],
                                    ['role_id', $role->id]
                                ])->first();
                        ?>
                        @if($index_permission_active)
                            <li id="user-list-menu"><a href="{{route('user.index')}}">{{trans('User List')}}</a></li>
                            <?php
                                $add_permission_active = DB::table('permissions')
                                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                                    ->where([
                                        ['permissions.name', 'users-add'],
                                        ['role_id', $role->id]
                                    ])->first();
                            ?>
                            @if($add_permission_active)
                                <li id="user-create-menu"><a href="{{route('user.create')}}">{{trans('Add User')}}</a></li>
                            @endif
                        @endif
                        <?php
                            $index_permission = DB::table('permissions')->where('name', 'customers-index')->first();
                            $index_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $index_permission->id],
                                ['role_id', $role->id]
                            ])->first();
                        ?>
                        @if($index_permission_active)
                            <li id="customer-list-menu"><a href="{{route('customer.index')}}">{{trans('Customer List')}}</a></li>
                            <?php
                                $add_permission = DB::table('permissions')->where('name', 'customers-add')->first();
                                $add_permission_active = DB::table('role_has_permissions')->where([
                                    ['permission_id', $add_permission->id],
                                    ['role_id', $role->id]
                                ])->first();
                            ?>
                            @if($add_permission_active)
                                <li id="customer-create-menu"><a href="{{route('customer.create')}}">{{trans('Add Customer')}}</a></li>
                            @endif
                        @endif
                        <?php
                            $index_permission = DB::table('permissions')->where('name', 'billers-index')->first();
                            $index_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $index_permission->id],
                                ['role_id', $role->id]
                            ])->first();
                        ?>
                        @if($index_permission_active)
                            <li id="biller-list-menu"><a href="{{route('biller.index')}}">{{trans('Biller List')}}</a></li>
                            <?php
                                $add_permission = DB::table('permissions')->where('name', 'billers-add')->first();
                                $add_permission_active = DB::table('role_has_permissions')->where([
                                    ['permission_id', $add_permission->id],
                                    ['role_id', $role->id]
                                ])->first();
                            ?>
                            @if($add_permission_active)
                                <li id="biller-create-menu"><a href="{{route('biller.create')}}">{{trans('Add Biller')}}</a></li>
                            @endif
                        @endif
                        <?php
                            $index_permission = DB::table('permissions')->where('name', 'suppliers-index')->first();
                            $index_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $index_permission->id],
                                ['role_id', $role->id]
                            ])->first();
                        ?>
                        @if($index_permission_active)
                            <li id="supplier-list-menu"><a href="{{route('supplier.index')}}">{{trans('Supplier List')}}</a></li>
                            <?php
                                $add_permission = DB::table('permissions')->where('name', 'suppliers-add')->first();
                                $add_permission_active = DB::table('role_has_permissions')->where([
                                    ['permission_id', $add_permission->id],
                                    ['role_id', $role->id]
                                ])->first();
                            ?>
                            @if($add_permission_active)
                                <li id="supplier-create-menu"><a href="{{route('supplier.create')}}">{{trans('Add Supplier')}}</a></li>
                            @endif
                        @endif
                    </ul>
                </li>

                <?php if($check_is_subscribed == '1') { ?>

                <li><a href="#report" aria-expanded="false" data-toggle="collapse">
                        <i class="dripicons-document-remove"></i>
                        <span>{{trans('Reports')}}</span>
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
                        @if($profit_loss_active)
                            <li id="profit-loss-report-menu">
                                {!! Form::open(['route' => 'report.profitLoss', 'method' => 'post', 'id' => 'profitLoss-report-form']) !!}
                                <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                                <a id="profitLoss-link" href="">{{ trans('Summary Report') }}</a>
                                {!! Form::close() !!}
                            </li>
                        @endif
                        @if($best_seller_active)
                            <li id="best-seller-report-menu">
                                <a href="{{ url('report/best_seller') }}">{{ trans('Best Seller') }}</a>
                            </li>
                        @endif
                        @if($product_report_active)
                            <li id="product-report-menu">
                                {!! Form::open(['route' => 'report.product', 'method' => 'post', 'id' => 'product-report-form']) !!}
                                <input type="hidden" name="start_date" value="1988-04-18" />
                                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                                <input type="hidden" name="warehouse_id" value="0" />
                                <a id="report-link" href="">{{ trans('Product Report') }}</a>
                                {!! Form::close() !!}
                            </li>
                        @endif
                        @if($daily_sale_active)
                            <li id="daily-sale-report-menu">
                                <a href="{{ url('report/daily_sale/'.date('Y').'/'.date('m')) }}">{{ trans('Daily Sale') }}</a>
                            </li>
                        @endif
                        @if($monthly_sale_active)
                            <li id="monthly-sale-report-menu">
                                <a href="{{url('report/monthly_sale/'.date('Y'))}}">{{trans('file.Monthly Sale')}}</a>
                            </li>
                        @endif
                        @if($daily_purchase_active)
                            <li id="daily-purchase-report-menu">
                                <a href="{{url('report/daily_purchase/'.date('Y').'/'.date('m'))}}">{{trans('Daily Purchase')}}</a>
                            </li>
                        @endif
                        @if($monthly_purchase_active)
                            <li id="monthly-purchase-report-menu">
                                <a href="{{url('report/monthly_purchase/'.date('Y'))}}">{{trans('Monthly Purchase')}}</a>
                            </li>
                        @endif
                        @if($sale_report_active)
                            <li id="sale-report-menu">
                                {!! Form::open(['route' => 'report.sale', 'method' => 'post', 'id' => 'sale-report-form']) !!}
                                <input type="hidden" name="start_date" value="1988-04-18" />
                                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                                <input type="hidden" name="warehouse_id" value="0" />
                                <a id="sale-report-link" href="">{{trans('Sale Report')}}</a>
                                {!! Form::close() !!}
                            </li>
                        @endif
                        @if($payment_report_active)
                            <li id="payment-report-menu">
                                {!! Form::open(['route' => 'report.paymentByDate', 'method' => 'post', 'id' => 'payment-report-form']) !!}
                                <input type="hidden" name="start_date" value="1988-04-18" />
                                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                                <a id="payment-report-link" href="">{{trans('Payment Report')}}</a>
                                {!! Form::close() !!}
                            </li>
                        @endif
                        @if($purchase_report_active)
                            <li id="purchase-report-menu">
                                {!! Form::open(['route' => 'report.purchase', 'method' => 'post', 'id' => 'purchase-report-form']) !!}
                                <input type="hidden" name="start_date" value="1988-04-18" />
                                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                                <input type="hidden" name="warehouse_id" value="0" />
                                <a id="purchase-report-link" href="">{{trans('Purchase Report')}}</a>
                                {!! Form::close() !!}
                            </li>
                        @endif
                        @if($warehouse_report_active)
                            <li id="warehouse-report-menu">
                                <a id="warehouse-report-link" href="">{{trans('Warehouse Report')}}</a>
                            </li>
                        @endif
                        @if($warehouse_stock_report_active)
                            <li id="warehouse-stock-report-menu">
                                <a href="{{route('report.warehouseStock')}}">{{trans('Warehouse Stock Chart')}}</a>
                            </li>
                        @endif
                        @if($product_qty_alert_active)
                            <li id="qtyAlert-report-menu">
                                <a href="{{route('report.qtyAlert')}}">{{trans('Product Quantity Alert')}}</a>
                            </li>
                        @endif
                        @if($user_report_active)
                            <li id="user-report-menu">
                                <a id="user-report-link" href="">{{trans('User Report')}}</a>
                            </li>
                        @endif
                        @if($customer_report_active)
                            <li id="customer-report-menu">
                                <a id="customer-report-link" href="">{{trans('Customer Report')}}</a>
                            </li>
                        @endif
                        @if($supplier_report_active)
                            <li id="supplier-report-menu">
                                <a id="supplier-report-link" href="">{{trans('Supplier Report')}}</a>
                            </li>
                        @endif
                        @if($due_report_active)
                            <li id="due-report-menu">
                                {!! Form::open(['route' => 'report.dueByDate', 'method' => 'post', 'id' => 'due-report-form']) !!}
                                <input type="hidden" name="start_date" value="1988-04-18" />
                                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                                <a id="due-report-link" href="">{{trans('Due Report')}}</a>
                                {!! Form::close() !!}
                            </li>
                        @endif
                    </ul>
                </li>
                <?php } ?>

                <li><a href="#setting" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-gear"></i><span>{{trans('Settings')}}</span></a>
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
                        <li id="role-menu"><a href="{{ route('role.index') }}">{{ trans('Role Permission') }}</a></li>
                        <?php } ?>
                        @if($warehouse_permission_active)
                            <li id="warehouse-menu"><a href="{{ route('warehouse.index') }}">{{ trans('Warehouse') }}</a></li>
                        @endif
                        @if($customer_group_permission_active)
                            <li id="customer-group-menu"><a href="{{ route('customer_group.index') }}">{{ trans('Customer Group') }}</a></li>
                        @endif
                        @if($brand_permission_active)
                            <li id="brand-menu"><a href="{{ route('brand.index') }}">{{ trans('Brand') }}</a></li>
                        @endif
                        @if($unit_permission_active)
                            <li id="unit-menu"><a href="{{ route('unit.index') }}">{{ trans('Unit') }}</a></li>
                        @endif
                        @if($tax_permission_active)
                            <li id="tax-menu"><a href="{{ route('tax.index') }}">{{ trans('Tax') }}</a></li>
                        @endif
                        <li id="user-menu"><a href="{{ route('user.profile', ['id' => Auth::id()]) }}">{{ trans('User Profile') }}</a></li>
                        @if($create_sms_permission_active)
                            <li id="create-sms-menu"><a href="{{ route('setting.createSms') }}">{{ trans('Create SMS') }}</a></li>
                        @endif
                        @if($general_setting_permission_active)
                            <li id="general-setting-menu"><a href="{{ route('setting.general') }}">{{ trans('General Setting') }}</a></li>
                        @endif
                        @if($mail_setting_permission_active)
                            <li id="mail-setting-menu"><a href="{{ route('setting.mail') }}">{{ trans('Mail Setting') }}</a></li>
                        @endif
                        @if($sms_setting_permission_active)
                            <li id="sms-setting-menu"><a href="{{ route('setting.sms') }}">{{ trans('SMS Setting') }}</a></li>
                        @endif
                        @if($pos_setting_permission_active)
                            <li id="pos-setting-menu"><a href="{{ route('setting.pos') }}">POS {{ trans('settings') }}</a></li>
                        @endif
                        @if($hrm_setting_permission_active)
                            <li id="hrm-setting-menu"><a href="{{ route('setting.hrm') }}"> {{ trans('HRM Setting') }}</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>