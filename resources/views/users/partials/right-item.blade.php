<div class="ui stacked segment">
    <div class="ui teal ribbon label"><i class="trophy icon"></i>

        @if(!$authUser)
            {{ $info->user_name.'我的' }}个人中心
        @else
            {{ $authUser->user_name == $info->user_name ? '我的':$info->user_name.'的'}}个人中心
        @endif
        </div>

    <div class="content extra-padding">
        <div class="ui attached tabular menu stackable">

            <a class="item @if($nowUrl == $defaultView) active @endif" data-tab="first" href="{{ $defaultView }}"><i class="icon feed"></i> 动态</a>
            <a class="item @if($nowUrl== $articleView ) active @endif" data-tab="first1" href="{{ $articleView  }}"><i class="icon file text outline"></i> 文章 <span class="counter">{{ $info->article_count }}</span> </a>
            <a class="item @if($nowUrl== $questionView ) active @endif" data-tab="first1" href="{{ $questionView  }}"><i class="help circle icon outline"></i> 问题 <span class="counter">{{ $info->question_count }}</span> </a>
            <a class="item @if($nowUrl == $followedView) active @endif" href="{{ $followedView }}"><i class="icon user outline"></i> 关注者 <span class="counter">{{  $info->followers->count()}}</span> </a>
            <a class="item @if($nowUrl == $followingView) active @endif" href="{{ $followingView }}"><i class="icon user outline"></i> 正在关注的人 <span class="counter">{{  $info->followings->count()}}</span> </a>
            <a class="item @if($nowUrl == $voteView) active @endif" href="{{ $voteView }}" ><i class="icon heart"></i> 关注的 </a>

        </div>

        <div class="ui feed">
            @if(count($activities))
                @if($nowUrl == $followingView || $nowUrl == $followedView)
                    @include('activities.followings')
                @else
                    @foreach($activities as $v)
                        @if($nowUrl == $defaultView)
                            @include('activities.type.'. snake_case(class_basename($v->type), '-'))
                        @elseif($nowUrl == $articleView)
                            @include('activities.article')
                        @elseif($nowUrl == $questionView)
                            @include('activities.question')
                        @elseif($nowUrl == $voteView)
                            @include('activities.voted')
                        @endif
                    @endforeach
                        {{ $activities->appends(request()->except('page'))->links() }}
                @endif
            @else
                <div class="ui feed no-messages">
                    <p class="text-center alert alert-info"> (=￣ω￣=) ···还没任何动静噢!</p>
                </div>
            @endif

        </div>

    </div>
</div>