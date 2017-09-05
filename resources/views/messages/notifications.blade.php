@extends('layouts.base')
@section('title','通知消息')
@section('content')
    <div class="ui container grid">
        <div class="column">
            <div class="ui breadcrumb">
                <a href="/" class="section">首页</a>
                <span class="divider">/</span>
                <div class="active section">消息中心</div>
            </div>
        </div>
    </div>
    <div class="ui centered grid container stackable">
        @include('messages.partials.left-bar')
        <div class="twelve wide column">
            <div class="ui stacked segment">
                <div class="content extra-padding">
                    <h1><i class="bell outline icon"></i> 我的提醒 </h1>
                    <div class="ui divider"></div>
                    @if(count($notifications))
                        @foreach($notifications as $v)
                            @include('notifications.'. snake_case(class_basename($v->type), '-'))
                        @endforeach
                    @else
                        <div class="ui feed no-messages">
                            <a class="text-center alert alert-info">暂无提醒消息!</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection