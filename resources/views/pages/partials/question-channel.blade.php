<div class="ui middle aligned centered grid">
    <div class="row">
        <div class="ui grid 992px-1200px">
            <div class="ui vertical divider home-page-divider default-color-a"><i class="hand paper icon"></i>&nbsp;&nbsp;问答频道
            </div>
        </div>
        <div class="ui ten wide column">
            <div class="ui two stackable link cards">
                @forelse($questionCategoryList as $v)
                    <div class="card">
                        <a href="{{ url('/q/'. $v->slug) }}" class="image">
                            <img src="{{ $v->image_url }}">
                        </a>
                        <div class="content">
                            <a href="{{ url('/q/'. $v->slug) }}" class="header">{{ $v->name }}</a>
                            <div class="description">{{ $v->description }}</div>
                        </div>
                        <div class="extra content green">
                            <span class="right floated">
                                @if($v->recent_update)
                                    更新于 {{ getDateWithSub($v->recent_update) }}
                                @else
                                    努力更新中. . .
                                @endif
                         </span>
                            <span><i class="file text icon"></i> {{ $v->question_count }}个问题</span>
                        </div>
                    </div>
                @empty
                    <div class="ui feed no-messages">
                        <p class="text-center alert alert-info">!
                            (=￣ω￣=) ··· 还没有数据噢。
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div> {{--资讯频道--}}

