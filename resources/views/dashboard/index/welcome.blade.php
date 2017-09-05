@include('dashboard.layouts.partials.head')
<div class="wrapper wrapper-content">
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <div>尊敬的【{$admin_info.role_name}】{$admin_info.user_name}<span id="weather"></span></div>
    </div>

    <!-- 上方tab -->
    <div class="row">
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label pull-right">日</span>
                    <span class="label pull-right">周</span>
                    <span class="label label-success pull-right">月</span>
                    <h5>收入</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">40 886,200</h1>
                    <small>总收入</small>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label pull-right">日</span>
                    <span class="label pull-right">周</span>
                    <span class="label label-success pull-right">月</span>
                    <h5>订单</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">275,800</h1>
                    <small>总订单</small>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label pull-right">日</span>
                    <span class="label pull-right">周</span>
                    <span class="label label-success pull-right">月</span>
                    <h5>注册</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">106,120</h1>
                    <small>新增</small>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <a href="#question">
                        <i class="fa fa-question" style="color:red;margin-left:10px" data-container="body" data-toggle="popover" data-placement="bottom"
                           data-content="日活跃用户 = 当日登录游戏的用户 - 当日新增用户数(去重)@@@@@@@@月活跃用户 = 最近30天登录游戏的用户 - 最近30天新增用户(去重)"></i>
                    </a>
                    <span class="label pull-right">日</span>
                    <span class="label pull-right">周</span>
                    <span class="label label-success pull-right">月</span>
                    <h5>活跃用户</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">80,600</h1>
                    <small>7月</small>
                </div>
            </div>
        </div>
    </div>

    <!-- 中间折线 -->
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-cogs"></i> 系统信息
                    </div>
                    <div class="panel-body">
                        <p><i class="fa fa-sitemap"></i> 框架版本：ThinkPHP{$sys_info.think_v}
                        </p>
                        <p><i class="fa fa-windows"></i> 服务环境：{$sys_info.web_server}
                        </p>
                        <p><i class="fa fa-futbol-o"></i> 服务器操作系统：{$sys_info.os}
                        </p>
                        <p><i class="fa fa-tag"></i> 服务器域名/IP：{$sys_info.domain} [ {$sys_info.ip} ]
                        </p>
                        <p><i class="fa fa-credit-card"></i> PHP 版本：{$sys_info.phpv}
                        </p>
                        <p><i class="fa fa-tint"></i> Mysql版本：{$sys_info.mysql_version}
                        </p>
                        <p><i class="fa fa-sort"></i> GD版本：{$sys_info.gdinfo}
                        </p>
                        <p><i class="fa fa-warning"></i> 上传附件限制：{$sys_info.fileupload}
                        </p>
                        <p><i class="fa fa-unlock"></i> 最大占用内存：{$sys_info.memory_limit}
                        </p>
                        <p><i class="fa fa-times-circle"></i> 最大执行时间：{$sys_info.max_ex_time}
                        </p>
                        <p><i class="fa fa-spinner"></i> url支持：{$sys_info.curl}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-user"></i> 开发者信息
                    </div>
                    <div class="panel-body">
                        <p><i class="fa fa-cubes"></i> 程序版本：<a href="">{$sys_info.version}</a>
                        </p>
                        <p><i class="fa fa-user"></i> 开发者：<a href="">漂过太平洋</a>
                        </p>
                        <p><i class="fa fa-send-o"></i> 博客：<a href="http://zhjaa.online" target="_blank">http://zhjaa.online</a>
                        </p>
                        <p><i class="fa fa-qq"></i> QQ：<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=185429135&amp;site=qq&amp;menu=yes" target="_blank">185429135</a>
                        </p>
                        <p><i class="fa fa-weixin"></i> 微信：<a href="javascript:;">jj-185429135</a>
                        </p>
                        <p><i class="fa fa-credit-card"></i> 支付宝：<a href="javascript:;" class="支付宝信息">185429135@qq.com / **杰</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{include file="public/footer" /}
<script src="/static/admin/js/jquery.leoweather.min.js"></script>
<script type="text/javascript">
    $('#weather').leoweather({city:'昆明',format:'，{时段}好！<span id="colock">现在时间是：<strong>{年}年{月}月{日}日 星期{周} {时}:{分}:{秒}</strong>，</span> <b>{城市}天气</b> {天气} 风级{风级} 气温{夜间气温}℃ ~ {白天气温}℃'});
</script>

</body>
</html>