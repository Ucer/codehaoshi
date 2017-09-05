// window.swal = require('sweetalert');
window.Vue = require('vue');
window.marked = require('marked');
window.hljs = require('vendor/highlight.min.js');


require('./bootstrap');
require('./vendor/jquery.scroll.up');
require('./../semantic/dist/semantic');
require('./vendor/jquery-ui.min');
require('./vendor/jquery.tocify.min');
require('./vendor/jquery.pjax');
require('./vendor/jquery.textcomplete'),
require('simplemde/dist/simplemde.min');
require('social-share.js/dist/js/social-share.min.js');

window.toastr = require('toastr');
window.innerHeight = 800;

window.toastr.options = {
    positionClass: "toast-bottom-right",
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
    closeButton: true
};

import httpPlugin from 'plugins/http';

Vue.use(httpPlugin);

Vue.component('comment', require('components/Comment.vue'));
Vue.component('parse', require('components/Parse.vue'));
Vue.component('voteButton', require('components/VoteButton.vue'));
Vue.component('avatar', require('components/Avatar.vue'));
Vue.component('myUpload', require('vue-image-crop-upload'));

Vue.component('reply', require('components/Reply.vue'));

new Vue({
}).$mount('#codehaoshi');

