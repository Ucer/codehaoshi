@extends('layouts.base')
@section('title')
    @if($view == null)
        @if(!$authUser)
            {{ $info->user_name.'的' }}动态
        @else
            {{ $authUser->user_name == $info->user_name ? '我的':$info->user_name.'的' }}动态
        @endif
    @elseif($view == 'article')
        @if(!$authUser)
            {{ $info->user_name.'发过的' }}文章
        @else
            {{ $authUser->user_name == $info->user_name ? '我发过的':$info->user_name.'发过的' }}文章
        @endif
    @elseif($view == 'question')
        @if(!$authUser)
            {{ $info->user_name.'碰到的' }}问题
        @else
            {{ $authUser->user_name == $info->user_name ? '我碰到的':$info->user_name.'碰到的' }}问题
        @endif
    @elseif($view == 'following')
        @if(!$authUser)
            {{ $info->user_name }}关注的人
        @else
            {{ $authUser->user_name == $info->user_name ? '我':$info->user_name}}关注的人
        @endif
    @elseif($view == 'followed')
        @if(!$authUser)
            {{ $info->user_name }}的关注者
        @else
            {{ $authUser->user_name == $info->user_name ? '我':$info->user_name}}的关注者
        @endif
    @elseif($view == 'vote')
        @if(!$authUser)
            {{ $info->user_name}}赞过的
        @else
            {{ $authUser->user_name == $info->user_name ? '我':$info->user_name}}赞过的
        @endif
    @endif
    -个人中心
@endsection

@section('content')
    <div class="ui container grid">
        <div class="column">
            <div class="ui breadcrumb">
                <a href="/" class="section">首页</a>
                <span class="divider">/</span>
                <div class="active section">
                    @if(!$authUser)
                        {{ $info->user_name.'我的' }}个人中心
                    @else
                        {{ $authUser->user_name == $info->user_name ? '我的':$info->user_name.'的'}}个人中心
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="ui centered grid container stackable userspace">
        <div class="four wide column ">
            <div class="ui stackable cards">
                <div class="ui card">
                    <avatar src="{{ $info->avatar }}"
                            id="{{ $info->id }}"
                            user_name="{{ $info->user_name }}"
                            now_user="{{ $authUser? $authUser->user_name:'' }}"
                            introduction="{{ $info->introduction }}"
                            is_supperadmin="{{ $authUser? $authUser->hasRole('supper_admin') : null }}"
                            time="{{ $info->created_at->diffForHumans() }}">
                    </avatar>
                    <div class="content">
                        <div class="ui three statistics ">
                            <div class="ui mini statistic">
                                <div class="value labels-time">{{ $info->follower_count }}</div>
                                <div class="label"><a
                                            href="{{ route('user_center', ['user_name' => $info->user_name, 'view' => 'followed']) }}"
                                            class="ui popover" data-content="他的关注者">关注者</a></div>
                            </div>
                            <div class="ui mini statistic">
                                <div class="value">0</div>
                                <div class="label"><a href="" class="ui popover" data-content="碰到的问题">问题</a></div>
                            </div>
                            <div class="ui mini statistic">
                                <div class="value">{{ $info->article_count }}</div>
                                <div class="label"><a
                                            href="{{ route('user_center', ['user_name' => $info->user_name, 'view' => 'article']) }}"
                                            class="ui popover" data-content="记录过的文章">文章</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="extra content center">
                        <p style="margin-left: 2px"><i class="marker icon"></i> {{ $info->city }}</p>
                        <div style="text-align: center">
                            <a class="ui circular violet icon button" title="github 主页"
                               href="https://github.com/{{ $info->github_name }}" target="_blank">
                                <i class="github icon"></i>
                            </a>
                            <a class="ui circular google green icon button " title="个人网站"
                               href="//{{ $info->personal_website }}" target="_blank">
                                <i class="chrome icon"></i>
                            </a></div>
                    </div>
                    <div class="extra content">
                        @if(!Auth::check())
                            <vote-button is-checked="false"></vote-button>
                        @else
                            <vote-button is-checked="true" user="{{ $info->id }}"></vote-button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <div class="twelve wide column">
            @include('users.partials.right-item')
        </div>
    </div>
@endsection
