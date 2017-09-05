<div class="ui inverted vertical footer segment">
    <div class="ui center aligned container">
        <div class="ui stackable inverted divided grid">
            <div class="four wide column">
                <h4 class="ui inverted header">友链</h4>
                <div class="ui inverted link list">
                    @foreach($linkList as $v)
                        <a href="{{ $v->link }}" class="item no_marakdown" target="_blank">{{ $v->title }}</a>
                    @endforeach
                </div>
            </div>
            <div class="four wide column">
                <h4 class="ui inverted header">资源推荐</h4>
                <div class="ui inverted link list">
                    @foreach($recommendList as $v)
                        <a href="{{ $v->link }}" class="item no_marakdown" target="_blank">{{ $v->title }}</a>
                    @endforeach
                </div>
            </div>
            <div class="eight wide column">
                <h4 class="ui inverted  header">Code好事</h4>
                <p>
                    1.好记性不如烂笔头,动起来
                </p>
                <p>
                    2.走过的路、踩过的坑
                </p>
            </div>
        </div>

        <div class="ui inverted section divider"></div>
        <div>

            <p style="font-size:0.9em; margin-top:20px;margin-bottom: -8px;color: rgb(137, 137, 140);"
               class="ui inverted ">
                © 2017 Powered by <a href="http://weibo.com/5652504009/profile?rightmod=1&wvr=6&mod=personinfo"
                                     target="_blank" style="color: inherit;">Ucer</a>
                <span style="color: #e27575;font-size: 14px;">❤</span>
            </p>
        </div>
    </div>
</div>