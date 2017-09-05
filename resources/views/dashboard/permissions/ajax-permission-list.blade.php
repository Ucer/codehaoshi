<div class="table-responsive ">
    <table class="table table-bordered table-hover">
        <thead>
        <tr class="long-tr">
            <th><input type="checkbox" onclick="checkAll(this)">ID</th>
            <th>名称</th>
            <th>显示名称</th>
            <th>描述</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @forelse( $lists as $v )
            <tr class="long-td">
                <td><input type="checkbox" name="ids[]" value="{{ $v->id }}">{{ $v->id }}</td>
                <td>{{ $v->name }}</td>
                <td>{{ $v->display_name }}</td>
                <td>{{ $v->description }}</td>
                <td>{{ $v->created_at }}</td>
                <td>
                    <a href="{{ dashboardUrl('/permission/'.$v->id.'/edit') }}" class="btn btn-primary btn-xs">
                        <i class="fa fa-pencil-square-o"></i> 编辑
                    </a>&nbsp;&nbsp;
                    <a href="javascript:;" class="btn btn-danger btn-xs" onclick="delBtn(this)" data-id="0"
                       data-name="{{ $v->name }}" data-url="{{ dashboardUrl('/permission/'.$v->id.'/delete') }}">
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
    <div class="pull-right">
        {!! preg_replace("(<a[^>]*page[=|/](\d+).+?>(.+?)<\/a>)","<a data-p=$1 href='javascript:void($1);'>$2</a>",$lists->links()) !!}
    </div>
</div>
<script type="text/javascript">
    //分页
    $('.pagination a').click(function () {
        form = 'subForm';//表单id 全局变量
        p = $(this).data('p');//当前分页
        turl = "/dashboard/permission/ajaxPermissions" + "?page=" + p;//url
        ajaxList(form, turl);
    });

</script>