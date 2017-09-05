@extends('layouts.base')
@section('title','修改绑定邮箱-资料修改')

@section('content')
    @include('users.partials.left-menu')

    <div class="twelve wide column">
        <div class="ui stacked segment">
            <div class="content">
                <h2>修改绑定邮箱</h2>
                <div class="ui divider"></div>
                <form class="ui form" role="form" method="POST" action="" required="" accept-charset="UTF-8" enctype="multipart/form-data">
                    <div class="field">
                        <label for="email-field">邮箱：(绑定邮箱后可以用邮箱登录）</label>
                        <input class="form-control"  type="text" name="email"  value="" required>
                    </div>
                    <div class="ui error message"></div>

                    <button class="ui teal disabled labeled icon button" type="submit">
                        <i class="edit icon"></i>
                        绑定到新的邮箱
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
