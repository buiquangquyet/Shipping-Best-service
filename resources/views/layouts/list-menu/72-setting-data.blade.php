@if (auth()->user()->hasDirectPermissionCustom('bank.shop'))
    <li class="treeview {{ (request()->is('banks') || request()->is('banks/*') || request()->is('promotions/shops') || request()->is('promotions/shops/*') || request()->is('data/shops') || request()->is('data/shops/*')) ? 'active menu-open' : '' }}">
        <a href="#">
            <i class="fa fa-database"></i> <span>Dữ liệu</span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
{{--            @if (auth()->user()->hasDirectPermissionCustom('bank.shop'))--}}
{{--                <li class="{{ request()->is('banks/shops') || request()->is('banks/shops/*') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('bank.shop')}}">--}}
{{--                        <i class="fa fa-bank"></i> Danh sách ngân hàng</a></li>--}}
{{--            @endif--}}
            @if (auth()->user()->hasDirectPermissionCustom('promotion.shop.index'))
                <li class="{{ request()->is('promotions/shops') || request()->is('promotions/shops/*') ? 'active' : '' }}">
                    <a href="{{route('promotion.shop.index')}}">
                        <i class="fa fa-star"></i> Gán mã khuyến mại</a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('feedbacks.index'))
                <li class="{{ request()->is('feedbacks') || request()->is('feedbacks/*') ? 'active' : '' }}">
                    <a href="{{route('feedbacks.index')}}">
                        <i class="fa fa-star"></i> Quản lý đánh giá</a>
                </li>
            @endif
{{--            @if (auth()->user()->hasDirectPermissionCustom('data.shop.index'))--}}
{{--                <li class="{{ request()->is('data/shops') || request()->is('data/shops/*') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('data.shop.index')}}">--}}
{{--                        <i class="fa fa-shopping-cart"></i> Thông tin gian hàng</a>--}}
{{--                </li>--}}
{{--            @endif--}}
        </ul>
    </li>
@endif
