<!-- Sidebar Menu -->
<div class="ui vertical sidebar menu">
    <form method="GET" action="{{ route('search') }}" accept-charset="UTF-8">
        <div class="item">
            <div class="ui input">
                <input type="text" placeholder="Search..." class="prompt" name="q"
                       value="{{ request()->get('q')? : '' }}" required>
            </div>
        </div>
    </form>
    <div class="item">
        <div class="header"> 资源</div>
        <div class="menu article">
            @foreach($categoryList as $v)
                <a href="{{ url('/a/'.$v['slug']) }}" class="item">{{ $v['name'] }}</a>
            @endforeach
        </div>
    </div>
    <div class="item">
        <div class="header"> 问答</div>
        <div class="menu article">
            @foreach($questionCategoryList as $v)
                <a href="{{ url('/q/'.$v['slug']) }}" class="item">{{ $v['name'] }}</a>
            @endforeach
        </div>
    </div>
    <div class="item">
        <div class="header"> 站点</div>
        <div class="menu article">
            <a href="{{ route('about') }}" class="item">关于本站</a>
        </div>
    </div>
    <div class="item">
        <div class="header"> 权限</div>
        @if(Auth::check())
            @if($authUser->is_admin == 'yes' && $authUser->hasRole('supper_admin'))
                <a href="{{ route('articles.create') }}" class="item">
                    创作文章
                </a>
            @endif
            <a href="{{ route('questions.create') }}" class="item">
                发起问题
            </a>
        @endif
    </div>
    <div class="item">
        <div class="header">用户相关</div>
        @if(Auth::check())
            <a class="item" href="{{ route('notifications.unread') }}"
               title="消息通知"> {{ $authUser->unreadNotifications()->count() }} 条通知</a>
            <div class="ui simple item dropdown article stackable nav-user-item">
                <img class="ui avatar image" src="{{ $authUser->avatar }}"> &nbsp; {{ $authUser->user_name }} <i
                        class="dropdown icon"></i>
                @if($authUser->is_admin == 'yes')
                    <a href="{{ dashboardUrl('/') }}" class="item no-pjax">
                        <i class="dashboard icon"></i>
                        {{ lang('Dashboard') }}
                    </a>
                @endif
                <a href="{{ route('user_center', ['user_name' => $authUser->user_name]) }}" class="item">
                    <i class="icon user"></i>
                    个人中心
                </a>
                <a href="{{ route('users.edit',['id' => $authUser->id]) }}" class="item">
                    <i class="icon cogs"></i>
                    资料修改
                </a>
                <a href="{{ route('logout') }}"
                   data-lang-loginout=" {{ lang('Are you sure want to logout?') }}" class="ite login-out-btn">
                    <i class="icon sign out"></i>
                    {{ lang('signOut') }}
                </a>
            </div>
        @else
            <div class="item">
                <a href="{{ url('register') }}">
                    <div class="ui ginfo button ">注 册</div>
                </a>
            </div>
            <div class="item">
                <a href="{{ url('login') }}">
                    <div class="ui black button">登 录</div>
                </a>
            </div>
        @endif

    </div>
</div>
