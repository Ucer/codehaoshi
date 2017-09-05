@extends('dashboard.layouts.base')
@section('content')
<!-- 加载动画 -->
<div class="row J_mainContent" id="content-main" >
    <iframe class="J_iframe" name="iframe0" width="100%" height="100% "
            src="{{ dashboardUrl('/welcome') }}" frameborder="0"
            data-id="index_v1.html" seamless>
    </iframe>
</div>
@endsection

