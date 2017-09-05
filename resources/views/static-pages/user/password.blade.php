@extends('layouts.base')
@section('title','修改密码')

@section('content')
    @include('static-pages.user.partials.left-menu')

    <div class="twelve wide column">
        <div class="ui stacked segment">
            <div class="content">
                <h2>修改密码</h2>
                <div class="ui divider"></div>
                <form class="ui form" role="form" method="POST" action="" required="" accept-charset="UTF-8" enctype="multipart/form-data">
                    <div class="field">
                        <label for="name-field">旧密码：</label>
                        <input class="form-control" type="password" name="old_password" >
                    </div>
                    <div class="field">
                        <label for="name-field">新密码：</label>
                        <input class="form-control" type="password" name="password" placeholder="至少6个长度" >
                    </div>
                    <div class="field">
                        <label for="name-field">确认密码：</label>
                        <input class="form-control" type="password" name="password_confirmation" >
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
