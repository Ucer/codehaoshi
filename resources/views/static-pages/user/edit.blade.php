@extends('layouts.base')
@section('title','资料修改')

@section('content')
    @include('static-pages.user.partials.left-menu')

    <div class="twelve wide column">
        <div class="ui stacked segment">
            <div class="content">
                <h2>修改资料</h2>
                <div class="ui divider"></div>
                <form class="ui form" role="form" method="POST" action="" required="" accept-charset="UTF-8" enctype="multipart/form-data">

                    <div class="field">
                        <label for="name-field">用户名：</label>
                        <input class="form-control" disabled="disabled" type="text" name="user_name"  value="Ucer" required="">
                    </div>
                    <div class="field">
                        <label for="company-field">邮箱：</label>
                        <input class="form-control" type="text" name="email" disabled="disabled"  value="185429135@qq.com">
                    </div>

                    <div class="field">
                        <label for="real_name-field">Github 用户名：（请注意和 github 上保持一致）</label>
                        <input class="form-control" type="text" name="github_name"  value="Ucer" required="">
                    </div>

                    <div class="field">
                        <label for="real_name-field">昵称：</label>
                        <input class="form-control" type="text" name="nickname" id="real_name-field" value="漂过太平洋" required="">
                    </div>

                    <div class="field">
                        <label for="website-field">个人网站：(如：example.com，不需要加 http 头前缀 https://)</label>
                        <input class="form-control" type="text" name="website" id="website-field" value="">
                    </div>

                    <div class="field">
                        <label for="company-field">所在公司：</label>
                        <input class="form-control" type="text" name="company" id="company-field" value="">
                    </div>

                    <div class="required field">
                        <label for="city-field">所在城市：(如： 云南 大理)</label>
                        <input class="form-control" type="text" name="city" id="city-field" value="云南 大理">
                    </div>

                    <div class="required field">
                        <label for="bio-field">个人简介：（请一句话介绍你自己，大部分情况下会在你的头像和名字旁边显示）</label>
                        <textarea rows="3" id="bio-field" name="bio" placeholder="至少6个长度" required></textarea>
                    </div>
                    <div class="ui error message"></div>

                    <button class="ui primary labeled icon button" type="submit">
                        <i class="save icon"></i>
                        保存
                    </button>
                </form>

            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    @include('form-validate/auth/v-register')
@endsection
