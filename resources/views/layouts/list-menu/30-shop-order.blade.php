@if (auth()->user()->hasDirectPermissionCustom('shops.index'))
    <li class="header">@lang('common.Shops') & @lang('common.Ladings')
    <li class="menu-item">
        <a href="{{route('shops.index')}}"><i class="fa fa-shopping-cart"></i>
            <span>@lang('common.Shops')</span></a>
    </li>
@endif

@if (auth()->user()->hasDirectPermissionCustom('ladings.index'))
    <li class="menu-item">
        <a href="{{route('ladings.index')}}"><i class="fa fa-list"></i>
            <span>@lang('common.Ladings')</span></a>
    </li>
@endif

@if (auth()->user()->hasDirectPermissionCustom('lading.care.index'))
    <li class="menu-item">
        <a href="{{route('lading.care.index')}}"><i class="fa fa-warning"></i>
            <span>Vận đơn cần xử lý</span></a>
    </li>
@endif

@if (auth()->user()->hasDirectPermissionCustom('lading.mongo.storage.index'))
    <li class="menu-item">
        <a href="{{route('lading.mongo.storage.index')}}"><i class="fa fa-database"></i>
            <span>Vận đơn Mongo lưu trữ</span></a>
    </li>
@endif

@if (auth()->user()->hasDirectPermissionCustom('lading.return.index'))
    <li class="menu-item">
        <a href="{{route('lading.return.index')}}"><i class="fa fa-refresh"></i>
            <span>Vận đơn Chuyển hoàn</span></a>
    </li>
@endif

@if (auth()->user()->hasDirectPermissionCustom('allLadingKship.index'))
    <li class="menu-item">
        <a href="{{route('allLadingKship.index')}}"><i class="fa fa-database"></i>
            <span>Tất cả vận đơn Kship</span></a>
    </li>
@endif

<li class="menu-item">
    <a href="{{route('ladings.cancel.index')}}"><i class="fa fa-database"></i>
        <span>Vận đơn cần hủy</span></a>
</li>

@if (auth()->user()->hasDirectPermissionCustom('ladingRefresh.index'))
    <li class="{{ request()->is('lading-refresh') || request()->is('lading-refresh/*') ? 'active' : '' }}">
        <a href="{{route('ladingRefresh.index')}}"><i class="fa fa-database"></i>
            <span>Vận đơn cần refresh</span></a>
    </li>
@endif
@if (auth()->user()->hasDirectPermissionCustom('ladings.listSpecial'))
    <li class="{{ request()->is('ladings/list-special') || request()->is('ladings/list-special/*') ? 'active' : '' }}">
        <a href="{{route('ladings.listSpecial')}}"><i class="fa fa-circle-o"></i> Xử lý đơn đặc
            biệt</a>
    </li>
@endif
@if (auth()->user()->hasDirectPermissionCustom('promotion.index'))
    <li class="menu-item">
        <a href="{{route('promotion.index')}}"><i class="fa fa-star"></i>
            <span>Khuyến mại</span></a>
    </li>
@endif

@if (auth()->user()->hasDirectPermissionCustom('emails.index'))
    <li class="menu-item">
        <a href="{{route('emails.index')}}"><i class="fa fa-newspaper-o"></i>
            <span>Gửi thông báo</span></a>
    </li>
@endif

@if (auth()->user()->hasDirectPermissionCustom('vouchers.index'))
    <li class="menu-item">
        <a href="{{route('vouchers.index')}}"><i class="fa fa-star"></i>
            <span>Vouchers</span></a>
    </li>
@endif

@if (auth()->user()->hasDirectPermissionCustom('voucher.get-list'))
    <li class="menu-item">
        <a href="{{route('voucher.get-list')}}"><i class="fa fa-star"></i>
            <span>VouchersV3</span></a>
    </li>
@endif

@if (auth()->user()->hasDirectPermissionCustom('voucher-v4.list'))
    <li class="menu-item">
        <a href="{{route('voucher-v4.list')}}"><i class="fa fa-star"></i>
            <span>VouchersV4</span></a>
    </li>
@endif