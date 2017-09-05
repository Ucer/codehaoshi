@extends('layouts.base')
@section('title','私信')
@section('content')
    <div class="ui centered grid container stackable">
        @include('static-pages.messages.partials.left-bar')
        <div class="twelve wide column">
            <div class="ui stacked segment">
                <div class="content extra-padding">
                    <h1> <i class="mail outline icon"></i> 我的私信 </h1>
                    <div class="ui divider"></div>
                    <div class="ui feed">
                        <div class="event ">
                            <a class="label" href="">
                                <img src="https://fsdhubcdn.phphub.org/uploads/avatars/397_1493859845.jpeg?imageView2/1/w/200/h/200&e=1501052322&token=2vxC9mwLd9SS1hS_uqfK99SsyG2qVm-BWFXuVl96:jx9iK89Xd8ZYygJDasJk-1dToV0="
                                     alt="ucer">
                            </a>
                            <div class="content">
                                <div class="ucer">
                                    <a href=""> Ucer </a>
                                    <span class="meta"> ⋅ 于 ⋅ <span class="timeago">2个月前</span> </span>：
                                </div>
                                <div class="extra text markdown-reply">
                                    <p>请按照这个页面指示
                                    </p>
                                </div>
                                <div class="meta">
                                    <div class="message-meta">
                                        <p>
                                            <a href="https://fsdhub.com/messages/8" class="normalize-link-color ">
                                                <i class="icon commenting outline" aria-hidden="true"></i>
                                                查看对话
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection