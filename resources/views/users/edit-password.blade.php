@extends('layouts.base')
@section('title','修改密码-资料修改')

@section('content')
    @include('users.partials.left-menu')

    <div class="twelve wide column">
        <div class="ui stacked segment">
            <div class="content">
                <h2>修改密码</h2>
                <div class="ui divider"></div>
                <form class="ui form" role="form" method="POST" action="{{ route('users.update_password', $info->id) }}">
                    {{ csrf_field() }} {{ method_field('Patch') }}
                    <div class="field">
                        <label for="name-field">新密码：</label>
                        <input class="form-control" type="password" name="password" placeholder="至少6个长度" >
                    </div>
                    <div class="field">
                        <label for="name-field">确认密码：</label>
                        <input class="form-control" type="password" name="password_confirmation" >
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
@section('script')
    @include('form-validate/auth/v-register')
@endsection
