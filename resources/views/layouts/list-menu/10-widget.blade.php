
<li class="treeview {{ (request()->is('check-price*', 'widget/*')) ? 'active menu-open' : '' }}" style="height: auto;">
    <a href="#">
        <i class="fa fa-registered"></i>
        <span>Widget</span>
        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu"
        style="{{ (request()->is('check-price*', 'widget/*')) ? '' : 'display: none;' }}">
        <li class="{{ request()->is('check-price') ? 'active' : '' }}">
            <a href="{{route('home.check-price')}}"><i class="fa fa-calculator"></i>
                <span>Tính phí giao - v1</span></a>
        </li>
        <li class="{{ request()->is('check-price/v2') ? 'active' : '' }}">
            <a href="{{route('home.check-price-2')}}"><i class="fa fa-calculator"></i>
                <span>Tính phí giao - v2</span></a>
        </li>
        <li class="{{ request()->is('check-price/ticket') ? 'active' : '' }}">
            <a href="{{route('home.ticket')}}"><i class="fa fa-ticket"></i>
                <span>Ticket</span></a>
        </li>
        <li class="{{ request()->is('check-price/ticket-activity') ? 'active' : '' }}">
            <a href="{{route('home.ticket.activity')}}"><i class="fa fa-ticket"></i>
                <span>Ticket Activity</span></a>
        </li>
        <li class="{{ request()->is('widget/onboarding') ? 'active' : '' }}">
            <a href="{{route('widget.onboarding')}}"><i class="fa fa-ticket"></i>
                <span>Widget v3 - Onboarding</span></a>
        </li>
        <li class="{{ request()->is('widget/orders') ? 'active' : '' }}">
            <a href="{{route('widget.orders.list')}}" target="_blank"><i class="fa fa-ticket"></i>
                <span>Widget v3 - Quản lý vận đơn</span></a>
        </li>
        <li class="{{ request()->is('widget/multiorders') ? 'active' : '' }}">
            <a href="{{route('widget.orders.multiorders')}}" target="_blank"><i class="fa fa-ticket"></i>
                <span>Widget - Multi orders</span></a>
        </li>
        <li class="{{ request()->is('widget/widget-mobile') ? 'active' : '' }}">
            <a href="{{env('SHIPPING_API_URL', 'https://shipping.kvpos.com:64912').'/test-widget-mobile-v3'}}" target="_blank"><i class="fa fa-mobile"></i>
                <span>Widget - Mobile V3</span></a>
        </li>
        <li class="{{ request()->is('check-price/wigetprice') ? 'active' : '' }}">
            <a href="{{route('home.wigetprice')}}" target="_blank"><i class="fa fa-ticket"></i>
                <span>Widget - Check price v2.1</span></a>
        </li>
        <li class="{{ request()->is('check-price/widget-price-v3') ? 'active' : '' }}">
            <a href="{{route('home.widgetPriceV3')}}" target="_blank"><i class="fa fa-ticket"></i>
                <span>Widget - Check price v3</span></a>
        </li>
        <li class="{{ request()->is('check-price/widget-price-v4') ? 'active' : '' }}">
            <a href="{{route('home.widgetPriceV4')}}" target="_blank"><i class="fa fa-ticket"></i>
                <span>Widget - Check price v4</span></a>
        </li>
        <li class="{{ request()->is('check-price/widget-another-bill') ? 'active' : '' }}">
            <a href="{{route('home.widgetAnotherBill')}}" target="_blank"><i class="fa fa-ticket"></i>
                <span>Widget - Another bill</span></a>
        </li>
        <li class="{{ request()->is('check-price/widget-new-onboarding') ? 'active' : '' }}">
            <a href="{{route('home.widgetNewOnboarding')}}" target="_blank"><i class="fa fa-ticket"></i>
                <span>Widget - New Onboarding</span></a>
        </li>
        <li class="{{ request()->is('widget/widget-payment') ? 'active' : '' }}">
            <a href="{{route('home.widgetPayment')}}" target="_blank"><i class="fa fa-ticket"></i>
                <span>Widget - Payment</span></a>
        </li>
    </ul>
</li>
