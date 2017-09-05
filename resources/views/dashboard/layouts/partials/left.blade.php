<!--左侧导航开始-->
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span><img alt="image" class="img-circle" style="max-width: 80px" src="{{ Auth::User()->avatar }}"/></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs"><strong
                                            class="font-bold">{{ Auth::User()->user_name }}</strong></span>
                                <span class="text-muted text-xs block">总后台管理员<b class="caret"></b></span>
                            </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="javascript:;" id="cache">清除缓存</a></li>
                        <li><a href="{{ url('/') }}">返回主站</a></li>
                    </ul>
                </div>
            </li>
            @foreach( $menu_list as $menu)
                <li class="menu">
                    <a href="#">
                        <i class="fa fa-{{ $menu['style'] }}"></i>
                        <span class="nav-label">{{ $menu['name'] }} </span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @forelse ($menu['sun'] as $v)
                            <li>
                                <a class="J_menuItem" href="{{ $v['href'] }}">{{ $v['name'] }}</a>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
<!--左侧导航结束-->