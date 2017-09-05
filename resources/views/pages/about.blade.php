@extends('layouts.base')
@section('title')
    关于本站
@endsection
@section('content')
    <div class="ui container grid">
        <div class="column">
            <div class="ui breadcrumb">
                <a href="/" class="section">首页</a>
                <span class="divider">/</span>
                <div class="active section">关于本站</div>
            </div>
        </div>
    </div>

    <div class="ui centered grid container stackable" id="content">
        <div class="twelve wide column">
            <div class="ui segment article-content">
                <h3 class="ui center aligned teal  segment"><i class="at icon"></i>关于我们</h3>
                <div class="ui divider"></div>
                <div class="ui readme markdown-body content-body">
                    @if($info)
                    <parse content="{{ json_decode($info->content)->raw  }}"></parse>
                        @else
                        <div class="ui feed no-messages">
                            <p class="text-center alert alert-info">!
                                (=￣ω￣=) ··· 小编正在努力敲打键盘中。。。
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="four wide column">

            <div class="ui segments">
                <div class="ui segment">
                    <p><i class="wait icon"></i>最新文章</p>
                </div>
                <div class="ui secondary violet segment">
                    <div class="ui list">
                        @foreach( $recentArticles as $k=>$v)
                            <div class=" black-font">
                                <a href="{{ route('article.show', ['slug' => $v->slug]) }}" class="ui titlepop"
                                   data-content="{{ $v->title }}">{{ $k+1 }}.{{ $v->title }}</a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="ui segments">
                <div class="ui segment">
                    <p><i class="wait icon"></i>最新问答</p>
                </div>
                <div class="ui secondary violet segment">
                    <div class="ui list">
                        @foreach( $recentQuestions as $k=>$v)
                            <div class=" black-font">
                                <a href="{{ route('question.show', ['slug' => $v->slug]) }}" class="ui titlepop"
                                   data-content="{{ $v->title }}">{{ $k+1 }}.{{ $v->title }}</a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="ui sticky">
                <div class="ui  card column  grid" style="margin-top: 20px;">
                    <div class="ui fluid" style="margin-top: 20px;">
                        <div class="ui teal ribbon label"><i class="star icon"></i> 标签墙</div>
                    </div>
                    <div class="extra">
                        @foreach($tags as $tag)
                            <a href="{{ url('tag',['slug' => $tag->slug]) }}"
                               class="ui  {{ getTagWeight($tag->weight) }} {{ $tag->style }} label lable-list">{{ $tag->tag }}</a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection