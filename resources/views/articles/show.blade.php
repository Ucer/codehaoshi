@extends('layouts.base')
@section('title')
    {{ $info->title }}-资源-{{ $info->category->name }}-文章详情
@endsection
@section('meta')
    <meta name="keywords" content="{{ $info->title }}"/>
    <meta name="description" content="{{ $info->description }}"/>
@endsection
@section('content')
    <div class="ui container grid">
        <div class="column">
            <div class="ui breadcrumb">
                <a href="/" class="section">首页</a>
                <span class="divider">/</span>
                <a href="{{ route('article.all') }}" class="section">资源</a>
                <span class="divider">/</span>
                <a href="{{ url('/a/'.$info->category->slug) }}" class="section">{{ $info->category->name }}</a>
                <span class="divider">/</span>
                <div class="active section">{{ $info->title }}</div>
            </div>
        </div>
    </div>


    <div class="ui centered grid container stackable" id="content">
        <div class="twelve wide column">
            <div class="ui segment article-content">
                <div class="extra-padding">
                    <h1>
                        <span style="line-height: 34px;">{{ $info->title }}</span>
                    </h1>
                    <p class="book-article-meta ui description">
                        <i class="attach icon"></i>
                        {{ $info->description }}
                    </p>
                    <p class="book-article-meta description">
                        <i class="wait icon"></i> <span class="header">Post on </span> <span
                                class="default-color-a">{{ substr($info->created_at, 0, -8) }}</span>
                        <span class="header">by</span>
                        <a href="{{ route('user_center', ['user_name' => $info->user->user_name]) }}"><i
                                    class="icon user"></i> <span class="ui popover default-color-a"
                                                                 data-title="{{ $info->user->user_name }}"
                                                                 data-content="{{ $info->user->introduction }}">{{ $info->user->user_name }}</span></a>
                    </p>
                </div>
                <div class="ui divider"></div>
                <div class="ui readme markdown-body content-body">
                    <parse content="{{ json_decode($info->content)->raw  }}"></parse>
                    <div class="ui info message">
                        <div class="ui list">
                            <div class="item">
                                <i class="folder open grey icon"></i>
                                <div class="content">
                                    <span class="black-font">分类:</span>
                                    <a href="{{ url('/a/'.$info->category->slug) }}" class="ui popover"
                                       style="color: #2C662D"
                                       data-content="{{ $info->category->name }}">{{ $info->category->name }}</a>
                                </div>
                            </div>
                            <div class="item">
                                <i class=" tags grey icon"></i>
                                <div class="content"><span class="black-font">标签:</span>
                                    <span class="info-labels">
                                        @foreach($info->tags as $tag)
                                            <a class="item ui popover" href="{{ url('tag',['slug' => $tag->slug]) }}"
                                               data-content="{{ $tag->tag }}">{{ $tag->tag }}</a>
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                            <div class="item">
                                <i class="warning sign orange icon"></i>
                                <div class="content"><span class="black-font">原创声明:</span> <span>如无特别说明，均为作者原创文章。未经允许，不得转载!</span>
                                </div>
                            </div>
                        </div>
                        @if( Auth::check() && $authUser->is_admin == 'yes' && $authUser->hasRole('supper_admin'))
                            <a href="{{ route('articles.edit', ['slug' => $info->id] ) }}" class="ui teal button"> <i class="edit icon"></i> 修改 </a>
                        @endif
                    </div>
                </div>
            </div>
            <div style="min-height: 30px">
                @unless(!$prev)
                    <a class="ui basic button small  popover" data-content="{{ $prev['title'] }}"
                       href="{{ route('article.show', ['slug' => $prev['slug']]) }}"><i class="icon arrow left"></i> 上一篇</a>
                @endunless

                @unless(!$next)
                    <a class="ui basic button small  popover right floated" data-content="{{ $next['title'] }}"
                       href="{{ route('article.show', ['slug' => $next['slug']]) }}"><i class="icon arrow right"></i>
                        下一篇</a>
                @endunless
            </div>
            <div class="ui message basic">
                @if(config('codehaoshi.social_share.article_share'))
                    <div class="social-share share-component"
                         data-title="{{ $info->title }}"
                         data-description="{{ $info->title }}"
                         {{ config('codehaoshi.social_share.sites') ? "data-sites=" . config('codehaoshi.social_share.sites') : '' }}
                         {{ config('codehaoshi.social_share.mobile_sites') ? "data-mobile-sites=" . config('codehaoshi.social_share.mobile_sites') : '' }}
                         initialized>
                    </div>
                @endif
                <div class="clearfix"></div>
            </div>

            @if(!Auth::check())
                <comment article-id="{{ $info->id }}" is-checked="false"></comment>
            @else
                <comment user-avatar="{{ $authUser->avatar }}" userid="{{ $authUser->id }}" article-id="{{ $info->id }}"
                         isadmin="{{ $authUser->hasRole('supper_admin') }}"
                         is-checked="true"></comment>
            @endif
        </div>
        <div class="four wide column">
            @include('articles.partials.info-right-item')
        </div>
    </div>
@endsection

