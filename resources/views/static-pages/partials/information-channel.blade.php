<div class="ui middle aligned four column centered grid">
    <div class="row">
        <div class="ui grid">
            <div class="ui vertical divider home-page-divider default-color-a"><i class="fire icon"></i>&nbsp;&nbsp;资讯频道
            </div>
        </div>
        @foreach($categoryAndQuestions->categoryList as $v)
            @if($loop->first)
                <div class="column">
                    <div class=" ui link card small-card ">
                        <div class="image">
                            <img src="{{ $v->image_url }}">
                        </div>
                        <div class="content">
                            <a href="">
                                <div class="header">{{ $v->name }}</div>
                            </a>
                            <div class="description">{{ $v->description }}</div>
                        </div>
                        <div class="extra content green">
                            <span class="right floated">更新于 {{ $v->created_at->diffForHumans() }}</span>
                            <span><i class="file text icon"></i> {{ $v->article_count }}篇文章</span>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div> {{--资讯频道--}}
