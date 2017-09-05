@extends('layouts.base')
@section('title','用户登录')
@section('style')
@endsection


@section('content')
    <div class="ui  aligned center aligned grid register">
        <div class="column reg">
            <form class="ui large form">
                <div class="ui stacked segment">
                    <div class="field">
                        <label class="auth-label">账号:</label>
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="text" name="email" placeholder="邮箱">
                        </div>
                    </div>
                    <div class="field">
                        <label class="auth-label">密码：</label>
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password" placeholder="">
                        </div>
                    </div>
                    <div class="ui fluid   ginfo submit button">登录</div>
                    <div class="row thirdlogin">
                        <a class="info-color-a left" href=""><i class="github icon"></i> <span class="icon-no">使用github登录</span></a>
                        <a class="info-color-a right" href=""><i class="github icon"></i> <span class="icon-no">使用github登录</span></a>
                    </div>
                </div>

                <div class="ui error message"></div>

            </form>

            <div class="ui message">
                忘记密码?<a href="">找回密码</a>
            </div>
        </div>
    </div>
@section('script')
    @include('form-validate/auth/v-register')
@endsection
@endsection

