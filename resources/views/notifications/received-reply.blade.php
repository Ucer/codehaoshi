<div class="ui list  notification-list">
    <div class="item">
        <i class="comment icon"></i>
        <div class="content notify-list">
            <a class="header" style="color:#525252!important;">问题回复通知：</a>
            <div class="description">
                <a href="{{ route('user_center',['user_name' =>$v->data['user_name'] ] ) }}">
                    {{ $v->data['user_name'] }} &nbsp;
                </a>
                回复了您的问题：
                <a href="{{ route('question.show', ['slug' => $v->data['question_slug']]) }}"
                   title="{{ $v->data['question_title'] }}">
                    {{ $v->data['question_title'] }}
                </a>
                {{--<span class="ui mini grey basic button right floated">delete</span>--}}
            </div>
        </div>
    </div>
</div>