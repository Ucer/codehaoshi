@include('dashboard.layouts.partials.header')
<title>友情链接添加</title>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 class="fa fa-bars"> 友情链接添加</h5>
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
                            <label class="col-sm-3 control-label">标题：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="title"
                                       placeholder="标题">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>  标题</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">类型：</label>
                            <div class="form-group">
                                <div class="col-md-1">
                                    <select class="form-control m-b" id="attribute" name="type">
                                        <option value="link">友链</option>
                                        <option value="recommend">推荐资源</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">url：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="link"
                                       placeholder="url">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>  link</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">状态：</label>
                            <div class="form-group">
                                <div class="col-md-1">
                                    <select class="form-control m-b" id="attribute" name="is_enabled">
                                        <option value="yes">启用</option>
                                        <option value="no">非启用</option>
                                    </select>
                                </div>
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
    /*表单提交*/
    $("#saveBtn").click(function () {

        if (isEmpty('', $("input[name=title]").val(), '请输入友情链接标题') == false) {
            return false;
        }
        if (isEmpty('', $("input[name=link]").val(), '请输入 url') == false) {
            return false;
        }
        ajaxFormBtn("{{ dashboardUrl('/links/store') }}", 'btnForm');
    });

</script>
</body>
</html>