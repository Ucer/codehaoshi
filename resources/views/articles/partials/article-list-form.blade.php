<ul class="sorted_table tree ">
    <div class="jscroll">
        <div class="ui celled list">
            @forelse($articles as $v)
                <div class="item">
                    <div class="right floated content labels">
                        @foreach($v->tags as $tag)
                            @break($loop->index >0)
                            <a class="item" href="{{ url('tag',['slug' => $tag->slug]) }}">
                                <div class="ui {{ $tag->style }} horizontal label">{{ $tag->tag }}</div>
                            </a>
                        @endforeach
                        <span class="labels-time" title="评论数">{{ $v->comment_count }}</span>/
                        <span class="labels-time" title="点赞数">{{ $v->vote_count }}</span>/
                        <span class="labels-time" title="查看数">{{ $v->view_count }}</span>&nbsp;&nbsp;&nbsp;
                        <span class="labels-time" title="发布时间">{{ $v->created_at->diffForHumans() }}</span>
                    </div>
                    <img class="ui avatar image avatar-b popover"
                         onclick="location.href= '{{ route('user_center', ['user_name' => $v->user->user_name]) }}'"
                         alt="{{ $v->user->user_name }}" data-content="{{ $v->user->user_name }}"
                         src="{{ $v->user->avatar }}">
                    <div class="content">
                        <a href="{{ route('article.show', ['slug' => $v->slug]) }}" class="no_marakdown">
                            <div class="ui popover" style="font-weight: bold"
                                 data-content="{{ $v->title }}">{{ str_limit($v->title, 60) }}</div>
                        </a>
                        {{ str_limit($v->description, 60) }}
                    </div>
                </div>
            @empty
                <div class="ui feed no-messages">
                    <p class="text-center alert alert-info">!
                        (=￣ω￣=) ··· 还没有数据噢。
                    </p>
                </div>
            @endforelse
            <div class="panel-footer " style="display: block;">
                <!-- Pager -->
                {{ $articles->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</ul>
