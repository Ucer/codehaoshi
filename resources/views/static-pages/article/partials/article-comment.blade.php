<div class="ui threaded comments comment-list ">

    <div id="comments"></div>

    <div class="ui divider horizontal grey"><i class="icon comments"></i> 评论数量: 1</div>

    <div class="comments-feed">
        <div class="comment comment-436">
            <div id="comments"></div>
            <a class="avatar" href="https://fsdhub.com/iHero">
                <img src="https://fsdhubcdn.phphub.org/uploads/avatars/1661_1498013381.jpeg?imageView2/1/w/100/h/100&amp;e=1501301149&amp;token=2vxC9mwLd9SS1hS_uqfK99SsyG2qVm-BWFXuVl96:8RTZu1zmRq2stdIiQmlyQmNIEwU=">
            </a>
            <div class="content">
                <div class="comment-header">
                    <div class="meta">
                        <a class="author" href="https://fsdhub.com/iHero">iHero</a>
                        <div class="metadata">
                            <span class="date">1个月前</span>
                        </div>
                    </div>
                    <div class="reaction">
                        <div class="ui floating basic icon dropdown button" tabindex="0">
                            <a href="javascript:void(0)" title="回复 iHero"
                               class="ui teal reply-btn" style="display: none;"><i class="icon reply"></i></a>

                            <div class="menu" tabindex="-1"></div>
                        </div>
                    </div>
                </div>
                <div class="text comment-body markdown-reply">
                    <p>主机上的提示符 “&gt;” 是怎么修改的？ </p>
                </div>
            </div>
        </div>
        <div class="comment comment-436">
            <div id="comments-436"></div>
            <a class="avatar" href="https://fsdhub.com/iHero">
                <img src="https://fsdhubcdn.phphub.org/uploads/avatars/1661_1498013381.jpeg?imageView2/1/w/100/h/100&amp;e=1501301149&amp;token=2vxC9mwLd9SS1hS_uqfK99SsyG2qVm-BWFXuVl96:8RTZu1zmRq2stdIiQmlyQmNIEwU=">
            </a>
            <div class="content">
                <div class="comment-header">
                    <div class="meta">
                        <a class="author" href="https://fsdhub.com/iHero">iHero</a>
                        <div class="metadata">
                            <span class="date">1个月前</span>
                        </div>
                    </div>
                    <div class="reaction">
                        <div class="ui floating basic icon dropdown button" tabindex="0">
                            <a href="javascript:void(0)" onclick="replyOne('iHero');" title="回复 iHero"
                               class="ui teal reply-btn" style="display: none;"><i class="icon reply"></i></a>
                            <div class="menu" tabindex="-1"></div>
                        </div>
                    </div>
                </div>
                <div class="text comment-body markdown-reply">
                    <p>主机上的提示符 “&gt;” 是怎么修改的？ </p>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="">
        @if(!Auth::check())
            <h3 class="ui header">
                <a href="" class="login-required">请登录</a>
            </h3>
        @endif
        <div class="ui warning message">
            <i class="icon warning"></i> 支持 markdown 语法、支持表情,请务进行语言攻击。
        </div>

        <form class="ui reply form" method="POST" action="{{ route('replies.store') }}"
              accept-charset="UTF-8" id="comment-composing-form">

            <input type="hidden" name="article_id" value="{{ $info->id }}"/>

            <div class="field">
                    <textarea name="content" id="comment-composing-box" required=""
                              class="@if(!Auth::check()) login-required @endif"></textarea>
            </div>
            <button class="ui primary labeled icon button @if(!Auth::check()) login-required @endif" type="submit"
                    id="comment-composing-submit">
                <i class="icon comment"></i> 评论
            </button>
        </form>
    </div>
</div>