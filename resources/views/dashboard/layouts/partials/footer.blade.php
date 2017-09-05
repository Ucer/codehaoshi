<script src="/assets/dashboard/js/jquery.min.js?v=2.1.4"></script>
<script src="/assets/dashboard/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/assets/dashboard/js/content.min.js?v=1.0.0"></script>
<script src="/assets/dashboard/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/assets/dashboard/js/plugins/iCheck/icheck.min.js"></script>
<script src="/assets/dashboard/js/plugins/layer/laydate/laydate.js"></script>
<script src="/assets/dashboard/js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="/assets/dashboard/js/plugins/switchery/switchery.js"></script><!--IOS开关样式-->
<script src="/assets/dashboard/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/assets/dashboard/js/jquery.form.js"></script>
<script src="/assets/dashboard/js/layer/layer.js"></script>
<script src="/assets/dashboard/js/laypage/laypage.js"></script>
<script src="/assets/dashboard/js/laytpl/laytpl.js"></script>
<script src="/assets/dashboard/js/global.js"></script>
<script src="/assets/dashboard/js/jquery.easyui.min.js"></script>
<!--引入CSS-->
<link rel="stylesheet" type="text/css" href="/assets/dashboard/webupload/webuploader.css">
<script type="text/javascript" src="/assets/dashboard/webupload/webuploader.min.js"></script>

<link rel="stylesheet" href="/assets/dashboard/js/plugins/zTree/zTreeStyle.css" type="text/css">
<script type="text/javascript" src="/assets/dashboard/js/plugins/zTree/jquery.ztree.core-3.5.js"></script>
<script type="text/javascript" src="/assets/dashboard/js/plugins/zTree/jquery.ztree.excheck-3.5.js"></script>
<script type="text/javascript" src="/assets/dashboard/js/plugins/zTree/jquery.ztree.exedit-3.5.js"></script>

<script src="/assets/dashboard/js/plugins/fancybox/jquery.fancybox.js"></script>
<link rel="stylesheet" href="/assets/dashboard/js/plugins/fancybox/jquery.fancybox.css">


<script src="/assets/dashboard/js/plugins/simplemde/latest/simplemde.min.js"></script>
<link rel="stylesheet" href="/assets/dashboard/js/plugins/simplemde/latest/simplemde.min.css">
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        $(".fancybox").fancybox({openEffect: "none", closeEffect: "none"})
        $(".i-checks").iCheck({checkboxClass: "icheckbox_square-green", radioClass: "iradio_square-green",})
    });
    var config = {
        '.chosen-select': {},
    };
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
</script>