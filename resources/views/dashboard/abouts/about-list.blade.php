@include('dashboard.layouts.partials.header')
<title>关于我们列表</title>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                        <div style="margin-bottom:20px;" class="row content-tabs">
                            <div style="text-align:right">

                                <a class="btn btn-primary" href="{{ dashboardUrl('/abouts/create') }}">添加</a>
                            </div>
                            <div style="text-align:center;font-size:1.2em; margin-top:-40px; font-size:14px; font-weight:bold;">
                                所有关于我们
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
                                    <th>标题</th>
                                    <th>是否启用</th>
                                    <th>添加时间</th>
                                    <th>操作 - <span>数据量：</span>【 {{ count($lists) }} 】</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse( $lists as $v )
                                    <tr class="long-td">
                                        {{--<td><input type="checkbox" name="ids[]" value="{{ $v->id }}">{{ $v->id }}</td>--}}
                                        <td>{{ $v->id }}</td>
                                        <td>{{ $v->title }}</td>
                                        <td>
                                            @if( $v->is_enabled == 'no')
                                                <i class="fa fa-close text-navy change-status hover-point" data-value="yes" data-cv="no"
                                                   data-id="{{ $v->id }}" data-column="is_enabled" data-table="abouts" data-msg="启用" data-todo="1"
                                                   data-cur="非启用" onclick="changeStatus(this)"> 非启用</i>
                                            @else
                                                <i class="fa fa-check text-navy change-status hover-point" data-value="no" data-cv="yes"
                                                   data-id="{{ $v->id }}" data-column="is_enabled" data-table="abouts" data-msg="非启用"
                                                   data-todo="0" data-cur="启用" onclick="changeStatus(this)">启用</i>
                                            @endif
                                        </td>
                                        <td>{{ $v->created_at }}</td>
                                        <td>
                                            <a target="_self" title="编辑"
                                               href="{{ dashboardUrl('/abouts/'.$v->id.'/edit') }}">
                                                <span class="fa fa-pencil-square-o"> </span>&nbsp;编辑
                                            </a>&nbsp;&nbsp;
                                            <a href="{{ route('about') }}" target="_blank" title="预览"><span
                                                        class="fa fa-eye"></span>&nbsp;预览</a>&nbsp;&nbsp;
                                            <a href="javascript:;" class="btn-warning btn-xs" onclick="delBtn(this)"
                                               data-id="0"
                                               data-name="{{ $v->name }}"
                                               data-url="{{ dashboardUrl('/abouts/'.$v->id.'/delete') }}">
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
