<div class="item header">
    <div class="ui segments">
        <div class="ui segment">
            <p><i class="fire icon"></i>热门文章</p>
        </div>
        <div class="ui secondary violet segment">
            <div class="ui list">
                @foreach( $hotArticles as $k=>$v)
                    <div class=" black-font">
                        <a href="{{ route('article.show', ['slug' => $v->slug]) }}" class="ui titlepop"
                           data-content="{{ $v->title }}">{{ $k+1 }}.{{ $v->title }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="ui segments">
        <div class="ui segment">
            <p><i class="wait icon"></i>最新文章</p>
        </div>
        <div class="ui secondary violet segment sticky">
            <div class="ui list">
                @foreach( $recentArticles as $k=>$v)
                    <div class=" black-font">
                        <a href="{{ route('article.show', ['slug' => $v->slug]) }}" class="ui titlepop"
                           data-content="{{ $v->title }}">{{ $k+1 }}.{{ $v->title }}</a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <div class="ui sticky">
        <div class="ui  card column  grid" style="margin-top: 20px;">
            <div class="ui fluid" style="margin-top: 20px;">
                <div class="ui teal ribbon label"><i class="star icon"></i> 标签墙</div>
            </div>
            <div class="extra">
                @foreach($tags as $tag)
                    <a href="{{ url('tag',['slug' => $tag->slug]) }}"
                       class="ui  {{ getTagWeight($tag->weight) }} {{ $tag->style }} label lable-list">{{ $tag->tag }}</a>
                @endforeach
            </div>

        </div>
    </div>
</div>