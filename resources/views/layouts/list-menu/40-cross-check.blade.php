@if (auth()->user()->hasDirectPermissionCustom('cross-check.index'))
    <li class="header">@lang('common.Checkers')</li>
    <li class="menu-item">
        <a href="{{route('cross-check.index')}}"><i class="fa fa-check-square-o"></i>
            <span>@lang('common.Checkers') HVC</span></a>
    </li>
@endif
@if (auth()->user()->hasDirectPermissionCustom('cross-check-shop.index'))
    <li class="menu-item">
        <a href="{{route('cross-check-shop.index')}}"><i class="fa fa-check-square-o"></i> <span>@lang('common.Checkers') GH</span></a>
    </li>
@endif
@if (auth()->user()->hasDirectPermissionCustom('cross-check-fw.index'))
    <li class="menu-item">
        <a href="{{route('cross-check-fw.index')}}"><i class="fa fa-check-square-o"></i> <span>@lang('common.Checkers') FW</span></a>
    </li>
@endif

@if (auth()->user()->hasDirectPermissionCustom('cross-check.storage.index'))
    <li class="menu-item">
        <a href="{{route('cross-check.storage.index')}}"><i class="fa fa-database"></i>
            <span>Đối soát lưu trữ</span></a>
    </li>
@endif
