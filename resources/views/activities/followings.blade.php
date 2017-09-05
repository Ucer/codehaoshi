<div class="ui huge horizontal divided list">

    @foreach($activities as $v)
        <div class="item">
            <a href="{{ route('user_center',['user_name' =>$v->user_name ] ) }}" class="ui popover" data-title="{{ $v->user_name }}" data-content="{{ $v->introduction }}" >
                <img class="ui avatar image" src="{{ $v->avatar }}" >
            </a>
        </div>
    @endforeach
</div>