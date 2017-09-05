@include('dashboard.layouts.partials.header')
<title>标签修改</title>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 class="fa fa-bars"> 标签修改</h5>
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
                            <label class="col-sm-3 control-label">标签名称：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="tag" value="{{ $info->tag }}"
                                       placeholder="标签名称">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>  标签名称</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">别名：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="slug" value="{{ $info->slug }}"
                                       placeholder="别名">
                            </div>
                        </div>
                        <div class="hr-line-dashed "></div>
                        <div class="form-group avalue">
                            <label class="col-sm-3 control-label">描述：</label>
                            <div class="input-group col-sm-4">
                                <textarea type="text" rows="5" name="description" class="form-control"
                                          placeholder="描述"> {{ $info->description }}</textarea>
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>  256个字符以内</span>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">样式：</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" class="form-control" name="style" value="{{ $info->style }}"
                                           placeholder="violet">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>
                                    purple、violet、red、orange、olive、green、teal、blue、black</span>
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

        if (isEmpty('', $("input[name=tag]").val(), '请输入标签名称') == false) {
            return false;
        }
        if (prexRule(/^[a-z0-9_-]{3,40}$/, $("input[name=slug]").val(), '别名只能由 3-40 位的数字、字母、下划线组成') == false) {
            return false;
        }
        if (isEmpty('', $("textarea[name=description]").val(), '请输入标签描述') == false) {
            return false;
        }
        ajaxFormBtn("{{ dashboardUrl('/tag/'.$info->id.'/update') }}", 'btnForm');
    });

</script>
</body>
</html>