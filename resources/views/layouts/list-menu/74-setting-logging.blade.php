@if (auth()->user()->hasDirectPermissionCustom('logging.index') || auth()->user()->hasDirectPermissionCustom('logging.index-fail') || auth()->user()->hasDirectPermissionCustom('pushCrossCheck.get') || auth()->user()->hasDirectPermissionCustom('logging.webhook-log') || auth()->user()->hasDirectPermissionCustom('webhookFail.list') || auth()->user()->hasDirectPermissionCustom('logging.email-log') || auth()->user()->hasDirectPermissionCustom('logging-health-check-app'))
    <li class="treeview {{ (request()->is('push-cross-check') || request()->is('logging') || request()->is('logging/*')) ? 'active menu-open' : '' }}">
        <a href="#">
            <i class="fa fa-history"></i> <span>Logging</span>
            <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
            @if(auth()->user()->hasDirectPermissionCustom('confirmWebHook.index'))
                <li class="{{ (request()->is('confirm-webhooks') || request()->is('confirm-webhooks/*')) ? 'active' : '' }}">
                    <a href="{{route('confirmWebHook.index')}}"><i class="fa fa-circle-o"></i> List Confirm
                        WebHook</a></li>
            @endif
                @if (auth()->user()->hasDirectPermissionCustom('logging.request-log'))
                    <li class="{{ (request()->is('logging/request-log') || request()->is('logging/*')  && !request()->is('logging/webhook-v3') && !request()->is('logging/webhook') && !request()->is('logging/webhook/*') && !request()->is('logging/email') && !request()->is('logging/email/*') && !request()->is('logging/index-fail') && !request()->is('logging/index-fail/*') && !request()->is('logging/health-check-app') && !request()->is('logging/health-check-app/*') && !request()->is('logging/operation-log') && !request()->is('logging/operation-log/*')  ) ? 'active' : '' }}">
                        <a href="{{route('logging.request-log')}}"><i class="fa fa-circle-o"></i> Request Log V3</a></li>
                @endif

            @if (auth()->user()->hasDirectPermissionCustom('logging.index'))
                <li class="{{ (request()->is('logging') || request()->is('logging/*') && !request()->is('logging/webhook-v3') && !request()->is('logging/webhook') && !request()->is('logging/webhook/*') && !request()->is('logging/email') && !request()->is('logging/email/*') && !request()->is('logging/index-fail') && !request()->is('logging/index-fail/*') && !request()->is('logging/health-check-app') && !request()->is('logging/health-check-app/*') && !request()->is('logging/operation-log') && !request()->is('logging/operation-log/*') && !request()->is('logging/request-log')) ? 'active' : '' }}">
                    <a href="{{route('logging.index')}}"><i class="fa fa-circle-o"></i> Request Log</a></li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('logging.index-fail'))
                <li class="{{ request()->is('logging/index-fail') || request()->is('logging/index-fail/*') ? 'active' : '' }}">
                    <a href="{{route('logging.index-fail')}}"><i class="fa fa-circle-o"></i> Request Log
                        Fail</a></li>
            @endif
            @if(auth()->user()->hasDirectPermissionCustom('pushCrossCheck.get'))
                <li class="{{ (request()->is('push-cross-check') || request()->is('push-cross-check/*')) ? 'active' : '' }}">
                    <a href="{{url('push-cross-check')}}"><i class="fa fa-circle-o"></i> Request push cross
                        check code</a>
                </li>
            @endif
                @if (auth()->user()->hasDirectPermissionCustom('logging.webhook-log-v3'))
                    <li class="{{ request()->is('logging/webhook-v3')  ? 'active' : '' }}">
                        <a href="{{route('logging.webhook-log-v3')}}"><i class="fa fa-circle-o"></i> Webhook
                            Log V3</a>
                    </li>
                @endif
            @if (auth()->user()->hasDirectPermissionCustom('logging.webhook-log'))
                <li class="{{ (request()->is('logging/webhook') || request()->is('logging/webhook/*')) ? 'active' : '' }}">
                    <a href="{{route('logging.webhook-log')}}"><i class="fa fa-circle-o"></i> Webhook
                        Log</a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('webhookFail.list'))
                <li class="{{ (request()->is('webhook-fails') || request()->is('webhook-fails/*')) ? 'active' : '' }}">
                    <a
                            href="{{route('webhookFail.list')}}"><i class="fa fa-circle-o"></i> Webhook Fail</a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('logging.email-log'))
                <li class="{{ request()->is('logging/email') || request()->is('logging/email/*') ? 'active' : '' }}">
                    <a
                            href="{{route('logging.email-log')}}"><i class="fa fa-circle-o"></i> Webhook
                        Email</a></li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('logging-health-check-app'))
                <li>
                    <a class="{{ request()->is('logging/health-check-app') || request()->is('logging/health-check-app/*') ? 'active' : '' }}"
                       href="{{route('logging-health-check-app')}}"><i class="fa fa-circle-o"></i> Health
                        check
                        app</a></li>
            @endif
            <li><a href="{{url('log-activity')}}" target="_blank"><i class="fa fa-circle-o"></i> Nhật ký
                    hoạt động</a></li>
            <li><a href="{{url('logging/multiple-order-fail')}}"><i class="fa fa-circle-o"></i> Lịch sử vận
                    đơn hàng loạt</a></li>

            @if (auth()->user()->hasDirectPermissionCustom('logging.operation-log'))
                <li class="{{ request()->is('logging/operation-log') || request()->is('logging/operation-log/*') ? 'active' : '' }}">
                    <a href="{{url('logging/operation-log')}}">
                        <i class="fa fa-circle-o"></i> Operation Log
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('logging.log-create-error'))
                <li class="{{ request()->is('/logging/log-create-error') || request()->is('/logging/log-create-error/*') ? 'active' : '' }}">
                    <a href="{{url('logging/log-create-error')}}">
                        <i class="fa fa-circle-o"></i>  Log Create Order Error
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasDirectPermissionCustom('logging.log-send-sms'))
                <li class="{{ request()->is('/logging/log-send-sms') || request()->is('/logging/log-send-sms/*') ? 'active' : '' }}">
                    <a href="{{url('logging/log-send-sms')}}">
                        <i class="fa fa-circle-o"></i>  Log Send Sms
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif
