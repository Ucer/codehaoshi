@extends('layouts.base')
@section('title')
    Code好事 - 首页
@endsection
@section('content')
    <div class="ui container floating  violet segment" id="notify">
        <p><i class="volume up icon "></i>&nbsp;&nbsp;
            <span class="default-font">{{ lang(config('codehaoshi.notice.home_page_article')) }}</span>
        </p>
    </div> {{--notify--}}

    <div class="ui  grid container stackable">
        <div class="sixteen wide column">
            @include('pages/partials/information-channel')

            <div class="ui container floating  violet segment" id="notify">
                <p><i class="volume up icon "></i>&nbsp;&nbsp;
                    <span class="default-font">{{ lang(config('codehaoshi.notice.home_page_question')) }} </span>
                </p>
            </div> {{--notify--}}

            @include('pages.partials.question-channel')

            <div class="ui segment article-content">
                <div class="extra-padding">
                    @include('pages.partials.hot-article')
                    <h4 class="ui horizontal divider header default-color-a"><i class="bar chart icon"></i> {{ config('app.name') }}</h4>
                    @include('pages.partials.hot-question')

                </div>
            </div>
        </div>
    </div> {{--pagebody--}}
@endsection
