@extends('layouts.base')
@section('title')
    {{ $query }}-搜索
@endsection
@section('content')
    <div class="ui  grid container stackable">
        <div class="sixteen wide column">
            <div class="ui container grid">
                <div class="column">
                    <div class="ui breadcrumb">
                        <a href="/" class="section">首页</a>
                        <span class="divider">/</span>
                        <div class="active section">搜索</div>
                    </div>
                </div>
            </div>
            <div class="ui segment article-content">
                <div class="extra-padding">
                    <p class="book-article-meta">
                    <div class="ui message info">
                        <div class="header">全站搜索</div>
                        <ul class="list">
                            <i class="icon search large green"></i> 关于 “{{ $query }}” 的搜索结果，{{ count($article_search) }}
                            篇文章， {{count($question_search) }} 个问题 。
                        </ul>
                    </div>
                    </p>
                    <div class="ui centered grid container stackable search-result">
                        <div class="ui very relaxed list seven wide column">
                            @if(count($article_search))
                                @foreach($article_search as $v)
                                    <div class="item">
                                        <div class="content">
                                            <a class="header" href="{{ route('article.show', ['slug' => $v->slug]) }}">
                                                <i class="file text outline icon"></i>
                                                {{ str_limit($v->title, 55) }}
                                            </a>
                                            <div class="description"> {{ str_limit($v->description, 70) }}</div>
                                            <div class="description"><i
                                                        class="icon wait"></i>{{ str_limit($v->created_at,10,'') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="ui very relaxed list seven wide column right floated">
                            @if(count($question_search))
                                @foreach($question_search as $v)
                                    <div class="item">
                                        <div class="content">
                                            <a class="header" href="{{ route('question.show', ['slug' => $v->slug]) }}">
                                                <i class="help circle outline icon"></i>
                                                {{ str_limit($v->title, 55) }}
                                            </a>
                                            <div class="description"> {{ str_limit($v->description, 70) }}</div>
                                            <div class="description"><i
                                                        class="icon wait"></i>{{ str_limit($v->created_at,10,'') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
                    @endsection
                    @section('script')

                        <script type="text/javascript">

                            $(document).ready(function () {
                                var query = '{{ $query }}';
                                var results = query.match(/("[^"]+"|[^"\s]+)/g);
                                results.forEach(function (entry) {
                                    $('.search-results').highlight(entry);
                                });
                            });

                        </script>
@endsection