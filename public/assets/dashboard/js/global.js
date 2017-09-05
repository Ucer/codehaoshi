/**
 * Created by PhpKiller.
 * User: Across The Pacific
 * Date: 2016/12/29
 * Time: 15:33
 * 鸿杰 张
 */
//公共js文件

/**
 * ajax提交表单检测
 *@param var status 检测条件
 *@param var value 检测字段值
 *@param var value 提示消息
 * */
var isEmpty = function (status, value, msg) {
    if (status === $.trim(value)) {//trim 去除空格
        layer.msg(msg, {icon: 5, time: 1000, shade: [0.8, '#393D49']}, function (index) {
            layer.close(index);
        });
        return false;
    }
};

/**
 * jquery 正则检测
 *@param var reg 正则匹配条件
 *@param var value 检测字段值
 *@param var value 提示消息
 * */
var prexRule = function (reg, value, msg) {
    if (!reg.test(value)) {
        layer.msg(msg, {icon: 5, time: 1000, shade: [0.8, '#393D49']}, function (index) {
            layer.close(index);
        });
        return false;
    }
};
/**
 * 修改指定表的某一字段值
 *@param var table 表名
 *@param var column 字段名
 *@param var value 字段值
 *@param var msg 提示消息
 * */
function updateSort(obj) {
    var id = $(obj).attr("data-id");
    var table = $(obj).attr("data-table");
    var column = $(obj).attr("data-column");
    var value = $(obj).val();
    var msg = $(obj).attr('data-msg');
    $.ajax({
        url:"/dashboard/commonStatus?id="+id+'&table='+table+'&column='+column+'&value='+value,
        success: function (data) {
            if (data.status == 1) {
                layer.msg(msg, {icon: 1, time: 1000, shade: [0.8, '#393D49']}, function (index) {
                    layer.close(index);
                });
            } else {
                layer.msg(data.msg, {icon: 5, time: 1000, shade: [0.8, '#393D49']}, function (index) {
                    window.location.reload();
                });
            }

        }
    });
};
/**
 * 点击刷新列表页
 * */
var refresh = function () {
    layer.msg('更新成功', {icon: 1, time: 1000, shade: [0.8, '#393D49']}, function () {
        location.href = location.href;
    });
}
/**
 * jquery全选
 *@param var obj this对象
 * */
var checkAll = function (obj) {
    $('input[name *= \'ids\']').prop('checked', obj.checked)
};
/**
 * jquery获取选中的id
 *@param var obj this对象
 *@param var id 要删除的主键
 *@param var attr('data-url') 要调用的url
 * */
var getIds = function (obj) {
    var a = [];
    $("input[name *= ids]").each(function (i, o) {
        if ($(o).is(":checked")) {
            a.push($(o).val());
        }
    });
    var url = $(obj).attr('data-url')
    delBtn('', a, url)
}
/**
 * jquery删除数据
 *@param var obj this对象
 *@param var a 批量删除的主键
 *@param var urla 要调用的url
 *@param var attr('data-id') 要删除的id(单条)
 *@param var attr('data-name') 要删除name(单条)
 *@param var attr('data-url') 要调用的url(单条)
 * */
var delBtn = function (obj, a, urla) {
    if (a) {
        var id = a
        var name = '所选择的'
        var url = urla
    } else {
        var id = $(obj).attr('data-id')
        var name = $(obj).attr('data-name')
        var url = $(obj).attr('data-url')
    }

    if (isEmpty('', id, '请选择要删除的数据') == false) {
        return false;
    }
    layer.confirm('确定要删除' + '<span style="color:#ff0000">' + name + '</span>' + '吗?', {icon: 3}, function () {
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                ids: id
            },
            dataType: "json",
            beforeSend: function () {
                layer.closeAll();
            },
            success: function (data) {
                layer.closeAll();
                if (data.status == 1) {
                    layer.msg(data.msg, {icon: 1, time: 1000, shade: [0.8, '#393D49']}, function () {
                        location.href = location.href;
                    });
                } else {
                    layer.msg(data.msg, {icon: 5, time: 1000, shade: [0.8, '#393D49']}, function (index) {
                        layer.close(index);
                    });
                }
            },
        });
    });
};
/*数据库优化|修复
 *@param var obj this对象
 *@param var msg 没有选中时提示消息
 *@param var tab tab是单张表，没有值则为批量操作
 *@param var url 要调用的url
 * */
var jqOptimize = function (obj, msg, tab) {
    if (tab) {
        var a = tab;
    } else {
        var a = [];
        $("input[name *= ids]").each(function (i, o) {
            if ($(o).is(":checked")) {
                a.push($(o).val());
            }
        });
    }
    if (a.length == 0) {
        layer.msg('请选择要' + msg + '的数据表', {icon: 5, time: 2000}, function (index) {
            layer.close(index);
            return;
        });
    } else {
        $(obj).addClass('disabled');
        $(obj).html(msg + '中...');
        $.ajax({
            type: 'post',
            url: $(obj).attr('data-url'),
            dataType: 'json',
            data: {tables: a},
            success: function (data) {
                if (data.code == 1) {
                    layer.msg(data.msg, {icon: 1, time: 2000, shade: [0.8, '#393D49']}, function (index) {
                        location.href = location.href;
                    });
                } else {
                    layer.msg(data.msg, {icon: 5, time: 2000, shade: [0.8, '#393D49']}, function (index) {
                        location.href = location.href;
                    });
                }
            },
            error: function () {

                layer.msg(data.msg, {icon: 5, time: 2000, shade: [0.8, '#393D49']}, function (index) {
                    return false;
                });
            }
        });
    }
};
/*ajax分页
 *@param var form 表单id
 *@param var url 要调用的url
 * */
var ajaxList = function (form, url) {
    $.ajax({
        type: 'POST',
        url: url,
        data: $('#' + form).serialize(),//导航搜索
        success: function (data) {
            $('#ajax_return').html('');
            $('#ajax_return').append(data);
            $(".spiner-example").css('display', 'none');
        },
    });
};
/*jquery文件上传[注意:需要引入jquery.easyui.min.js]
 *@param url 文件上传控制器url
 *@param path 要上传到哪个目录下
 *@param input_name input框的name
 * */
$(document).ready(function () {//打开页面执行
    html = "<form id='upload' style='display: none' method='post' enctype='multipart/form-data'>";
    html += '<input up="file" type="file" name="myfile" >';
    html += "{{ csrf_field() }}";
    html += '</form>';
    $('body').append(html);
});
$(document).delegate('[uploader]', 'click', function () {//找到属性，点击时执行
    var s = $(this);
    var url = s.attr('data-url');
    var path = s.attr('data-path');
    var input_name = s.attr('uploader');
    var f = $("[up=file]");

    f.click();

    f.change(function () {
        if (!input_name) {
            return false;
        }
        $("#upload").form('submit', {
            type: 'post',
            url: url,
            onSubmit: function (param) {
                param.path = path;
            },
            success: function (res) {
                var obj = eval('(' + res + ')');
                if (obj.status == 1) {
                    $("#" + input_name).val(obj.msg);
                    $("#" + input_name + "_img").attr('src', obj.msg);
                } else {
                    layer.msg(obj.msg, {icon: 5, time: 1000, shade: [0.8, '#393D49']}, function (index) {
                        layer.close(index);
                    });
                }
                input_name = false;
            },
        });
    });
});
/**
 * 时间插件
 *@param $pagesize 每一页的总数
 *@param min 最小时间
 *@param tody 是否显示今天
 */
$(document).delegate('[time_plugin]', 'click', function () {//找到属性，点击时执行
    var s = $(this);
    var min = s.attr('data-min');
    var namea = s.attr('data-min');
    //var now = show();
    var now = '2017-03-01';
    var tody = true;
    if (min != 'input') {
        now = $("input[name ='" + namea + "']").val()
        tody = false;
    }
    laydate({
        istime: true, format: 'YYYY-MM-DD hh:mm:ss',
        istoday: true, //是否显示今天
        festival: true, //是否显示节日
        min: now, //最小日期
        issure: true, //是否显示确认
        max: '2099-12-31 23:59:59', //最大日期
        fixed: false, //是否固定在可视区域
        zIndex: 99999999, //css z-index
        choose: function (dates) { //选择好日期的回调

        }
    });
});
/**
 * 获取当前日期
 */
function show() {
    var d = new Date();//定义一个date对象d
    var month = d.getMonth() + 1;//从d中获取月份
    var day = d.getDate();//日
    var time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();//组装时间参数
    var timea = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day + " " + time;
    return timea;//2017-03-17 15:42:15
}

/**获取活动剩余天数 小时 分钟
 //倒计时js代码精确到时分秒，使用方法：注意 var EndTime= new Date('2013/05/1 10:00:00');
 //截止时间 这一句，特别是 '2013/05/1 10:00:00' 这个js日期格式一定要注意，否则在IE6、7下工作计算不正确哦。
 //js代码如下：
 **/
function GetRTime(end_time) {
    console.log(end_time);
    // var EndTime= new Date('2016/05/1 10:00:00'); //截止时间 前端路上 http://www.51xuediannao.com/qd63/
    var EndTime = new Date(end_time); //截止时间 前端路上 http://www.51xuediannao.com/qd63/
    var NowTime = new Date();
    var t = EndTime.getTime() - NowTime.getTime();

    var d = Math.floor(t / 1000 / 60 / 60 / 24);
    var h = Math.floor(t / 1000 / 60 / 60 % 24);
    var m = Math.floor(t / 1000 / 60 % 60);
    var s = Math.floor(t / 1000 % 60);
    if (s >= 0) {
        if (d == 0) {
            return h + '小时' + m + '分' + s + '秒';
        }
        if (h == 0) {
            return m + '分' + s + '秒';
        }
        return d + '天' + h + '小时' + m + '分' + s + '秒';
    }
}

/**
 * 异步显示隐藏
 *@param id  表id
 *@param table  表名
 *@param column 字段名
 *@param value 要改成什么值
 *@param  todo 为1表示要开启check，0表示要关闭close
 *@param  cv 当前的值
 *@param  cur 当前的msg
 *@param  msg 要改成什么值
 */
var changeStatus = function (obj) {
    var todo = $(obj).attr('data-todo');
    var cv = $(obj).attr('data-cv');
    var cur = $(obj).attr('data-cur');
    var msg = $(obj).attr('data-msg');

    var value = $(obj).attr('data-value');
    var id = $(obj).attr('data-id');
    var table = $(obj).attr('data-table');
    var column = $(obj).attr('data-column');
    $.ajax({
        url:"/dashboard/commonStatus?id="+id+'&table='+table+'&column='+column+'&value='+value,
        success: function (data) {
            if(data.status == 0) {
                layer.msg(data.msg, {icon: 5, time: 1000, shade: [0.8, '#393D49']}, function (index) {
                    layer.close(index);
                });
            } else {
                layer.msg(data.msg, {icon: 1, time: 1000, shade: [0.8, '#393D49']}, function (index) {
                    layer.close(index);
                });
            }
            if (todo > 0) {
                $(obj).removeClass('fa-close').addClass('fa-check');
                $(obj).attr('data-todo', 0);
            } else {
                $(obj).removeClass('fa-check').addClass('fa-close');
                $(obj).attr('data-todo', 1);
            }
            $(obj).html(msg);

            $(obj).attr('data-value', cv);
            $(obj).attr('data-cv', value);
            $(obj).attr('data-msg', cur);
            $(obj).attr('data-cur', msg);
        }
    });
};
/**
 * 获取多级联动的商品分类
 *@param id 当前选中的id
 *@param next 要填充的id
 *@param select_id 当前选中的id
 */
var getNextCate = function (id, next, select_id) {
    var url = "/admin/Goods/ajaxGetNext/pid/" + id;
    $.ajax({
        type: "GET",
        url: url,
        error: function (request) {
            layer.msg('服务器繁忙, 请联系管理员!', {icon: 5, time: 1000, shade: [0.8, '#393D49']}, function (index) {
                layer.close(index);
            });
            return;
        },
        success: function (v) {
            v = "<option value='0'>请选择商品分类</option>" + v;
            $('#' + next).empty().html(v);
            (select_id > 0) && $('#' + next).val(select_id);//默认选中
        }
    });
}
/**
 * 序列化表单ajax异步提交
 *@param url 控制器url
 *@param formId 表单id
 */
function ajaxFormBtn(url, formId, layerClose) {
    $.ajax({
        type: 'post',
        url: url,
        data: $("#" + formId).serialize(),
        success: function (data) {
            if (data.status == 1) {
                layer.msg(data.msg, {icon: 1, time: 1000, shade: [0.8, '#393D49']}, function () {
                    if (layerClose) {
                        parent.layer.closeAll();
                    }
                    window.location = data.url;
                });
            } else {
                layer.msg(data.msg, {icon: 5, time: 1000, shade: [0.8, '#393D49']});
                return false;
            }
        },
        error: function (data) {

            if (data.status == 422) {
                var responseJSON = data.responseJSON;
                let content = '';
                for (var k in responseJSON) {
                    let value = responseJSON[k];

                    content += '<span style="color: #e74c3c">' + value[0] + '</span><br>';
                }
                layer.msg(content, {icon: 5, time: 2000, shade: [0.8, '#393D49']});
            } else if (data.status == 403) {
                layer.msg('你没有权限这么做', {icon: 5, time: 2000, shade: [0.8, '#393D49']});
            } else {
                layer.msg('网络错误，请稍后复试', {icon: 5, time: 2000, shade: [0.8, '#393D49']});
            }
            return false;
        }
    });
}
/**
 * 读取 cookie
 *@param c_name cookie名字
 */
function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=")
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1
            c_end = document.cookie.indexOf(";", c_start)
            if (c_end == -1) c_end = document.cookie.length
            return unescape(document.cookie.substring(c_start, c_end))
        }
    }
    return 0;
}
/**
 * 设置 cookie
 *@param name cookie名字
 *@param value cookie值
 *@param time cookie有效期
 */
function setCookies(name, value, time) {
    var cookieString = name + "=" + escape(value) + ";";
    if (time != 0) {
        var Times = new Date();
        Times.setTime(Times.getTime() + time);
        cookieString += "expires=" + Times.toGMTString() + ";"
    }
    document.cookie = cookieString;
}
/**
 * 点击收藏商品
 *@param goods_id 商品id
 */
function collectGoods(goods_id) {
    $.ajax({
        type: "POST",
        url: "/mobile/Goods/collectGoods",
        data: {goods_id: goods_id},
        dataType: 'json',
        success: function (data) {
            layer.open({content: data.msg, time: 1});
            return false;
        },
        error: function () {
            layer.open({content: '网络错误,请稍后再试', time: 1});
            return false;
        }
    });
}
/**
 * 根据省份id获取省份下面的城市列表
 */
function getCity(obj) {
    var pid = $(obj).val();//当前选中的省id
    $("#district").empty().html('<option value="">请选择地区</option>');
    $('#twon').empty().css('display', 'none');
    $.ajax({
        type: "POST",
        url: "/home/Api/getRegion/level/2/pid/" + pid,
        success: function (data) {
            var res = '<option value="">请选择城市</option>' + data;
            $("#city").empty().html(res);
        },
        error: function () {
            layer.open({content: '网络错误,请稍后再试', time: 1});
            return false;
        }
    });
};
/**
 * 根据城市id获取下面的地区列表
 */
function getArea(obj) {
    var pid = $(obj).val();//当前选中的省id
    $('#twon').empty().css('display', 'none');
    $.ajax({
        type: "POST",
        url: "/home/Api/getRegion/level/3/pid/" + pid,
        success: function (data) {
            var res = '<option value="">请选择地区</option>' + data;
            $("#district").empty().html(res);
        },
        error: function () {
            layer.open({content: '网络错误,请稍后再试', time: 1});
            return false;
        }
    });
};
/**
 * 根据地区id获取下面的乡镇列表
 */
function getTown(obj) {
    var pid = $(obj).val();//当前选中的省id

    $.ajax({
        type: "POST",
        url: "/home/Api/getTwon/pid/" + pid,
        success: function (data) {
            if (parseInt(data) == 0) {
                $('#twon').empty().css('display', 'none');
            } else {
                $('#twon').css('display', 'block');
                $('#twon').empty().html(data);
            }
        },
        error: function () {
            layer.open({content: '网络错误,请稍后再试', time: 1});
            return false;
        }
    });
};
// // 保存按钮 enter
// document.onkeydown = function (event) {
//     var e = event || window.event || arguments.callee.caller.arguments[0];
//     if (e && e.keyCode == 13) { // enter 键
//         $('.saveBtn').click();
//     }
// };
