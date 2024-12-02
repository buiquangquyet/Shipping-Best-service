@if (auth()->user()->hasDirectPermissionCustom('clients.index'))
    <li class="header">@lang('common.Clients')</li>

    <li class="treeview menu-item" style="height: auto;">
        <a href="#" class="treeview"><i class="fa fa-truck"></i>
            <span>@lang('common.Clients')</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu" style="{{ (request()->is('check-price*', 'widget/*')) ? '' : 'display: none;' }}">
            <li>
                <a href="{{route('clients.index')}}"><i
                            class="fa fa-truck"></i>Tất cả</a>
            </li>
            <li  >
                <a href="{{route('client-config-price.show')}}"><i
                            class="fa fa-cogs"></i>Cài đặt bảng giá GHN</a>

            </li>
            <li  >
                <a href="{{route('client-pricing-table.njv.index')}}"><i
                            class="fa fa-cogs"></i>Cài đặt bảng giá NJV</a>

            </li>
            <li  >
                <a href="{{route('client-pricing-table.configBest')}}"><i
                            class="fa fa-cogs"></i>Cài đặt bảng giá BEST</a>

            </li>
            <li  >
                <a href="{{route('client-pricing-table.configVtp')}}"><i
                            class="fa fa-cogs"></i>Cài đặt bảng giá VTP</a>

            </li>

            <li>
                <a href="{{route('client-pricing-table.be.index')}}"><i
                            class="fa fa-cogs"></i>Cài đặt markup BE</a>

            </li>
        </ul>
    </li>
@endif
