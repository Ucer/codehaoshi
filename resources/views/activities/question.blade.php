<div class="event">
    <div class="content">
        <div class="vote-user">
           <a href="{{ route('question.show', ['slug' => $v->slug]) }}" class="ui popover title" data-content="{{ $v->title }}"> {{ $v->title }}  </a>
        </div>
    </div>
    <div class="item-meta">
        <a class="ui label basic light grey" href=""><i class="clock icon"></i> {{ getDateWithSub($v->created_at) }}</a>
    </div>
</div>
