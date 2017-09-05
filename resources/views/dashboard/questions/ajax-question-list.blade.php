<div class="table-responsive ">
    <table class="table table-hover">
        <thead>
        <tr class="long-tr">
            <th><input type="checkbox" onclick="checkAll(this)">ID </th>
            <th><i class="fa fa-file-text" style="margin-right: 3px"></i>问题标题</th>
            <th>别名</th>
            <th>描述</th>
            <th width="5%"> <a href="javascript:ajaxSort('vote_count');">点赞数
                    @if( $order == 'vote_count')
                        <span style="color: #000000"><i class="fa
                        @if( $sort == 'asc') fa-arrow-up
                            @else  fa-arrow-down
                        @endif "> </i></span>
                    @endif
                </a> </th>
            <th width="5%"> <a href="javascript:ajaxSort('view_count');">查看數
                    @if( $order == 'view_count')
                        <span style="color: #000000"><i class="fa
                        @if( $sort == 'asc') fa-arrow-up
                            @else  fa-arrow-down
                        @endif "> </i></span>
                    @endif
                </a> </th>
            <th width="5%"> <a href="javascript:ajaxSort('reply_count');">评论数
                    @if( $order == 'reply_count')
                        <span style="color: #000000"><i class="fa
                        @if( $sort == 'asc') fa-arrow-up
                            @else  fa-arrow-down
                        @endif "> </i></span>
                    @endif
                </a> </th>
            <th width="5%"> <a href="javascript:ajaxSort('weight');">权重
                    @if( $order == 'weight')
                        <span style="color: #000000"><i class="fa
                        @if( $sort == 'asc') fa-arrow-up
                            @else  fa-arrow-down
                        @endif "> </i></span>
                    @endif
                </a> </th>
            <th>优秀</th>
            <th>热门</th>
            <th>私人</th>
            <th>草稿</th>
            <th>发布时间</th>
            <th>操作 - <span>数据量：</span>【 {{ $lists->total() }} 】</th>
        </tr>
        </thead>
        <tbody>
        @forelse( $lists as $v )
            <tr class="long-td">
                <td><input type="checkbox" name="ids[]" value="{{ $v->id }}">{{ $v->id }}</td>
                <td>{{ str_limit($v->title, 20) }}</td>
                <td> {{ str_limit($v->slug, 15) }}</td>
                <td>{{ str_limit($v->description, 20) }}</td>
                <td>{{ $v->vote_count }}</td>
                <td> {{ $v->view_count }}</td>
                <td> {{ $v->reply_count }}</td>
                <td>
                    <input type="number" value="{{ $v->weight }}" data-id="{{ $v->id }}" data-column="weight" data-table="questions" data-msg="排序修改成功" onchange="updateSort(this)"  style="text-align:center;" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" class="form-control">
                </td>
                <td>
                    @if( $v->is_excellent == 'no')
                        <i class="fa fa-close text-navy change-status hover-point" data-value="yes" data-cv="no"
                           data-id="{{ $v->id }}" data-column="is_excellent" data-table="questions" data-msg="优秀" data-todo="1"
                           data-cur="非优秀" onclick="changeStatus(this)"> 非优秀</i>
                    @else
                        <i class="fa fa-check text-navy change-status hover-point" data-value="no" data-cv="yes"
                           data-id="{{ $v->id }}" data-column="is_excellent" data-table="questions" data-msg="非优秀"
                           data-todo="0" data-cur="优秀" onclick="changeStatus(this)"> 优秀</i>
                    @endif
                </td>
                <td>
                    @if( $v->is_hot == 'no')
                        <i class="fa fa-close text-navy change-status hover-point" data-value="yes" data-cv="no"
                           data-id="{{ $v->id }}" data-column="is_hot" data-table="questions" data-msg="热门" data-todo="1"
                           data-cur="非热门" onclick="changeStatus(this)"> 非热门</i>
                    @else
                        <i class="fa fa-check text-navy change-status hover-point" data-value="no" data-cv="yes"
                           data-id="{{ $v->id }}" data-column="is_hot" data-table="questions" data-msg="非热门"
                           data-todo="0" data-cur="热门" onclick="changeStatus(this)"> 热门</i>
                    @endif
                </td>
                <td>
                    @if( $v->only_owner_can_see == 'no')
                        <i class="fa fa-close text-navy change-status hover-point" data-value="yes" data-cv="no"
                           data-id="{{ $v->id }}" data-column="only_owner_can_see" data-table="questions" data-msg="私有" data-todo="1"
                           data-cur="非私有" onclick="changeStatus(this)"> 非私有</i>
                    @else
                        <i class="fa fa-check text-navy change-status hover-point" data-value="no" data-cv="yes"
                           data-id="{{ $v->id }}" data-column="only_owner_can_see" data-table="questions" data-msg="非私有"
                           data-todo="0" data-cur="私有" onclick="changeStatus(this)"> 私有</i>
                    @endif
                </td>
                <td>
                    @if( $v->is_draft == 'no')
                        <i class="fa fa-close text-navy change-status hover-point" data-value="yes" data-cv="no"
                           data-id="{{ $v->id }}" data-column="is_draft" data-table="questions" data-msg="草稿" data-todo="1"
                           data-cur="非草稿" onclick="changeStatus(this)"> 非草稿</i>
                    @else
                        <i class="fa fa-check text-navy change-status hover-point" data-value="no" data-cv="yes"
                           data-id="{{ $v->id }}" data-column="is_draft" data-table="questions" data-msg="非草稿"
                           data-todo="0" data-cur="草稿" onclick="changeStatus(this)"> 草稿</i>
                    @endif

                </td>
                <td>{{ $v->published_at }}</td>
                <td>
                    <a href="{{ dashboardUrl('/question/'.$v->id.'/edit') }}">
                        <i class="fa fa-pencil-square-o"></i> 编辑
                    </a>&nbsp;&nbsp;
                    <a href="{{ route('question.show', ['slug' => $v->slug]) }}" target="_blank" title="预览"><span
                                class="fa fa-eye"></span>&nbsp;预览</a>&nbsp;&nbsp;
                    <a href="javascript:;" class="btn btn-danger btn-xs" onclick="delBtn(this)" data-id="0"
                       data-name="{{ $v->title }}" data-url="{{ dashboardUrl('/question/'.$v->id.'/delete') }}">
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
        turl = "/dashboard/question/ajaxQuestions" + "?page=" + p;//url
        ajaxList(form, turl);
    });
</script>