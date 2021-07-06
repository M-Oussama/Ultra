@foreach($side_menu->children as $parent)
    @if($parent->isSection)
        @canany($parent->getPermissions($parent))
            <li class="menu-section">
                <h4 class="menu-text">{{$parent->name}}</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>
        @endcanany
    @else
        @if( count($parent->children) == 0 )
            @canany($parent->getPermissions($parent))
                <li class="menu-item {{$parent->checkUrl($parent, request()->path()) ? 'menu-item-active' : ''}}" aria-haspopup="true">
                    <a href="{{$parent->url}}" class="menu-link">
                        <span class="menu-icon {{$parent->icon}}"></span>

                        <span class="menu-text">{{$parent->name}}</span>
                    </a>
                </li>
            @endcanany
        @else
            @canany($parent->getPermissions($parent))
                <li class="menu-item menu-item-submenu {{ $parent->checkUrl($parent, request()->path()) ? 'menu-item-open menu-item-here' : ''}}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-icon {{$parent->icon}}"></span>
                        <span class="menu-text">{{$parent->name}}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{$parent->name}}</span>
                                </span>
                            </li>
                            @foreach($parent->children as $child )
                                @if(count($child->children) == 0)
                                    <li class="menu-item {{ $child->checkUrl($child, request()->path()) ? 'menu-item-active' : ''}}" aria-haspopup="true">
                                        <a href="{{$child->url}}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">{{$child->name}}</span>
                                        </a>
                                    </li>
                                @else
                                    @canany($child->getPermissions($child))
                                        <li class="menu-item menu-item-submenu {{ $child->checkUrl($child, request()->path()) ? 'menu-item-open menu-item-here' : ''}}" aria-haspopup="true" data-menu-toggle="hover">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <i class="menu-bullet menu-bullet-line">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">{{$child->name}}</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu">
                                                <i class="menu-arrow"></i>
                                                <ul class="menu-subnav">
                                                    @foreach($child->children as $grandSon)
                                                        @canany($grandSon->getPermissions($grandSon))
                                                            <li class="menu-item {{ $grandSon->checkUrl($grandSon, request()->path()) ? 'menu-item-active' : ''}}" aria-haspopup="true">
                                                                <a href="{{$grandSon->url}}" class="menu-link">
                                                                    <i class="menu-bullet menu-bullet-dot">
                                                                        <span></span>
                                                                    </i>
                                                                    <span class="menu-text">{{$grandSon->name}}</span>
                                                                </a>
                                                            </li>
                                                        @endcanany
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                    @endcanany
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endcanany
        @endif
    @endif
@endforeach
