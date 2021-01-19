<header class="header">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <a id="toggle-btn" href="#" class="menu-btn"><i class="fa fa-bars"> </i></a>
                <span class="brand-big">@if($general_setting->site_logo)<img src="{{url('public/logo', $general_setting->site_logo)}}" width="50">&nbsp;&nbsp;@endif
                            <a href="{{url('/')}}">
                                <h1 class="d-inline">{{$general_setting->site_title}}</h1>
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
                    @if($add_permission_active)
                        <li class="nav-item"><a class="dropdown-item btn-pos btn-sm" href="{{ route('sale.pos') }}"><i class="dripicons-shopping-bag"></i><span> POS</span></a></li>
                    @endif
                    <li class="nav-item"><a id="btnFullscreen"><i class="dripicons-expand"></i></a></li>
                    @if($alert_product > 0)
                        <li class="nav-item">
                            <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item">
                                <i class="dripicons-bell"></i>
                                <span class="badge badge-danger">{{ $alert_product }}</span>
                            </a>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default notifications" user="menu">
                                <li class="notifications">
                                    <a href="{{ route('report.qtyAlert') }}" class="btn btn-link"> {{ $alert_product }} product exceeds alert quantity</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{ url('read_me') }}" target="_blank"><i class="dripicons-information"></i> {{trans('Help')}}</a>
                    </li>
                    <li class="nav-item">
                        <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item">
                            <i class="dripicons-user"></i>
                            <span>{{ucfirst(Auth::user()->name)}}</span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                            <li>
                                @if($role->id==7)
                                    <a href="{{ route('user.profile', ['id' => Auth::id()]) }}"><i class="dripicons-user"></i> {{ trans('User Profile') }}</a>
                                    <a href="{{ route('seller.edit', ['id' => Auth::id()]) }}"><i class="dripicons-user"></i> {{ trans('Business Profile') }}</a>
                                @else
                                    <a href="{{ route('user.profile', ['id' => Auth::id()]) }}"><i class="dripicons-user"></i> {{ trans('Profile') }}</a>
                                @endif
                            </li>
                            @if($general_setting_permission_active)
                                <li>
                                    <a href="{{ route('setting.general') }}"><i class="dripicons-gear"></i> {{ trans('Settings') }}</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('stransaction.index') }}"><i class="dripicons-swap"></i>{{ trans('Seller Transaction') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('holidays/my-holiday/'.date('Y').'/'.date('m')) }}"><i class="dripicons-vibrate"></i> {{ trans('My Holiday') }}</a>
                            </li>
                            @if($empty_database_permission_active)
                                <li>
                                    <a onclick="return confirm('Are you sure want to delete? If you do this all of your data will be lost.')" href="{{ route('setting.emptyDatabase') }}"><i class="dripicons-stack"></i> {{ trans('Empty Database') }}</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><i class="dripicons-power"></i>
                                    {{ trans('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>