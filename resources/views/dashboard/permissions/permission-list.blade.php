@include('dashboard.layouts.partials.header')
<title>权限列表</title>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>权限列表</h5>
                    <div class="ibox-content">
                        <form action="" id="subForm" onsubmit="return false" method="post">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="keywords" value=""
                                               placeholder="输入权限名称"/>
                                        <span class="input-group-btn">
                                        <button type="submit" onclick="ajaxList('subForm','/dashboard/permission/ajaxPermissions')"
                                                class="btn btn-primary"><i class="fa fa-search"></i> 搜索</button>
                                    </span>
                                    </div>
                                </div>
                                <div class="col-sm-2 pull-right">
                                    <div class="btn-group pull-right" role="group" style="clear: both">
                                        <a href="{{ dashboardUrl('/permission/create') }}"
                                           class="btn btn-outline btn-default "><i class="fa fa-plus"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="hr-line-dashed"></div>
                        <div id="ajax_return"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 加载动画 -->
<div class="spiner-example">
    <div class="sk-spinner sk-spinner-three-bounce">
        <div class="sk-bounce1"></div>
        <div class="sk-bounce2"></div>
        <div class="sk-bounce3"></div>
    </div>
</div>
@include('dashboard.layouts.partials.footer')
<script type="text/javascript">
    //第一页
    $(document).ready(function () {
        form = 'subForm';//表单id 全局变量
        p = 1;//当前分页
        turl = '/dashboard/permission/ajaxPermissions?page=' + p;//url
        ajaxList(form, turl);
    });
</script>
</body>
