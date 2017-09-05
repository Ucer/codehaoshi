@include('dashboard.layouts.partials.header')
<title>标签列表</title>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>标签列表</h5>
                    <div class="ibox-content">
                        <form action="" id="subForm" onsubmit="return false" method="post">
                            <div class="row">
                                <div class="col-sm-2 pull-right">
                                    <div class="btn-group pull-right" role="group" style="clear: both">
                                        <a href="{{ dashboardUrl('/tag/create') }}"
                                           class="btn btn-outline btn-default "><i class="fa fa-plus"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="hr-line-dashed"></div>
                        <div class="table-responsive ">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr class="long-tr">
                                    <th><input type="checkbox" onclick="checkAll(this)">ID</th>
                                    <th>名称(tag)</th>
                                    <th>别名</th>
                                    <th>描述</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse( $lists as $v )
                                    <tr class="long-td">
                                        <td><input type="checkbox" name="ids[]" value="{{ $v->id }}">{{ $v->id }}</td>
                                        <td>{{ $v->tag }}</td>
                                        <td>{{ $v->slug }}</td>
                                        <td>{{ $v->description }}</td>
                                        <td>{{ $v->created_at }}</td>
                                        <td>
                                            <a href="{{ dashboardUrl('/tag/'.$v->id.'/edit') }}" class="btn btn-primary btn-xs">
                                                <i class="fa fa-pencil-square-o"></i> 编辑
                                            </a>&nbsp;&nbsp;
                                            <a href="javascript:;" class="btn btn-danger btn-xs" onclick="delBtn(this)" data-id="0"
                                               data-name="{{ $v->tag }}" data-url="{{ dashboardUrl('/tag/'.$v->id.'/delete') }}">
                                                <i class="fa fa-trash-o"></i> 删除
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="20" style="padding-top:10px;padding-bottom:10px;font-size:16px;text-align:center">暂无数据</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('dashboard.layouts.partials.footer')
</body>
