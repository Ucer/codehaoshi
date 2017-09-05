@extends('layouts.base')
@section('title','文章详情')
@section('content')
    <div class="ui container grid">
        <div class="column">
            <div class="ui breadcrumb">
                <a href="/" class="section">首页</a>
                <span class="divider">/</span>
                <a href="/all_articles" class="section">资源</a>
                <span class="divider">/</span>
                <a href="articles" class="section">php编程</a>
                <span class="divider">/</span>
                <div class="active section">php workenman 如何正确使用</div>
            </div>
        </div>
    </div>


    <div class="ui centered grid container stackable" id="content">
        <div class="twelve wide column">
            <div class="ui segment article-content">
                <div class="extra-padding">
                    <h1>
                        <span style="line-height: 34px;">php workenman 如何正确使用</span>
                    </h1>
                    <p class="book-article-meta ui description">
                        <i class="attach icon"></i>
                        workmen 是 php 的一个 socket 框架,专门用来做客服系统/聊天室 . . . workmen 是 php 的一个 socket 框架,专门用来做客服系统/聊天室 . . .
                    </p>
                    <p class="book-article-meta description">
                        <i class="wait icon"></i> <span class="header">Post on </span> <span class="default-color-a">2017年3月1日</span>
                        <span class="header">by</span>
                        <a href=""><i class="icon user"></i> <span class="ui popover default-color-a" data-title="ucer"
                                                                   data-content="好好学习，天天向上">ucer</span></a>
                    </p>
                </div>
                <div class="ui divider"></div>
                @include('static-pages.article.partials.article-info-form')
            </div>
            <div>
                <a class="ui basic button small  popover" data-content="1.4. 如何正确阅读本书？" href=""><i class="icon arrow left"></i> 上一篇</a>
                <a class="ui basic button small popover right floated" data-content="1.6. 发行说明" href="">下一篇 <i class="icon arrow right"></i></a>
            </div>
            <div class="ui message basic">
                <div class="social-share share-component">
                    分享
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="ui message basic centerd voted-box">
                <div class="buttons">
                    <div class="ui button kb-star-big basic teal  login-required" data-act="star" data-id="501"><i class="icon thumbs up"></i> <span class="state">点赞</span></div>
                </div>
                <div class="voted-users">
                    <a href="https://fsdhub.com/wph3629709">
                        <img class="ui image avatar image-33 stargazer" src="https://fsdhubcdn.phphub.org/uploads/avatars/2491_1501131226.jpeg?imageView2/1/w/100/h/100&amp;e=1501300089&amp;token=2vxC9mwLd9SS1hS_uqfK99SsyG2qVm-BWFXuVl96:9rFFU7YeTxuotnTpYJE11q2PdJI=">
                    </a>
                    <a href="https://fsdhub.com/hebin">
                        <img class="ui image avatar image-33 stargazer" src="https://fsdhubcdn.phphub.org/uploads/avatars/1049_1495468400.jpeg?imageView2/1/w/100/h/100&amp;e=1501300089&amp;token=2vxC9mwLd9SS1hS_uqfK99SsyG2qVm-BWFXuVl96:5yhyWspv9uYxpUpyNnsoVa8lFGk=">
                    </a>
                    <a href="https://fsdhub.com/Mike_Maldini">
                        <img class="ui image avatar image-33 stargazer" src="https://fsdhubcdn.phphub.org/uploads/avatars/1177_1496197821.png?imageView2/1/w/100/h/100">
                    </a>
                    <a href="https://fsdhub.com/zhoujiping">
                        <img class="ui image avatar image-33 stargazer" src="https://fsdhubcdn.phphub.org/uploads/avatars/921_1495068558.jpeg?imageView2/1/w/100/h/100&amp;e=1501300089&amp;token=2vxC9mwLd9SS1hS_uqfK99SsyG2qVm-BWFXuVl96:xuMjMIgElR58cWPB39dQb14lZQ0=">
                    </a>
                </div>
            </div>
            @include('static-pages.article.partials.article-comment')
        </div>
        <div class="four wide column">
            @include('static-pages.article.partials.info-right-item')
        </div>
    </div>
@endsection