@extends('layouts.base')
@section('title','找回密码')

@section('content')
    <div class="ui  aligned center aligned grid register container">
        <div class="six wide column ">
            <h2>密码找回</h2>
            <div class="ui divider"></div>
            <form class="ui form" role="form" method="POST" action="{{ route('password.email') }}" required=""
                  accept-charset="UTF-8" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="ui action input">
                    <input type="text" value="@if(session('old-email') && session('status')){{ trim(session('old-email')) }}@else{{ trim(old('email')) }}@endif" name="email">
                    {{--<input type="text" value="18313852226@sina.cn" name="email">--}}
                    <button class="ui teal right  icon button">
                        <i class="send icon"></i>
                        发送验证码
                    </button>
                </div>
                @if ($errors->has('email'))
                <div class="ui compact red message" style="padding: 5px 0px;">
                        <p> <i class="icon warning"></i>{{ $errors->first('email') }}</p>
                </div>
                @endif
                @if (session('status'))
                <div class="ui compact info message" style="padding: 5px 3px;">
                    <p> <i class="check icon"></i>邮件发送成功，<a href="#" target="_blank" id="goEmail" style="color: #2bd6bb"> 登录邮箱查收?</a></p>
                </div>
                    @endif
            </form>

        </div>
    </div>
@endsection

@section('script')
    <script>
        var hash={ 'qq.com': 'http://mail.qq.com', 'gmail.com': 'http://mail.google.com', 'sina.com': 'http://mail.sina.com.cn', 'sina.cn': 'http://mail.sina.com.cn', '163.com': 'http://mail.163.com', '126.com': 'http://mail.126.com', 'yeah.net': 'http://www.yeah.net/', 'sohu.com': 'http://mail.sohu.com/', 'tom.com': 'http://mail.tom.com/', 'sogou.com': 'http://mail.sogou.com/', '139.com': 'http://mail.10086.cn/', 'hotmail.com': 'http://www.hotmail.com', 'live.com': 'http://login.live.com/', 'live.cn': 'http://login.live.cn/', 'live.com.cn': 'http://login.live.com.cn', '189.com': 'http://webmail16.189.cn/webmail/', 'yahoo.com.cn': 'http://mail.cn.yahoo.com/', 'yahoo.cn': 'http://mail.cn.yahoo.com/', 'eyou.com': 'http://www.eyou.com/', '21cn.com': 'http://mail.21cn.com/', '188.com': 'http://www.188.com/', 'foxmail.coom': 'http://www.foxmail.com' };
        $(function(){
            var mail = "{{ session('old-email') }}";
                var url = mail.split('@')[1];
                for (var j in hash){
                    $("#goEmail").attr("href", hash[url]);
                }
        })
    </script>
@endsection

