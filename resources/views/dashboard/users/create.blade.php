@include('dashboard.layouts.partials.header')
<title>用户添加</title>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 class="fa fa-bars"> 用户添加</h5>
                    <div class="ibox-tools">
                        <a href="javascript:history.go(-1)" title="返回">
                            <i class="fa fa-reply"> 返回</i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="btnForm" accept-charset="UTF-8">
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">账号：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="user_name"
                                       placeholder="账号">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>  用户名英文或数字组成,将作为登录账号</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">昵称：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="nickname"
                                       placeholder="昵称">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">邮箱：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="email"
                                       placeholder="邮箱">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 必填</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">密码：</label>
                            <div class="input-group col-sm-4">
                                <input type="password" class="form-control" name="password" value="" placeholder="密码">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 登录密码。由6-18位之间的数字、字母、下划线组成</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">确认密码：</label>
                            <div class="input-group col-sm-4">
                                <input type="password" class="form-control" name="password_confirmation"
                                       placeholder="确认密码">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">是否是后台管理员：</label>
                            <div class="input-group col-sm-4">
                                <div class="radio i-checks">
                                    <input type="radio" name='is_admin' value="yes"/>是&nbsp;&nbsp;
                                    <input type="radio" name='is_admin' value="no" checked/>否
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <a class="btn btn-primary saveBtn" id="saveBtn"><i class="fa fa-save"></i> 保存</a>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i>
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
        if (prexRule(/^[a-zA-Z0-9]+$/, $("input[name=user_name]").val(), '账号只能由数字和英文字母组成') == false) {
            return false;
        }
        if (prexRule(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/, $("input[name=email]").val(), '请输入正确的邮箱') == false) {
            return false;
        }
        var password = $("input[name=password]").val();
        var password_c = $("input[name=password_confirmation]").val();
        if (prexRule(/^[a-z0-9_-]{6,18}$/, password, '密码只能是6-18位之间的数字、字母、下划线') == false) {
            return false;
        }
        if (!password || $.trim(password) != $.trim(password_c)) {
            layer.msg('两次输入的密码不一致', {icon: 5, time: 2000}, function (index) {
                layer.close(index);
            });
            return false;
        }

        ajaxFormBtn("{{ dashboardUrl('/user/store') }}", 'btnForm');
    });

</script>
</body>
</html>