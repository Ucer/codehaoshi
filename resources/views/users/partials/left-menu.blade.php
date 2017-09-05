<div class="ui container grid">
    <div class="column">
        <div class="ui breadcrumb">
            <a href="/" class="section">首页</a>
            <span class="divider">/</span>
            <div class="active section">个人信息修改</div>
        </div>
    </div>
</div>
    <div class="ui centered grid container stackable" id="content">
        <div class="four wide column">
            <div class="ui  vertical pointing violet menu">
                <a href="{{ route('users.edit', ['id' => $authUser->id]) }}" class="item @if(request()->url() == route('users.edit', ['id' => $authUser->id])) active @endif">个人信息修改 </a>
                <a href="{{ route('users.edit_password', ['id' => $authUser->id]) }}" class="item @if(request()->url() == route('users.edit_password', ['id' => $authUser->id])) active @endif">密码修改 </a>
                <a href="{{ route('users.edit_email', ['id' => $authUser->id]) }}" class="item @if(request()->url() == route('users.edit_email', ['id' => $authUser->id])) active @endif">修改绑定邮箱 </a>
            </div>
        </div>
