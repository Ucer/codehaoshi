@extends('layouts.base')
@section('title')
    {{ $category->name }}-问答-问题分类
@endsection
@section('content')
    <div class="ui container grid">
        <div class="column">
            <div class="ui breadcrumb">
                <a href="/" class="section">首页</a>
                <span class="divider">/</span>
                <a href="{{ route('question.all') }}" class="section">问题</a>
                <span class="divider">/</span>
                <div class="active section">{{ $category->name }}</div>
            </div>
        </div>

    </div>

    <div class="ui centered grid container stackable">
        <div class="twelve wide column">
            <div class="ui  segment">
                <div class="content extra-padding">
                    <div class="book header">
                        <div class="ui items">
                            <div class="item">
                                <div class="image">
                                    <img class="ui image image-shadow cat-article-image "
                                         src="{{ $category->image_url }}">
                                </div>
                                <div class="content">
                                    <div class="header" style="width:100%"> {{ $category->name }}</div>
                                    <div class="description">
                                        <p><b class="ui text orange">问题数量：{{ $category->question_count }} </b></p>
                                        {{ $category->description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ui  attached tabular menu ">
                        <span class="item active " > <i class="grey content icon"></i> 问题列表 </span>
                    </div>
                    <br>
                    @include('questions.partials.question-list-form')
                </div>
            </div>
        </div>

        <div class="four wide column">
            @include('questions.partials.right-item')
        </div>

    </div>

@endsection