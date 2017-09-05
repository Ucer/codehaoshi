@include('dashboard.layouts.partials.header')
<title>文章列表</title>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div style="margin-bottom:20px;" class="row content-tabs">
                        <div style="text-align:right">
                            <a class="btn btn-primary" href="{{ dashboardUrl('/article/create') }}">添加文章</a>
                        </div>
                        <div style="text-align:center;font-size:1.2em; margin-top:-40px; font-size:14px; font-weight:bold;">
                            所有文章
                        </div>
                        <button onclick="window.history.go(-1);" class="roll-nav roll-left J_tabLeft"><i
                                    class="fa fa-backward"></i></button>
                    </div>

                    <div class="ibox-content">
                        <form action="" id="subForm" onsubmit="return false" method="post">
                            <div class="row">
                                <div class="col-sm-2">
                                    <select class="form-control m-b chosen-select" name="cat_id">
                                        <option value="">所属分类</option>
                                        @foreach($category_list as $v)
                                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select class="form-control m-b chosen-select" name="is_draft">
                                        <option value="">是否草稿</option>
                                        <option value="no">非草稿</option>
                                        <option value="yes">草稿</option>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select class="form-control m-b chosen-select" name="is_excellent">
                                        <option value="">是否优秀</option>
                                        <option value="no">非优秀</option>
                                        <option value="yes">优秀</option>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select class="form-control m-b chosen-select" name="is_hot">
                                        <option value="">是否热门</option>
                                        <option value="no">非热门</option>
                                        <option value="yes">热门</option>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select class="form-control m-b chosen-select" name="only_owner_can_see">
                                        <option value="">是否私人</option>
                                        <option value="no">非私人</option>
                                        <option value="yes">私人</option>
                                    </select>
                                </div>
                                <input type="hidden" name="order" value="">
                                <input type="hidden" name="sort" value="asc">
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="keywords" value=""
                                               placeholder="输入文章标题"/>
                                        <span class="input-group-btn">
                                        <button type="submit"
                                                onclick="ajaxList('subForm','/dashboard/article/ajaxArticles')"
                                                class="btn btn-primary"><i class="fa fa-search"></i> 搜索</button>
                                    </span>
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
<div class="zTreeDemoBackground left" style="display: none;float: left;margin-left:-50px" id="role">
    <input type="hidden" id="nodeid">
    <div class="form-group">
        <div class="col-sm-5 col-sm-offset-2">
            <ul id="treeType" class="ztree"></ul>
        </div>
    </div>
    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
            <input type="button" value="提交" class="btn btn-primary" id="postform"/>
        </div>
    </div>
</div>
@include('dashboard.layouts.partials.footer')
<script type="text/javascript">
    //第一页
    $(document).ready(function () {
        form = 'subForm';//表单id 全局变量
        p = 1;//当前分页
        turl = '/dashboard/article/ajaxArticles?page=' + p;//url
        ajaxList(form, turl);
    });
    // 点击排序
    function ajaxSort(field)
    {
        var sort =$("input[name=sort]").val();
        $("input[name='order']").val(field);
        if(sort=='asc'){
            $("input[name=sort]").val('desc');
        }else{
            $("input[name=sort]").val('asc');
        }
        ajaxList('subForm',turl);
    }
</script>
</body>
