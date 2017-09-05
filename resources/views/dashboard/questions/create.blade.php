@include('dashboard.layouts.partials.header')
<title>问题添加</title>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 class="fa fa-bars"> 问题添加</h5>
                    <div class="ibox-tools">
                        <a href="javascript:history.go(-1)" title="返回">
                            <i class="fa fa-reply"> 返回</i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="btnForm">
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">问题标题：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="title"
                                       placeholder="问题标题">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>  问题标题</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">问题分类：</label>
                            <div class="form-group">
                                <div class="col-md-2">
                                    <select class="form-control m-b chosen-select" name="category_id">
                                        <option value="">选择分类</option>
                                        @foreach($catList as $v)
                                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group avalue">
                            <label class="col-sm-3 control-label">内容：</label>
                            <div class="input-group col-sm-8">
                                <textarea name="content" id="editor" class="form-control"
                                          placeholder="内容"></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group avalue">
                            <label class="col-sm-3 control-label">描述：</label>
                            <div class="input-group col-sm-4">
                                <textarea type="text" rows="5" name="description" class="form-control"
                                          placeholder="描述"></textarea>
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>  256个字符以内</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">问题标签：</label>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <select class="form-control m-b chosen-select" multiple size="2"
                                            id="tags" data-placeholder="点击选择问题标签">
                                        @foreach($tagList as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="tags">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>问题标签，建议最多选择两个</span>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">问题相关属性：</label>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <select class="form-control m-b chosen-select" multiple
                                            id="attribute" data-placeholder="点击选择问题相关属性">
                                        <option value="1">优秀问题</option>
                                        <option value="2">热门问题</option>
                                        <option value="3">私人问题</option>
                                        <option value="4">草稿</option>
                                    </select>
                                    <input type="hidden" name="attribute">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>优秀问题、热门问题(推荐)、私人问题(仅自己可见)、草稿</span>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group avalue">
                            <label class="col-sm-3 control-label">发布时间：</label>
                            <div class="input-group col-sm-4">
                                <input class="form-control layer-date" placeholder="YYYY-MM-DD hh:mm:ss"
                                       name="published_at" time_plugin="published_at">
                                <label class="laydate-icon"></label>
                            </div>
                        </div>
                        <div class="hr-line-dashed "></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">权重：</label>
                            <div class="input-group col-sm-4">
                                <input type="number" class="form-control" name="weight"
                                       value="50">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>  权重，关系到排序</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <a class="btn btn-primary saveBtn" id="saveBtn"><i class="fa fa-save"></i> 保存</a>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i
                                            class="fa fa-close"></i>
                                    返回</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('dashboard.layouts.partials.footer')

<script>

    /*Markdown ------------start */
    var simplemde = new SimpleMDE({
        spellChecker: false,
        autosave: {
            enabled: true,
            delay: 2000,
            unique_id: "dashboard_question_create_content"
        },
        element: document.getElementById("editor"),
        autoDownloadFontAwesome: true,
        forceSync: true,
        tabSize: 4,
    });

    /*表单提交*/
    $("#saveBtn").click(function () {

        if (isEmpty('', $("input[name=title]").val(), '请输入问题标题') == false) {
            return false;
        }
        if (isEmpty('', $("select[name=category_id]").val(), '请选择问题分类') == false) {
            return false;
        }
        if (isEmpty('', $("textarea[name=description]").val(), '请输入问题描述') == false) {
            return false;
        }
        $("textarea[name=content]").val(simplemde.value());
        ajaxFormBtn("{{ dashboardUrl('/question/store') }}", 'btnForm');
    });


    /*选择商品多选下拉框 ------------start */
    //多选初始化
    $(function () {
        $("#tags").chosen({
            max_selected_options: 2,
            no_results_text: '无匹配项',
            display_selected_options: false
        });
    });
    //获取选中的值
    $('#attribute').on('change', function (e, params) {
        var data = '';
        $("input[name=attribute]").val($(this).val());
        $('.chosen-choices li a').each(function (index, el) {
            if (index == 0) {
                data += $(this).text();
            } else {
                data += ',' + $(this).text();
            }
        });

    });
    $('#tags').on('change', function (e, params) {
        var data = '';
        $("input[name=tags]").val($(this).val());
        $('.chosen-choices li a').each(function (index, el) {
            if (index == 0) {
                data += $(this).text();
            } else {
                data += ',' + $(this).text();
            }
        });

    });
</script>
</body>
</html>