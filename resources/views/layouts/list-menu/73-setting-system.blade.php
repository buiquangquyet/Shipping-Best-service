@if (auth()->user()->hasDirectPermissionCustom('system.index') || auth()->user()->hasDirectPermissionCustom('setting.index'))
    <li class="treeview {{ (request()->is('system') || request()->is('setting') || request()->is('setting/external') || request()->is('config-price') || request()->is('config-price/config-level')) ? 'active menu-open' : '' }}">
        <a href="#">
            <i class="fa fa-sticky-note"></i> <span>Hệ thống</span>
            <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
            @if (auth()->user()->hasDirectPermissionCustom('system.index'))
                <li class="{{ request()->is('system') ? 'active' : '' }}"><a
                            href="{{route('system.index')}}"><i
                                class="fa fa-info-circle"></i> Thông tin cấu hình</a></li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('setting.index'))
                <li class="{{ request()->is('setting') ? 'active' : '' }}"><a
                            href="{{route('setting.index')}}"><i
                                class="fa fa-cogs"></i> Cài đặt</a></li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('setting.external.index'))
                <li class="{{ request()->is('setting/external') ? 'active' : '' }}"><a
                            href="{{route('setting.external.index')}}"><i
                                class="fa fa-link"></i> Endpoint</a></li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('config-price.index'))
                <li class="{{ request()->is('config-price') ? 'active' : '' }}"><a
                            href="{{route('config-price.index')}}"><i
                                class="fa fa-link"></i>Cài đặt bảng giá NinjaVan</a></li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('setting.location'))
                <li class="{{ request()->is('setting/location') ? 'active' : '' }}"><a
                            href="{{route('setting.location')}}"><i
                                class="fa fa-link"></i>Location Setting</a></li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('config-onboarding.index'))
                <li class="{{ request()->is('config-onboarding') ? 'active' : '' }}"><a
                            href="{{route('config-onboarding.index')}}"><i
                                class="fa fa-link"></i>Cài đặt onboarding</a></li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('config-banner.index'))
                <li class="{{ request()->is('config-banner.index') ? 'active' : '' }}"><a
                            href="{{route('config-banner.index')}}"><i
                                class="fa fa-link"></i>Quản lý Banners</a></li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('config-shop-onboarding-permission.index'))
                <li class="{{ request()->is('config-shop-onboarding-permission.index') ? 'active' : '' }}"><a
                            href="{{route('config-shop-onboarding-permission.index')}}"><i
                                class="fa fa-link"></i>Quản lý phân quyền của shop</a></li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('config-shop-order-management-report.index'))
                <li class="{{ request()->is('config-shop-order-management-report.index') ? 'active' : '' }}"><a
                            href="{{route('config-shop-order-management-report.index')}}"><i
                                class="fa fa-link"></i>Quản lý vận đơn report</a></li>
            @endif
        </ul>
    </li>
@endif
