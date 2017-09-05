<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta name="baidu-site-verification" content="SEGRBySjTy"/>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site" content="http://codehaoshi"/>
    <meta name="author" content="Ucer"/>
    @section('meta')
        <meta name="keywords" content="php,code,视频教程,laravel,php框架,文档,教程,中文,学习,社区,开源,php新手,php7,laravel5,php教程"/>
        <meta name="description" content="Code好事是Laravel 和 PHP 开发笔记记录，记录编程中碰到的各种坑"/>
    @show

    <title>@yield('title'){{ config('app.name') }} - 记录代码、问题笔记 - Powered by Ucer</title>
    <link rel="shortcut icon" href="{{ config('app.url') }}favicon.png"/>
    <link rel="stylesheet" href="{{ mix('assets/css/styles.css') }}">
    <!-- Scripts -->
    <script>

        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'uploadImage' => route('upload_image'),
        ]); ?>
    </script>
    @yield('style')
</head>

<body class="show-page articles-show-page pushable  pushable">

@include('layouts/partials/sidebar-menu')

<div class="main container pusher">
    <div id="codehaoshi">
        @include('layouts/partials/navbar')
        @yield('content')
    </div>
</div>
@include('layouts/partials/footer')

<script src="{{ mix('assets/js/front.app.js') }}"></script>
<script src="{{ mix('assets/js/styles.js') }}"></script>


<script type="text/javascript">
    var status = '{{ session()->get('toastrMsg.status') }}';

    var msg = '{{ session()->get('toastrMsg.msg') }}';
    switch (status) {
        case 'success':
            toastr.success(msg);
            break;
        case 'error':
            toastr.error(msg);
            break;
        case 'info':
            toastr.info(msg);
            break;
        case 'warning':
            toastr.warning(msg);
            break;
    }

    $('#flash-overlay-modal').modal();
    Config = {
        'cdnDomain': '{{ getCdnDomain() }}',
    };
</script>


@yield('script')
</body>
</html>
