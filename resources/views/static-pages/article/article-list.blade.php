@extends('layouts.base')
@section('title','文章列表')
@section('content')
    <div class="ui container grid">
        <div class="column">
            <div class="ui breadcrumb">
                <a href="/" class="section">首页</a>
                <span class="divider">/</span>
                <a href="/all_articles" class="section">资源</a>
                <span class="divider">/</span>
                <div class="active section">php编程</div>
            </div>
        </div>

    </div>

    <div class="ui centered grid container stackable">
        <div class="twelve wide column">
            <div class="ui  segment">
                <div class="content extra-padding">
                    <div class="book header">
                        <div class="ui items">
                            <div class="item">
                                <div class="image">
                                    <img class="ui image image-shadow cat-article-image "
                                         src="http://www.semantic-ui.cn/images/avatar2/large/matthew.png">
                                </div>
                                <div class="content">
                                    <div class="header" style="width:100%"> 编程语言</div>
                                    <div class="description">
                                        <p><b class="ui text orange">文章数量：69 </b></p>
                                        java、php、日常记java、php、日常记录java、php、日常记录录
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ui  attached tabular menu violet">
                        <span class="item active violet" href=""> <i class="grey content icon"></i> 文章列表 </span>
                    </div>
                    <br>
                    @include('static-pages.article.partials.article-list-form')
                </div>
            </div>
        </div>

        <div class="four wide column">
            @include('static-pages.article.partials.right-item')
        </div>

    </div>

@endsection