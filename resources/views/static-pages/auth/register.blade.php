@extends('layouts.base')
@section('title','用户注册')
@section('style')
@endsection


@section('content')
    <div class="ui  aligned center aligned grid register">
        <div class="column reg">
            <form class="ui large form">
                <div class="ui stacked segment">
                    <div class="field">
                        <label class="auth-label">用户名:</label>
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="text" name="user_name" placeholder="用户名英文或数字组成">
                        </div>
                    </div>
                    <div class="field">
                        <label class="auth-label">邮箱：</label>
                        <div class="ui left icon input">
                            <i class="mail icon"></i>
                            <input type="text" name="email" placeholder="将作为登录账号">
                        </div>
                    </div>
                    <div class="field">
                        <label class="auth-label">密码：</label>
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password" placeholder="至少6位">
                        </div>
                    </div>
                    <div class="field">
                        <label class="auth-label">确认密码:</label>
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password_confirmation" placeholder="">
                        </div>
                    </div>
                    <div class="ui fluid   ginfo submit button">立即注册</div>
                    <div class="row thirdlogin">
                        <a class="info-color-a left" href=" {{ route('thirdlogin') }}"><i class="github icon"></i> <span class="icon-no">使用github登录</span></a>
                        <a class="info-color-a right" href=""><i class="qq icon"></i> <span class="icon-no">使用QQ登录</span></a>
                    </div>
                </div>

                <div class="ui error message"></div>

            </form>

            <div class="ui message">
                已经拥有账号?<a href="login">登录</a>
            </div>
        </div>
    </div>
@section('script')
    @include('form-validate/auth/v-register')
@endsection
@endsection

