@include('dashboard.layouts.partials.header')
<title>文章分类修改</title>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 class="fa fa-bars"> 分类修改</h5>
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
                            <label class="col-sm-3 control-label">分类名称：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="name" value="{{ $info->name }}"
                                       placeholder="分类名称">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>  分类名称</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">分类别名：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="slug" value="{{ $info->slug }}"
                                       placeholder="分类别名">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>  分类别名，只能由 3-40 位数字英文字母、下划线组成</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">封面图片：</label>
                            <div class="input-group col-sm-1">
                                <a class="btn btn-info" href="javascript:void(0);" style="float: left"
                                   uploader="image_url"
                                   data-url="{{ url('file/upload') }}" data-path="temp">+ 浏览文件
                                    <input type="hidden" name="image_url" id="image_url" value="{{ $info->image_url }}">
                                </a>
                                <img height="100px" id="image_url_img"
                                     style="float:left;margin-left: 120px;margin-top: -50px;"
                                     onerror="this.src='/assets/dashboard/images/no_img.jpg'"
                                     src="{{ $info->image_url }}"/>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group avalue">
                            <label class="col-sm-3 control-label">描述：</label>
                            <div class="input-group col-sm-4">
                                <textarea type="text" rows="5" name="description" class="form-control"
                                          placeholder="描述">{{ $info->description }}</textarea>
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>  256个字符以内</span>
                            </div>
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
                            <label class="col-sm-3 control-label">权重：</label>
                            <div class="input-group col-sm-4">
                                <input type="number" class="form-control" name="weight" value="{{ $info->weight }}"
                                       placeholder="0">
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
    /*表单提交*/
    $("#saveBtn").click(function () {

        if (isEmpty('', $("input[name=name]").val(), '请输入分类名称') == false) {
            return false;
        }
        if (prexRule(/^[a-z0-9_-]{3,40}$/, $("input[name=slug]").val(), '别名只能由 3-40 位的数字、字母、下划线组成') == false) {
            return false;
        }
        if (isEmpty('', $("input[name=image_url]").val(), '请上传分类图片') == false) {
            return false;
        }
        if (isEmpty('', $("textarea[name=description]").val(), '请输入分类描述') == false) {
            return false;
        }
        ajaxFormBtn("{{ dashboardUrl('/articleCategory/'.$info->id.'/update') }}", 'btnForm');
    });

</script>
</body>
</html>