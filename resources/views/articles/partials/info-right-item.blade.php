<div class="item header">
    <div class="ui container floating  violet segment" id="notify">
        <p><i class="volume up icon "></i>&nbsp;&nbsp;
            <span class="default-font"> {{ config('codehaoshi.notice.info_page_article') }}</span>
        </p>
    </div> {{--notify--}}

    <div class="ui segment">
        <div class="ui three statistics">
            <div class="ui mini statistic">
                <div class="value">{{ $info->vote_count }}</div>
                <div class="label">点赞</div>
            </div>
            <div class="ui mini statistic">
                <div class="value">{{ $info->view_count }}</div>
                <div class="label">浏览</div>
            </div>
            <div class="ui mini statistic">
                <div class="value">{{ $info->comment_count }}</div>
                <div class="label">评论</div>
            </div>
        </div>

        <br>
    </div>
</div>
<div class="ui stackable cards">
    <div class="ui  card column author-box grid" style="margin-top: 20px;">

        <div class="ui fluid" style="margin-top: 20px;">
            <div class="ui teal ribbon label"><i class="star icon"></i> 文章作者</div>
        </div>

        <a href="{{ route('user_center', ['user_name' => $info->user->user_name]) }}" class="avatar-link ">
            <img class="ui centered circular tiny image popover" data-content="{{ $info->user->user_name }}"
                 src="{{ $info->user->avatar }}"/>
        </a>

        <div class="extra content ui center aligned container">
            <a class="header"
               href="{{ route('user_center', ['user_name' => $info->user->user_name]) }}">{{ $info->user->user_name }}</a>
            <div class="description">{{ $info->user->introduction }}</div>
        </div>
        @if(!Auth::check())
            <vote-button is-checked="false" user="{{ $info->user_id }}"></vote-button>
        @else
            <vote-button is-checked="true" user="{{ $info->user_id }}"></vote-button>
        @endif

    </div>
</div>
<div class="ui segments">
    <div class="ui segment">
        <p><i class="wait icon"></i>最新文章</p>
    </div>
    <div class="ui secondary violet segment">
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

<div class="ui sticky" style="padding-top:20px;">
    <div class="ui  card column author-box grid " id="toc"></div>
</div>

