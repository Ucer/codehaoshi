$(function () {
    var original_title = document.title;

    var GeekCenter = {
        init: function () {
            var self = this;
            NProgress.start();
            $(window).load(function () {
                NProgress.done();
            });
            $(document).pjax('aaaaaaaaaa:not(a[target="_blank"])', 'body', {
                timeout: 1600,
                maxCacheLength: 500
            });
            $(document).on('pjax:start', function () {
                NProgress.start();
            });
            $(document).on('pjax:complete', function () {

                original_title = document.title;
                NProgress.done();
                // self.siteBootUp();
            });
            $(document).on('pjax:end', function () {
                NProgress.done();
                self.siteBootUp();
                // $('.popover').remove();
            });
            // Exclude links with a specific class
            $(document).on("pjax:click", "a.no-pjax", false);
            self.siteBootUp();
        },
        /*
         * Things to be execute when normal page load
         * and pjax page load.
         */
        siteBootUp: function () {
            var self = this;
            self.initScrollup();
            self.initSematicUI();
            self.initSticky();
            self.initTOC();
            self.replyBtnShow();
            self.initLogoutAlert();
            self.initEnterKey();
            self.initLoginRequired();
            self.initEmoji();
            self.initEditorPreview();
            self.initOpenMenu();
            // self.initTimeAgo();
            // self.initCommentOnPressKey();
            // self.initAjax();
            // self.initIinfiniteScroll()

        },
        initOpenMenu: function(){
            $('.ui.sidebar').sidebar('attach events', '.attach-sidebar');
        },
        // initIinfiniteScroll: function(){
            // $('.jjscroll').jscroll({
            //     loadingHtml: '<div style="padding:20px">Loading...</div>',
            //     padding: 20,
            //     nextSelector: '.pagination li:last-child a',
            //     contentSelector: '.jscroll',
            //     pagingSelector: '.panel-footer',
            //     maxPages: 2,
            //     callback: function() {
            //         $('.panel-footer').hide();
            //     }
            // });
        // },
        /**
         * Automatically transform any Date format to human
         * friendly format, all you need to do is add a
         * `.timeago` class.
         */
        // initTimeAgo: function(){
            // // moment.lang('zh-cn');
            // $('.timeago').each(function(){
            //     var time_str = $(this).text();
            //     if(moment(time_str, "YYYY-MM-DD HH:mm:ss", true).isValid()) {
            //         $(this).text(moment(time_str).fromNow());
            //     }
            //
            //     $(this).addClass('popover-with-html');
            //     $(this).attr('data-content', time_str);
            // });
        // },
        // initAjax: function () {
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        //         }
        //     });
        //     // this.initComment();
        // },
        // ***************
        // initComment: function () {
        //     var self = this;
        //     var form = $('#comment-form');
        //     var submitBtn = form.find('button[type=submit]');
        //     var submitBtnVal = submitBtn.val();
        //     var replies = $('.replies .list-group');
        //     var preview = $('#preview-box');
        //     var emptyBlock = $('#replies-empty-block');
        //     var count = 0;
        //
        //     form.on('submit', function() {
        //         var tpl = '';
        //         var delTpl = '';
        //         var voteTpl = '';
        //         var introTpl = '';
        //         var badgeTpl = '';
        //         var total = $('.replies .total b');
        //         count = replies.find('li').length + 1;
        //         comment = $(this).find('textarea');
        //         commentText = comment.val();
        //
        //
        //         if ($.trim(commentText) !== '') {
        //             submitBtn.text('提交中...').addClass('disabled').prop('disabled', true);
        //             return ;
        //         }
        //
        //
        //     });
        //
        // },
        // *********************************

        /**
         * Init post content preview
         */
        initEditorPreview: function () {
            var self = this;
            $("#comment_content").focus(function (event) {
                $("#preview-box").fadeIn(1500);
                $("#preview-lable").fadeIn(1500);

            });
            $('#comment_content').keyup(function () {
                self.runPreview();
            });
        },
        /**
         * do content preview
         */
        runPreview: function () {
            var commentContent = $("#comment_content");
            var oldContent = commentContent.val();

            if (oldContent) {
                marked(oldContent, function (err, content) {
                    $('#preview-box').html(content);
                    emojify.run(document.getElementById('preview-box'));
                });
            }
        },
        /**
         * Enable emoji everywhere.
         */
        initEmoji: function () {

            emojify.setConfig({
                img_dir: Config.cdnDomain + '/assets/images/emoji',
                ignored_tags: {
                    'SCRIPT': 1,
                    'TEXTAREA': 1,
                    'A': 1,
                    'PRE': 1,
                    'CODE': 1
                }
            });
            emojify.run();
            $('#comment_content').textcomplete([
                { // emoji strategy
                    match: /\B:([\-+\w]*)$/,
                    search: function (term, callback) {
                        callback($.map(emojies, function (emoji) {
                            return emoji.indexOf(term) === 0 ? emoji : null;
                        }));
                    },
                    template: function (value) {
                        return '<img src="' + Config.cdnDomain + 'assets/images/emoji/' + value + '.png"></img>' + value;
                    },
                    replace: function (value) {
                        return ':' + value + ': ';
                    },
                    index: 1,
                    maxCount: 5
                },
            ]);
        }
        ,
        /*
         * local storage
         */
        initLocalStorage: function () {

        }
        ,
        /*
         * Use Ctrl + Enter for reply
         */
        // initCommentOnPressKey: function () {
        //     $(document).on("keydown", "#comment_content", function (e) {
        //         if ((e.keyCode == 10 || e.keyCode == 13) && e.ctrlKey && $('#comment-create-submit').is(':enabled')) {
        //             $(this).parents("form").submit();
        //             return false;
        //         }
        //     });
        // }
        // ,
        initLoginRequired: function () {
            $('.login-required').on('click', function (e) {
                swal({
                    title: "",
                    text: "请登录后再操作",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "取消",
                    confirmButtonText: "前往登录"
                }, function () {
                    location.href = '/login';
                });

                return false;
            });
        }
        ,
        initEnterKey: function () {
            // 保存按钮 enter
            document.onkeydown = function (event) {
                var e = event || window.event || arguments.callee.caller.arguments[0];
                if (e && e.keyCode == 13) { // enter 键
                    $('.enterKeyBtn').click();
                }
            };
        }
        ,
        initLogoutAlert: function () {
            $('.login-out-btn').on('click', function (e) {
                var langText = $(this).data('lang-loginout');
                var href = $(this).attr('href');
                swal({
                    title: "",
                    text: langText,
                   type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "取消",
                    confirmButtonText: "退出"
                }, function () {
                    location.href = href;
                });

                return false;
            });
        }
        ,
        replyBtnShow: function () {
            $('.comments-feed .comment').each(function () {
                $(this).hover(function (event) {
                    $(this).find('.reply-btn').show();
                });
                $(this).mouseleave(function (event) {
                    $(this).find('.reply-btn').hide();
                });

            });
        }
        ,
        initSematicUI: function () {
            $('.ui.sticky').sticky();
            $('.ui.popover').popup({
                on: 'hover',
                position: 'right center'
            });
            $('.ui.titlepop').popup({
                on:'hover'
            });
            $('.selection.dropdown').dropdown() ;
        }
        ,
        initTOC: function () {
            $("#toc").tocify({
                context: '.article-content',
                selectors: "h2,h3"
            });
        }
        ,
        initSticky: function () {
            if ($(window).width() > 991) {
                $("#sticker").sticky({topSpacing: 20});
            }
        }
        ,
        initScrollup: function () {
            $.scrollUp.init();
        }
        ,
    };
    window.GeekCenter = GeekCenter;
});

$(document).ready(function () {
    GeekCenter.init();
});
