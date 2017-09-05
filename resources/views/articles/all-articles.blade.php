@extends('layouts.base')
@section('title','资源-所有文章')
@section('content')
    <div class="ui container grid">
        <div class="column">
            <div class="ui breadcrumb">
                <a href="/" class="section">首页</a>
                <span class="divider">/</span>
                <span class="active section">所有资源</span>
            </div>
        </div>
    </div>
    <div class="ui  grid container stackable">
        <div class="sixteen wide column">
            <div class="ui segment article-content">
                <div class="extra-padding">
                    <p class="book-article-meta">
                        <a href=""><i class="file text icon"></i>
                            所有文章</a>
                        <span class="divider">/</span>
                    </p>

                    <div class="ui celled list">

                        @forelse($articles as $v)
                            <div class="item">
                                <div class="right floated content labels">
                                    @foreach($v->tags as $tag)
                                        <a class="item" href="{{ url('tag',['slug' => $tag->slug]) }}">
                                            <div class="ui {{ $tag->style }} horizontal label">{{ $tag->tag }}</div>
                                        </a>
                                    @endforeach
                                    <span class="labels-time" title="评论数">{{ $v->comment_count }}</span>/
                                    <span class="labels-time" title="点赞数">{{ $v->vote_count }}</span>/
                                    <span class="labels-time" title="查看数">{{ $v->view_count }}</span>&nbsp;&nbsp;&nbsp;
                                    <span class="labels-time" title="发布时间">{{ $v->created_at->diffForHumans() }}</span>
                                </div>
                                <img class="ui avatar image avatar-b popover"
                                     onclick="location.href= '{{ route('user_center', ['user_name' => $v->user->user_name]) }}'"
                                     alt="{{ $v->user->user_name }}" data-content="{{ $v->user->user_name }}"
                                     src="{{ $v->user->avatar }}">
                                <div class="content">
                                    <a href="{{ route('article.show', ['slug' => $v->slug]) }}" class="no_marakdown">
                                        <div class="ui popover" style="font-weight: bold"
                                             data-content="{{ $v->title }}">{{ str_limit($v->title, 70) }}</div>
                                    </a>
                                    {{ str_limit($v->description, 70) }}
                                </div>
                            </div>
                        @empty
                            <div class="ui feed no-messages">
                                <a class="text-center alert alert-info">!
                                    (=￣ω￣=) ··· 还没有数据噢。
                                </a>
                            </div>
                        @endforelse
                        <div class="panel-footer " style="display: block;">
                            <!-- Pager -->
                            {{ $articles->appends(request()->except('page'))->links() }}
                        </div>
                    </div>


                </div>


            </div>
        </div>
    </div>
    </div>
@endsection