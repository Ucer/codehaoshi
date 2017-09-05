@extends('layouts.base')
@section('title')
    创作文章
@endsection
@section('content')
    <div class="ui container grid">
        <div class="column">
            <div class="ui breadcrumb">
                <a href="/" class="section">首页</a>
                <span class="divider">/</span>
                <a href="{{ route('article.all') }}" class="section">资源</a>
                <span class="divider">/</span>
                <div class="active section">创作文章</div>
            </div>
        </div>
    </div>
    <div class="ui centered grid container stackable" id="content">
        <div class="twelve wide column">
            <div class="ui segment article-content">
                <div class="ui warning message">
                    <ul class="list">
                        <li>1.请文明推文。</li>
                    </ul>
                </div>
                <div class="ui divider"></div>
                <form class="ui form" action="{{ route('articles.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="field">
                        <label>所属分类</label>
                        <div class="ui selection dropdown">
                            <input type="hidden" name="category_id" value="{{ old('category_id') }}">
                            <i class="dropdown icon"></i>
                            <div class="default text">请选择分类</div>
                            <div class="menu">
                                @foreach($catList as $v)
                                    <div class="item" data-value="{{ $v->id }}">{{ $v->name }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>标签</label>
                        <div class="ui multiple selection dropdown" multiple="2">
                            <!-- This will receive comma separated value like OH,TX,WY !-->
                            <input name="tags" type="hidden" value="{{ old('tags') }}">
                            <i class="dropdown icon"></i>
                            <div class="default text">选择标签</div>
                            <div class="menu">
                                @foreach($tagList as  $tag)
                                    <div class="item" data-value="{{ $tag->id }}">{{ $tag->tag }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>标题</label>
                        <input type="text" name="title" placeholder="标题" value="{{ old('title') }}">

                        @if ($errors->has('title'))
                            <div class="ui compact red message" style="padding: 0px 12px 0px 0px;">
                                <p><i class="icon warning"></i>{{ $errors->first('title') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="field">
                        <label>简单描述</label>
                        <textarea rows="2" name="description">{{ old('description') }}</textarea>
                    </div>
                    <div class="field">
                        <label>内容</label>
                        <textarea id="topic_content" name="content"></textarea>
                    </div>
                    <div class="field">
                        <label>是否保存为草稿</label>
                        <div class="ui selection dropdown">
                            <input type="hidden" name="is_draft" value="{{ old('is_draft')?:'no' }}">
                            <i class="dropdown icon"></i>
                            <div class="default text">是否保存为草稿</div>
                            <div class="menu">
                                <div class="item" data-value="no">否</div>
                                <div class="item" data-value="yes">是</div>
                            </div>
                        </div>
                    </div>
                    <div class="ui buttons">
                        <button class="ui orange button" type="reset">重置</button>
                        <div class="or"></div>
                        <button class="ui positive button" type="submit">提交</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="four wide column">

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
            <div class="ui segments">
                <div class="ui segment">
                    <p><i class="wait icon"></i>最新问答</p>
                </div>
                <div class="ui secondary violet segment">
                    <div class="ui list">
                        @foreach( $recentQuestions as $k=>$v)
                            <div class=" black-font">
                                <a href="{{ route('question.show', ['slug' => $v->slug]) }}" class="ui titlepop"
                                   data-content="{{ $v->title }}">{{ $k+1 }}.{{ $v->title }}</a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="ui sticky">
                <div class="ui  card column  grid" style="margin-top: 20px;">
                    <div class="ui fluid" style="margin-top: 20px;">
                        <div class="ui teal ribbon label"><i class="star icon"></i> 标签墙</div>
                    </div>
                    <div class="extra">
                        @foreach($tags as $tag)
                            <a href="{{ url('tag',['slug' => $tag->slug]) }}"
                               class="ui  {{ getTagWeight($tag->weight) }} {{ $tag->style }} label lable-list">{{ $tag->tag }}</a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    {{--<script src="/assets/dashboard/js/plugins/simplemde/latest/simplemde.min.js"></script>--}}
    <script src= {{ mix('assets/js/editor.js') }}></script>
    <link rel="stylesheet" href="{{ mix('assets/css/editor.css') }}">
    {{--<link rel="stylesheet" href="/assets/dashboard/js/plugins/simplemde/latest/simplemde.min.css">--}}
    <script>
        $(document).ready(function () {
            /*Markdown ------------start */
            var simplemde = new SimpleMDE({
                spellChecker: false,
                autosave: {
                    enabled: true,
                    delay: 2000,
                    unique_id: "topic_content{{ isset($info) ? $info->id . '_' . str_slug($info->updated_at) : '' }}"
                },
                forceSync: true,
                tabSize: 4,
                toolbar: [
                    "bold", "italic", "heading", "|", "quote", "code", "table",
                    "horizontal-rule", "unordered-list", "ordered-list", "|",
                    "link", "image", "|", "side-by-side", 'fullscreen', "|",
                    {
                        name: "guide",
                        action: function customFunction(editor) {
                            var win = window.open('https://github.com/riku/Markdown-Syntax-CN/blob/master/syntax.md', '_blank');
                            if (win) {
                                //Browser has allowed it to be opened
                                win.focus();
                            } else {
                                //Browser has blocked it
                                alert('Please allow popups for this website');
                            }
                        },
                        className: "fa fa-info-circle",
                        title: "Markdown 语法！",
                    },
                ],
                element: document.getElementById("topic_content"),
            });

            inlineAttachment.editors.codemirror4.attach(simplemde.codemirror, {
                uploadUrl: Laravel.uploadImage,
                extraParams: {
                    '_token': Laravel.csrfToken,
                },
                onFileUploadResponse: function (xhr) {
                    var result = JSON.parse(xhr.responseText),
                        filename = result[this.settings.jsonFieldName];

                    if (result && filename) {
                        var newValue;
                        if (typeof this.settings.urlText === 'function') {
                            newValue = this.settings.urlText.call(this, filename, result);
                        } else {
                            newValue = this.settings.urlText.replace(this.filenameTag, filename);
                        }
                        var text = this.editor.getValue().replace(this.lastValue, newValue);
                        this.editor.setValue(text);
                        this.settings.onFileUploaded.call(this, filename);
                    }
                    return false;
                }
            });
        });
    </script>
    @include('form-validate.auth.v-topic')
@endsection