<div class="ui list  notification-list">
    <div class="item">
        <i class="heart icon"></i>
        <div class="content notify-list">
            <a class="header" style="color:#525252!important;">用户关注通知：</a>
            <div class="description">
                <a href="{{ route('user_center',['user_name' =>$v->data['user_name'] ] ) }}">
                    {{ $v->data['user_name'] }} &nbsp;
                </a>
                关注了您
                {{--<span class="ui mini grey basic button right floated">delete</span>--}}
            </div>
        </div>
    </div>
</div>