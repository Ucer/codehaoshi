<!DOCTYPE html>
<html>
<head>
    @include('dashboard.layouts.partials.head')
    @yield('style')
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
@include('dashboard.layouts.partials.left')
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('dashboard.layouts.partials.body_head')
       @yield('content')
        <div class="footer">
            <div class="pull-right">&copy; 2017 漂过太平洋后台管理 版权所有
            </div>
        </div>
    </div>
    <!--右侧部分结束-->
    <!--右侧边栏开始-->
@include('dashboard.layouts.partials.right')
    <!--右侧边栏结束-->
</div>
@include('dashboard.layouts.partials.footer')
@yield('script')
<script src="/assets/dashboard/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/assets/dashboard/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/assets/dashboard/js/hplus.min.js?v=4.1.0"></script>
<script src="/assets/dashboard/js/contabs.js"></script>
<script src="/assets/dashboard/js/plugins/pace/pace.min.js"></script>
<script type="text/javascript">
    //退出登录
    $(document).ready(function(){
        $("#logout").click(function(){
            layer.confirm('你确定要退出吗？', {icon: 3}, function(index){
                layer.close(index);
                window.location.href="{:url('Admin/loginOut')}";
            });
        });
    });

    //清除缓存
    $(function(){
        $("#cache").click(function(){
            layer.confirm('你确定要清除缓存吗？', {icon: 3}, function(index){
                layer.close(index);
                window.location.href="";
            });
        });
    });
</script>
</body>

</html>
