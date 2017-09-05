<div class="ui list  notification-list">
    <div class="item">
        <i class="comment icon"></i>
        <div class="content notify-list">
            <a class="header" style="color:#525252!important;">文章评论通知：</a>
            <div class="description">
                <a href="{{ route('user_center',['user_name' =>$v->data['user_name'] ] ) }}">
                    {{ $v->data['user_name'] }} &nbsp;
                </a>
                评论了您的文章：
                <a href="{{ route('article.show', ['slug' => $v->data['article_slug']]) }}"
                   title="{{ $v->data['article_title'] }}">
                    {{ $v->data['article_title'] }}
                </a>
                {{--<span class="ui mini grey basic button right floated">delete</span>--}}
            </div>
        </div>
    </div>
</div>