@include('dashboard.layouts.partials.header')
<title>修改角色</title>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 class="fa fa-bars"> 修改角色</h5>
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
                            <label class="col-sm-3 control-label">角色名称：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="name" value="{{ $info->name }}"
                                       placeholder="角色名称">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>  角色名称</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">显示名称：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="display_name"
                                       value="{{ $info->display_name }}"
                                       placeholder="显示名称">
                            </div>
                        </div>
                        <div class="hr-line-dashed "></div>
                        <div class="form-group avalue">
                            <label class="col-sm-3 control-label">描述：</label>
                            <div class="input-group col-sm-4">
                                <textarea type="text" rows="5" name="description" class="form-control"
                                          placeholder="描述">{{ $info->description }}</textarea>
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>  256个字符以内</span>
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

        if (isEmpty('', $("input[name=name]").val(), '请输入角色名称') == false) {
            return false;
        }
        if (isEmpty('', $("textarea[name=description]").val(), '请输入角色描述') == false) {
            return false;
        }
        ajaxFormBtn("{{ dashboardUrl('/permission/'.$info->id.'/update') }}", 'btnForm');
    });

</script>
</body>
</html>