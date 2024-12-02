<li class="header">Locations</li>
@if (auth()->user()->hasDirectPermissionCustom('location.master.index'))
    <li class="menu-item">
        <a href="{{route('location.master.index')}}"><i class="fa fa-globe"></i>
            <span>Master</span></a>
    </li>
@endif
@if (auth()->user()->hasDirectPermissionCustom('location.partner.index'))
    <li class="menu-item">
        <a href="{{route('location.partner.index')}}"><i class="fa fa-map"></i>
            <span>Partner</span></a>
    </li>
@endif
@if (auth()->user()->hasDirectPermissionCustom('location.partner.index'))
    <li class="menu-item">
        <a href="{{route('location.mapping.index')}}"><i class="fa fa-compress"></i>
            <span>Mapping</span></a>
    </li>
@endif

