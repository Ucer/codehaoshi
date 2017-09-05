/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./vendor/jquery.scroll.up');
require('./../semantic/dist/semantic');
require('./vendor/jquery-ui.min');
require('./vendor/jquery.tocify.min');
require('./vendor/jquery.pjax');
// require('./vendor/nprogress');
// require('./vendor/sweetalert');
require('./vendor/jquery.textcomplete'),
require('simplemde/dist/simplemde.min');
require('./main');

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
