@extends('layouts.base')

@section('content')
    <div class="ui container floating  violet segment" id="notify">
        <p><i class="volume up icon "></i>&nbsp;&nbsp;
            <span class="default-font">一坑一成长.天天踩坑天天长!</span>
        </p>
    </div> {{--notify--}}

    <div class="ui  grid container stackable">
        <div class="sixteen wide column">
            @include('static-pages/partials/information-channel')

            <div class="ui container floating  violet segment" id="notify">
                <p><i class="volume up icon "></i>&nbsp;&nbsp;
                    <span class="default-font">一问一成长.天天提问天天长! </span>
                </p>
            </div> {{--notify--}}

            @include('static-pages/partials/question-channel')

            <div class="ui segment article-content">
                <div class="extra-padding">
                    @include('static-pages/partials/hot-article')
                    <h4 class="ui horizontal divider header default-color-a"><i class="bar chart icon"></i> {{ config('app.name') }}</h4>
                    @include('static-pages/partials/hot-question')

                </div>
            </div>
        </div>
    </div> {{--pagebody--}}
@endsection
