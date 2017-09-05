<div class="event">
    <div class="label">
        <a href="{{ route('user_center',['user_name' =>$v->user->user_name ] ) }}" class="ui popover"
           data-title="{{ $v->user->user_name }}" data-content="{{ $v->user->introduction }}">
            <img src="{{ $v->user->avatar }}"/>
        </a>
    </div>
    <div class="content">
        <div class="date">
            赞了问题：
        </div>
        <div class="">
            <a href="{{ route('question.show', ['slug' => $v->data['article_slug']]) }}" class="title"  title="{{ $v->data['article_title'] }}">
                {{ $v->data['article_title'] }}
            </a>
        </div>

    </div>

    <div class="item-meta">
        <a class="ui label basic light grey" href=""><i class="clock icon"></i> {{ getDateWithSub($v->created_at) }}</a>
    </div>
</div>
