<nav class="ui main large  menu top stackable ">
    <a class="attach-sidebar item" style="display: none"> <i class="sidebar icon"></i> </a>
    <div class="ui container hidden-menu-m">
        <a href="/" class="header item ">
            {{ config('app.name') }}
            <div class="ui left pointing  violet  label "
                 style="font-weight: normal;"> {{ config('codehaoshi.description') }}</div>
        </a>
        <div class="ui simple item dropdown article stackable nav-user-item hidden-menu-m">资源 <i
                    class="dropdown icon"></i>
            <div class="menu">
                @foreach($categoryList as $v)
                    <a href="{{ url('/a/'.$v['slug']) }}" class="item">{{ $v['name'] }}</a>
                @endforeach
            </div>
        </div>
        <div class="ui simple item dropdown article stackable nav-user-item hidden-menu-m">问答 <i
                    class="dropdown icon"></i>
            <div class="menu">
                @foreach($questionCategoryList as $v)
                    <a href="{{ url('/q/'.$v['slug']) }}" class="item">{{ $v['name'] }}</a>
                @endforeach
            </div>
        </div>
        <a href="{{ route('about') }}" class="item hidden-menu-m">关于本站</a>
        <div class="ui fluid category search item ">
            <div class="ui search">
                <form method="GET" action="{{ route('search') }}" accept-charset="UTF-8">
                    <div class="ui icon input">
                        <input type="text" placeholder="Search..." class="prompt" name="q"
                               value="{{ request()->get('q')? : '' }}" required>
                        <i class="search icon"></i>
                    </div>
                </form>

                <div class="results"></div>
            </div>
        </div>

        <div class="right menu">
            {{--<div class="ui simple item dropdown article stackable nav-user-item">Language <i class="dropdown icon"></i>--}}
            {{--<div class="menu">--}}
            {{--<a class="item">English</a>--}}
            {{--<a class="item">Russian</a>--}}
            {{--<a class="item">Spanish</a>--}}
            {{--</div>--}}
            {{--</div>--}}


            @if(Auth::check())
                <div class="ui simple item dropdown article stackable nav-user-item">
                    <i class="add large icon violet"></i>
                    <div class="ui menu stackable" tabindex="-1">
                        @if($authUser->is_admin == 'yes' && $authUser->hasRole('supper_admin'))
                            <a href="{{ route('articles.create') }}" class="item">
                                创作文章
                            </a>
                        @endif
                        <a href="{{ route('questions.create') }}" class="item">
                            发起问题
                        </a>
                    </div>
                </div>
                <a class="item" href="{{ route('notifications.unread') }}" title="消息通知">
                    <span class="ui basic circular label notification"
                          id="notification-count">{{ $authUser->unreadNotifications()->count() }}</span>
                </a>
                <div class="ui simple item dropdown article stackable nav-user-item">
                    <img class="ui avatar image"
                         src="{{ $authUser->avatar }}">
                    &nbsp;
                    {{ $authUser->user_name }} <i class="dropdown icon"></i>
                    <div class="ui menu stackable" tabindex="-1">
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
                        <a href="{{ route('logout') }}" data-lang-loginout=" {{ lang('Are you sure want to logout?') }}"
                           class="item login-out-btn">
                            <i class="icon sign out"></i>
                            {{ lang('signOut') }}
                        </a>
                    </div>
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
        </div> {{--right menu--}}

    </div>
</nav> {{--top navbar--}}

