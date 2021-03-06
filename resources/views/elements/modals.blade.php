<!-- expense modal -->
<div id="expense-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('Add Expense')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => 'expenses.store', 'method' => 'post']) !!}
                <?php
                    $lims_expense_category_list = DB::table('expense_categories')->where('is_active', true)->get();
                    $lims_warehouse_list = DB::table('warehouses')->where('is_active', true)->get();
                    $lims_account_list = \App\Account::where('is_active', true)->get();
                ?>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>{{trans('Expense Category')}} *</label>
                        <select name="expense_category_id" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select Expense Category...">
                            @foreach($lims_expense_category_list as $expense_category)
                                <option value="{{ $expense_category->id }}">{{ $expense_category->name . ' (' . $expense_category->code. ')' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('Warehouse')}} *</label>
                        <select name="warehouse_id" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select Warehouse...">
                            @foreach($lims_warehouse_list as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('Amount')}} *</label>
                        <input type="number" name="amount" step="any" required class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label> {{trans('Account')}}</label>
                        <select class="form-control selectpicker" name="account_id">
                            @foreach($lims_account_list as $account)
                                @if($account->is_default)
                                    <option selected value="{{ $account->id }}">{{ $account->name }} [{{ $account->account_no }}]</option>
                                @else
                                    <option value="{{ $account->id }}">{{ $account->name }} [{{ $account->account_no }}]</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{trans('Note')}}</label>
                    <textarea name="note" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{trans('submit')}}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<!-- account modal -->
<div id="account-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('Add Account')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => 'accounts.store', 'method' => 'post']) !!}
                <div class="form-group">
                    <label>{{trans('Account No')}} *</label>
                    <input type="text" name="account_no" required class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('name')}} *</label>
                    <input type="text" name="name" required class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('Initial Balance')}}</label>
                    <input type="number" name="initial_balance" step="any" class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('Note')}}</label>
                    <textarea name="note" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{trans('submit')}}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<!-- account statement modal -->
<div id="account-statement-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('Account Statement')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => 'accounts.statement', 'method' => 'post']) !!}
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label> {{trans('Account')}}</label>
                        <select class="form-control selectpicker" name="account_id">
                            @foreach($lims_account_list as $account)
                                <option value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label> {{trans('file.Type')}}</label>
                        <select class="form-control selectpicker" name="type">
                            <option value="0">{{trans('All')}}</option>
                            <option value="1">{{trans('Debit')}}</option>
                            <option value="2">{{trans('Credit')}}</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>{{trans('file.Choose Your Date')}}</label>
                        <div class="input-group">
                            <input type="text" class="daterangepicker-field form-control" required />
                            <input type="hidden" name="start_date" />
                            <input type="hidden" name="end_date" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{trans('submit')}}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<!-- warehouse modal -->
<div id="warehouse-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('Warehouse Report')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => 'report.warehouse', 'method' => 'post']) !!}
                <?php
                    $lims_warehouse_list = DB::table('warehouses')->where('is_active', true)->get();
                ?>
                <div class="form-group">
                    <label>{{trans('file.Warehouse')}} *</label>
                    <select name="warehouse_id" class="selectpicker form-control" required data-live-search="true" id="warehouse-id" data-live-search-style="begins" title="Select warehouse...">
                        @foreach($lims_warehouse_list as $warehouse)
                            <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="start_date" value="1988-04-18" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{trans('submit')}}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<!-- user modal -->
<div id="user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('User Report')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => 'report.user', 'method' => 'post']) !!}
                <?php
                    $lims_user_list = DB::table('users')->where('is_active', true)->get();
                ?>
                <div class="form-group">
                    <label>{{trans('User')}} *</label>
                    <select name="user_id" class="selectpicker form-control" required data-live-search="true" id="user-id" data-live-search-style="begins" title="Select user...">
                        @foreach($lims_user_list as $user)
                            <option value="{{$user->id}}">{{$user->name . ' (' . $user->phone. ')'}}</option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="start_date" value="1988-04-18" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{trans('submit')}}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<!-- customer modal -->
<div id="customer-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('Customer Report')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => 'report.customer', 'method' => 'post']) !!}
                <?php
                    $lims_customer_list = DB::table('customers')->where('is_active', true)->get();
                ?>
                <div class="form-group">
                    <label>{{trans('customer')}} *</label>
                    <select name="customer_id" class="selectpicker form-control" required data-live-search="true" id="customer-id" data-live-search-style="begins" title="Select customer...">
                        @foreach($lims_customer_list as $customer)
                            <option value="{{$customer->id}}">{{$customer->name . ' (' . $customer->phone_number. ')'}}</option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="start_date" value="1988-04-18" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{trans('submit')}}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<!-- supplier modal -->
<div id="supplier-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('Supplier Report')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => 'report.supplier', 'method' => 'post']) !!}
                <?php
                    $lims_supplier_list = DB::table('suppliers')->where('is_active', true)->get();
                ?>
                <div class="form-group">
                    <label>{{trans('Supplier')}} *</label>
                    <select name="supplier_id" class="selectpicker form-control" required data-live-search="true" id="supplier-id" data-live-search-style="begins" title="Select Supplier...">
                        @foreach($lims_supplier_list as $supplier)
                            <option value="{{$supplier->id}}">{{$supplier->name . ' (' . $supplier->phone_number. ')'}}</option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="start_date" value="1988-04-18" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{trans('submit')}}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>