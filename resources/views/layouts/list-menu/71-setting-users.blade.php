@if (auth()->user()->hasDirectPermissionCustom('users.index') || auth()->user()->hasDirectPermissionCustom('roles.index') || auth()->user()->hasDirectPermissionCustom('permissions.index'))
    <li class="treeview {{ (request()->is('users') || request()->is('roles') || request()->is('permissions') || request()->is('users/*') || request()->is('roles/*') || request()->is('permissions/*')) ? 'active menu-open' : '' }}">
        <a href="#">
            <i class="fa fa-users"></i> <span>Quản lý người dùng</span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
            @if (auth()->user()->hasDirectPermissionCustom('users.index'))
                <li class="{{ request()->is('users') ? 'active' : '' }}"><a href="{{route('users.index')}}"><i
                                class="fa fa-circle-o"></i> Danh sách người dùng</a></li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('roles.index'))
                <li class="{{ request()->is('roles') ? 'active' : '' }}"><a href="{{route('roles.index')}}"><i
                                class="fa fa-circle-o"></i> Vai trò hệ thống</a></li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('permissions.index'))
                <li class="{{ request()->is('permissions') ? 'active' : '' }}"><a
                            href="{{route('permissions.index')}}"><i
                                class="fa fa-circle-o"></i> Chức năng hệ thống</a></li>
            @endif
        </ul>
    </li>
@endif
