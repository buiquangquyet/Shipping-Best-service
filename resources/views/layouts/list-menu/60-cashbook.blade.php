@if (auth()->user()->hasDirectPermissionCustom('cashbook-new.index'))
    <li class="header">@lang('common.Cash Books')</li>
    <li class="menu-item">
        <a href="{{route('cashbook-new.index')}}"><i class="fa fa-money"></i>
            <span>Phiếu thu chi</span></a>
    </li>
@endif
@if (auth()->user()->hasDirectPermissionCustom('cashbook-new.index'))
    <li class="menu-item">
        <a href="{{route('cashbook-new.index', ['type' => 'adjust'])}}"><i class="fa fa-money"></i>
            <span>Phiếu điều chỉnh</span></a>
    </li>
@endif
@if (auth()->user()->hasDirectPermissionCustom('commissions.index'))
    <li class="treeview" style="height: auto;">
        <a href="#">
            <i class="fa fa-money"></i>
            <span>Chiết khấu HVC</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu" style="display: none;">
            <li><a href="{{route('commissions.index')}}"><i
                            class="fa fa-money"></i><span>Phiếu chiết khấu</span></a></li>
            <li><a href="{{route('commission-setting.index')}}"><i class="fa fa-gear"></i><span>Cấu hình chiết khấu</span></a>
            </li>
        </ul>
    </li>
@endif
