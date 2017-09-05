<template>
    <div class="ui list" style="margin-top: 6px;margin-left: 4px;">
        <div class="item">
            <img class="ui centered circular tiny image" :src="src"/>
            <div class="content user-info">
                <a class="header title">{{ user_name }}</a>
                <div class="description"> 第 {{ id }}&nbsp;&nbsp;位会员 </div>
                <div class="description"> 注册于&nbsp;<span
                        class="labels-time timeago">{{ time }}</span></div>
            </div>
            <my-upload field="myfile"
                       @crop-success="cropSuccess"
                       @crop-upload-success="cropUploadSuccess"
                       @crop-upload-fail="cropUploadFail"
                       v-model="show"
                       :width="50"
                       :height="50"
                       url="/file/upload"
                       :params="params"
                       :headers="headers"
                       img-format="png"></my-upload>
        </div>
        <div class="description labels-time ui teal mini basic button" @click="toggleShow" v-if="this.user_name == this.now_user || this.is_supperadmin">修改头像</div>
        <div class="description labels-time"><i class="bookmark icon intro"></i> {{ introduction }} </div>
    </div>
</template>

<script>

    export default {
        props: ['src', 'id', 'user_name', 'time', 'introduction', 'now_user', 'is_supperadmin'],
        data() {
            return {
                show: false,
                params: {
                    _token: Laravel.csrfToken,
                    path: 'avatar',
                    id: this.id
                },
                headers: {
                    smail: '*_~'
                },
                imgDataUrl: this.avata
            }
        },
        methods: {
            toggleShow() {
                this.show = !this.show;
            },
            /**
             * crop success
             *
             * [param] imgDataUrl
             * [param] field
             */
            cropSuccess(imgDataUrl, field){
                this.src = imgDataUrl;
            },
            /**
             * upload success
             *
             * [param] jsonData  server api return data, already json encode
             * [param] field
             */
            cropUploadSuccess(response, field){
                this.src = response.msg;
                this.toggleShow();
                window.location = '/users/' + this.user_name;
                toastr.info('头像修改成功')
            },
            /**
             * upload fail
             *
             * [param] status    server api return error status, like 500
             * [param] field
             */
            cropUploadFail(status, field){
//                console.log('-------- upload fail --------');
//                console.log(status);
//                console.log('field: ' + field);
                toastr.error('failed:' + field)
            }
        }
    }
</script>

<style>
    .vue-image-crop-upload .vicp-wrap .vicp-operate {
        position: absolute;
        left: 20px;
        bottom: 20px;
    }
</style>
