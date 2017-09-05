<div class="event">
    <div class="content">
        <div class="vote-user">
            @if($v->type == 'UserUpvoteArticle')
                <i class="icon file text"></i>
                <a href="{{ route('article.show', ['slug' => $v->data['article_slug']]) }}" class="title"
                   title="{{ $v->data['article_title'] }}">
                    {{ $v->data['article_title'] }}
                </a>
            @else
                <i class="icon help circle"></i>
                <a href="{{ route('question.show', ['slug' => $v->data['article_slug']]) }}" class="title"
                   title="{{ $v->data['article_title'] }}">
                    {{ $v->data['article_title'] }}
                </a>
            @endif
        </div>
    </div>
    <div class="item-meta">
        <a class="ui label basic light grey" href=""><i class="clock icon"></i> {{ getDateWithSub($v->created_at) }}
        </a>
    </div>
</div>
