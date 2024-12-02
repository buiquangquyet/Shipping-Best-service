@if (request()->is('file-logs/list')  || auth()->user()->hasDirectPermissionCustom('ladings.listSpecial') || auth()->user()->hasDirectPermissionCustom('ladingRefresh.index') || auth()->user()->hasDirectPermissionCustom('location.address') || auth()->user()->hasDirectPermissionCustom('simulator') || auth()->user()->hasDirectPermissionCustom('tool.check-phone') || auth()->user()->hasDirectPermissionCustom('tool.lading.force-update.index'))
    <li class="treeview {{ (request()->is('ladings/*') || request()->is('tools/*')) ? 'active menu-open' : '' }}">
        <a href="#">
            <i class="fa fa-cube"></i> <span>Công cụ hỗ trợ</span>
            <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ request()->is('file-logs/list') ? 'active' : '' }}">
                <a href="{{url('file-logs/list')}}"><i class="fa fa-circle-o"></i>Xử lý file log webhook</a>
            </li>
            @if (auth()->user()->hasDirectPermission('location.address'))
                <li class="{{ request()->is('tools/locations') || request()->is('tools/locations/*') ? 'active' : '' }}">
                    <a
                            href="{{route('location.address')}}"><i class="fa fa-circle-o"></i> List
                        location</a></li>
            @endif
            @if (auth()->user()->hasDirectPermission('location.v2.address'))
                <li class="{{ request()->is('tools/locations/v2') || request()->is('tools/locations/v2/*') ? 'active' : '' }}">
                    <a
                            href="{{route('location.v2.address')}}"><i class="fa fa-circle-o"></i> List
                        location v2</a></li>
            @endif
            @if (auth()->user()->hasDirectPermission('kship-location.index'))
                <li class="{{ request()->is('tools/kship-locations') || request()->is('tools/kship-locations/*') ? 'active' : '' }}">
                    <a href="{{route('kship-location.index')}}">
                        <i class="fa fa-circle-o"></i> KShip location</a></li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('simulator'))
                <li class="{{ request()->is('tools/simulator') || request()->is('tools/simulator/*') ? 'active' : '' }}">
                    <a
                            href="{{url('tools/simulator')}}"><i class="fa fa-circle-o"></i> Simulator</a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('tool.check-phone'))
                <li class="{{ request()->is('tools/check-phone') || request()->is('tools/check-phone/*') ? 'active' : '' }}">
                    <a href="{{route('tool.check-phone')}}"><i class="fa fa-circle-o"></i> Kiểm tra SĐT</a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('tool.lading.force-update.index'))
                <li class="{{ request()->is('tools/lading-force-update') || request()->is('tools/lading-force-update/*') ? 'active' : '' }}">
                    <a href="{{route('tool.lading.force-update.index')}}"><i class="fa fa-circle-o"></i> Cập
                        nhật dữ liệu đối soát</a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermission('tool.shop.force-update.index'))
                <li class="{{ request()->is('tools/shop-force-update') || request()->is('tools/shop-force-update/*') ? 'active' : '' }}">
                    <a href="{{route('tool.shop.force-update.index', ['type' => \App\Core\Data\Common::IMPORT_TYPE_UPDATE_SHOP_ADDRESS])}}"><i class="fa fa-circle-o"></i> Cập
                        nhật dữ liệu gian hàng</a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermission('ticket.param.index'))
                <li class="{{ request()->is('tickets/params') ? 'active' : '' }}">
                    <a href="{{route('ticket.param.index')}}"><i class="fa fa-circle-o"></i> Quản lý dữ liệu
                        Tạo Yêu Cầu </a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermission('tools.update-total.index'))
                <li class="{{ request()->is('tools/update-total/index') ? 'active' : '' }}">
                    <a href="{{route('tools.update-total.index')}}"><i class="fa fa-circle-o"></i> Cập nhật phí thu shop </a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermission('tool.support-cross-check.index'))
                <li class="{{ request()->is('tool/support-cross-check') ? 'active' : '' }}">
                    <a href="{{route('tool.support-cross-check.index')}}"><i class="fa fa-circle-o"></i> Support ĐS </a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermission('tool.banks.list-bank-kship'))
                <li class="{{ request()->is('tool/banks/list-bank-kship') ? 'active' : '' }}">
                    <a href="{{route('tool.banks.list-bank-kship')}}"><i class="fa fa-circle-o"></i> List bank Kship </a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermission('tool.banks.list-bank-merchant'))
                <li class="{{ request()->is('tool/banks/list-bank-merchant') ? 'active' : '' }}">
                    <a href="{{route('tool.banks.list-bank-merchant')}}"><i class="fa fa-circle-o"></i> List bank merchant </a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermission('tool.email.check'))
                <li class="{{ request()->is('tools/email/check') ? 'active' : '' }}">
                    <a href="{{route('tool.email.check')}}"><i class="fa fa-circle-o"></i> Check email send </a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('tool.kafka.push-message-simulation'))
                <li class="{{ request()->is('tool/kafka/push-message-simulation') ? 'active' : '' }}">
                    <a href="{{route('tool.kafka.push-message-simulation')}}"><i class="fa fa-circle-o"></i> Push data to Kafka Simulation </a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermission('tool.bill.list'))
                <li class="{{ request()->is('tool/bill/list') ? 'active' : '' }}">
                    <a href="{{route('tool.bill.list')}}"><i class="fa fa-circle-o"></i> List Bill error </a>
                </li>
            @endif

            @if (auth()->user()->hasDirectPermission('tool.update-data-to-retail.index'))
                <li class="{{ request()->is('tool/update-data-to-retail/index') ? 'active' : '' }}">
                    <a href="{{route('tool.update-data-to-retail.index')}}"><i class="fa fa-circle-o"></i> Cập nhật dữ liệu sang Retail </a>
                </li>
            @endif

            @if (auth()->user()->hasDirectPermissionCustom('tool.kyc.index'))
                <li class="{{ request()->is('tool/sync-all-shop/index') ? 'active' : '' }}">
                    <a href="{{route('tool.kyc.index')}}"><i class="fa fa-circle-o"></i> Cập nhật dữ liệu shop sang KYC </a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('tool.sync-retail-data.index'))
                <li class="{{ request()->is('tool/sync-retail-data/index') ? 'active' : '' }}">
                    <a href="{{route('tool.sync-retail-data.index')}}"><i class="fa fa-circle-o"></i> Kéo dữ liệu vận đơn Retail </a>
                </li>
            @endif
        </ul>
    </li>
@endif

