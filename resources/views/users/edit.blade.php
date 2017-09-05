@extends('layouts.base')
@section('title','资料修改')

@section('content')
    @include('users.partials.left-menu')

    <div class="twelve wide column">
        <div class="ui stacked segment">
            <div class="content">
                <h2>修改资料</h2>
                <div class="ui divider"></div>
                <form class="ui form" method="post" action="{{ route('users.update', $info->id) }}" >
                    {{ csrf_field() }} {{ method_field('Patch') }}
                    <div class="field">
                        <label for="user_name-field">用户名：</label>
                        <input class="form-control" disabled="disabled" type="text" name="user_name"
                               value="{{ $info->user_name }}">
                    </div>
                    <div class="field">
                        <label for="email-field">邮箱：</label>
                        <input class="form-control" type="text" name="email" disabled="disabled"
                               value="{{ $info->email }}">
                    </div>

                    <div class="field">
                        <label for="github_name-field">Github 用户名：（请注意和 github 上保持一致）</label>
                        <input class="form-control" type="text" name="github_name" value="{{ $info->github_name }}">
                    </div>

                    <div class="field">
                        <label for="nickname-field">昵称：</label>
                        <input class="form-control" type="text" name="nickname" value="{{ $info->nickname }}">
                    </div>

                    <div class="field">
                        <label for="personal_website-field">个人网站：(如：example.com，不需要加 http 头前缀 https://)</label>
                        <input class="form-control" type="text" name="personal_website"
                               value="{{ $info->personal_website }}">
                    </div>

                    <div class="field">
                        <label for="company-field">所在公司：</label>
                        <input class="form-control" type="text" name="company" value="{{ $info->company }}">
                    </div>

                    <div class=" field">
                        <label for="city-field">所在城市：(如： 云南 大理)</label>
                        <input class="form-control" type="text" name="city" value="{{ $info->city }}">
                    </div>

                    {{--<div class="required field">--}}
                    <div class="field">
                        <label for="introduction-field">个人简介：（请一句话介绍你自己，大部分情况下会在你的头像和名字旁边显示）</label>
                        <textarea rows="3" name="introduction"
                                  placeholder="请一句话介绍你自己">{{ $info->introduction }}</textarea>
                    </div>
                    <div class="ui error message"></div>

                    <button class="ui teal labeled icon button" type="submit">
                        <i class="save icon"></i>
                        保存
                    </button>
                </form>

            </div>
        </div>
    </div>
    </div>
@endsection
