@extends('layouts.base')
@section('content')
    <div class="ui centered grid container books-page">
        <div class="twelve wide column">
            <div class="ui  segment">
                <div class="content extra-padding">
                    <div class="book header">
                        <div class="ui items">
                            <div class="item">
                                <div class="image">
                                    <img class="ui image image-shadow "
                                         src="http://www.semantic-ui.cn/images/avatar2/large/matthew.png">
                                </div>
                                <div class="content">
                                    <div class="header" style="width:100%"> 编程语言</div>
                                    <div class="description">
                                        <p><b class="ui text orange">文章数量：69 </b></p>
                                        java、php、日常记java、php、日常记录java、php、日常记录录
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ui  attached tabular menu">
                        <a class="item active" data-tab="first" href=""> <i class="grey content icon"></i> 文章列表 </a>
                    </div>
                    <br>
                    <ul class="sorted_table tree ">

                        <li class="item">
                            <i class="blue folder icon"></i> 2017-03
                            <ol class="chapter-container">
                                <div class="ui relaxed divided items">
                                    <li class="item">
                                        <div class="ui small image">
                                            <img src="http://www.semantic-ui.cn/examples/assets/images/wireframe/image.png">
                                        </div>
                                        <div class="content">
                                            <a class="header">Content Header</a>
                                            <div class="meta">
                                                <a>Date</a>
                                                <a>Category</a>
                                            </div>
                                            <div class="description">
                                                A description which may flow for several lines and give context to the
                                                content.
                                            </div>
                                            <div class="extra">
                                                <div class="ui right floated primary button">
                                                    Primary
                                                    <i class="right chevron icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="ui small image">
                                            <img src="http://www.semantic-ui.cn/examples/assets/images/wireframe/image.png">
                                        </div>
                                        <div class="content">
                                            <a class="header">Content Header</a>
                                            <div class="meta">
                                                <a>Date</a>
                                                <a>Category</a>
                                            </div>
                                            <div class="description">
                                                A description which may flow for several lines and give context to the
                                                content.
                                            </div>
                                            <div class="extra">
                                                <div class="ui right floated primary button">
                                                    Primary
                                                    <i class="right chevron icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </div>
                                <li class="item">
                                    <i class="grey file text outline icon"></i>
                                    <a href="" class="">
                                        <div class="ui green horizontal small label">php</div>
                                        1.1. 序言 </a>
                                    <span class="pull-right ui text grey"> <i class="icon lock "></i> </span>
                                </li>
                            </ol>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="four wide column"></div>

    </div>

@endsection