@extends('layouts.base')
@section('title','个人中心')

@section('content')
    <div class="ui container grid">
        <div class="column">
            <div class="ui breadcrumb">
                <a href="/" class="section">首页</a>
                <span class="divider">/</span>
                <div class="active section">个人中心</div>
            </div>
        </div>
    </div>
    <div class="ui centered grid container stackable userspace">
        <div class="four wide column ">
            <div class="ui stackable cards">
                <div class="ui card">
                    <div class="ui list" style="margin-top: 6px;margin-left: 4px;">
                        <div class="item">
                            <img  class="ui centered circular tiny image" src="https://fsdhubcdn.phphub.org/uploads/avatars/397_1493859845.jpeg?imageView2/1/w/200/h/200&e=1501052322&token=2vxC9mwLd9SS1hS_uqfK99SsyG2qVm-BWFXuVl96:jx9iK89Xd8ZYygJDasJk-1dToV0=">
                            <div class="content user-info">
                                <a class="header title">ucer</a>
                                <div class="description"> 第 &nbsp;1&nbsp;位会员 </div>
                                <div class="description"> 注册于&nbsp;<span class="labels-time">3年前</span> </div>
                            </div>
                        </div>
                        <div class="description labels-time" > <i class="rss icon"></i> 好好学习，天天向上,好好学习，天天向上</div>
                    </div>
                    <div class="content" >
                            <div class="ui three statistics ">
                                <div class="ui mini statistic">
                                        <div class="value labels-time">4</div>
                                        <div class="label"><a href="">关注者</a></div>
                                </div>
                                <div class="ui mini statistic">
                                    <div class="value">11</div>
                                    <div class="label"><a href="">问题</a></div>
                                </div>
                                <div class="ui mini statistic">
                                    <div class="value">1859</div>
                                    <div class="label"><a href="">文章</a></div>
                                </div>
                            </div>
                    </div>
                    <div class="extra content center">
                        <p style="margin-left: 2px"> <i class="marker icon"></i> 云南 大理 </p>
                        <div style="text-align: center">
                        <a class="ui circular violet icon button" title="github 主页">
                            <i class="github icon"></i>
                        </a>
                        <a class="ui circular google green icon button " title="个人网站">
                            <i class="chrome icon"></i>
                        </a></div>
                    </div>
                    <div class="extra content">
                        <button class=" ui basic  button fluid follow" data-act="unfollow" data-id="397"><span class="state">已关注</span></button>
                    </div>

                </div>
            </div>
        </div>
        <div class="twelve wide column">
            @include('static-pages.user.partials.right-item')
        </div>
    </div>
@endsection
