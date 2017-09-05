@include('dashboard.layouts.partials.header')
<title>文章分类列表</title>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                        <div style="margin-bottom:20px;" class="row content-tabs">
                            <div style="text-align:right">

                                <a class="btn btn-primary" href="{{ dashboardUrl('/articleCategory/create') }}">添加分类</a>
                            </div>
                            <div style="text-align:center;font-size:1.2em; margin-top:-40px; font-size:14px; font-weight:bold;">
                                所有文章分类
                            </div>
                            <button onclick="window.history.go(-1);" class="roll-nav roll-left J_tabLeft"><i
                                        class="fa fa-backward"></i></button>
                        </div>
                    <div class="ibox-content">
                        <div class="table-responsive ">
                            <table class="table table-hover">
                                <thead>
                                <tr class="long-tr">
                                    {{--<th><input type="checkbox" onclick="checkAll(this)">ID</th>--}}
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>图片</th>
                                    <th>别名</th>
                                    <th width="5%">权重</th>
                                    <th>文章数量</th>
                                    <th>描述</th>
                                    <th>添加时间</th>
                                    <th>操作 - <span>数据量：</span>【 {{ count($lists) }} 】</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse( $lists as $v )
                                    <tr class="long-td">
                                        {{--<td><input type="checkbox" name="ids[]" value="{{ $v->id }}">{{ $v->id }}</td>--}}
                                        <td>{{ $v->id }}</td>
                                        <td>{{ $v->name }}</td>
                                        <td>
                                            <a>
                                                <img src="{{ $v->image_url }}" class="fancybox" width="40" height="30"
                                                     href="{{ $v->image_url }}" title="{{ $v->name }}"
                                                     alt=" {{ $v->name }}">
                                            </a>
                                        </td>
                                        <td>{{ $v->slug }}</td>
                                        <td>
                                            <input type="number" value="{{ $v->weight }}" data-id="{{ $v->id }}" data-column="weight" data-table="article_categories" data-msg="排序修改成功" onchange="updateSort(this)"  style="text-align:center;" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" class="form-control">
                                        </td>
                                        <td>{{ $v->article_count }}</td>
                                        <td>{{ $v->description }}</td>
                                        <td>{{ $v->created_at }}</td>
                                        <td>
                                            <a target="_self" title="编辑"
                                               href="{{ dashboardUrl('/articleCategory/'.$v->id.'/edit') }}">
                                                <span class="fa fa-pencil-square-o"> </span>&nbsp;编辑
                                            </a>&nbsp;&nbsp;
                                            <a href="javascript:;" class="btn-warning btn-xs" onclick="delBtn(this)"
                                               data-id="0"
                                               data-name="{{ $v->name }}"
                                               data-url="{{ dashboardUrl('/articleCategory/'.$v->id.'/delete') }}">
                                                <i class="fa fa-trash-o"></i> 删除
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="20"
                                            style="padding-top:10px;padding-bottom:10px;font-size:16px;text-align:center">
                                            暂无数据
                                        </td>
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
