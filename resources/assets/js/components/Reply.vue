<template>
    <div>
        <div v-bind:style="{display:loading?'block':'none'}" class="ui icon message info">
            <i class="notched circle loading icon"></i>
            <div class="content">
                <div class="header">稍候 </div>
                <p>正在努力加载中。。。</p>
            </div>
        </div>
        <div v-bind:style="{display:loading?'none':'block'}">
            <div class="ui message basic centerd voted-box">
                <div class="buttons" v-if="canVote">
                    <div class="ui button kb-star-big basic teal" :class="requireLogin" @click="functionVote('up')"
                         title="点赞相当于收藏，可以在个人页面的「关注的」导航里查看"><i
                            class="icon thumbs up"></i> <span class="state">点赞</span>
                    </div>
                </div>
                <div class="buttons" v-else>
                    <div class="ui button kb-star-big basic teal" @click="functionVote('dw')"
                         title="点赞相当于收藏，可以在个人页面的「赞过的话题」导航里查看">
                        <span class="state">取消点赞</span>
                    </div>
                </div>

                <div class="voted-users">
                <span v-for="(vote, index) in votes">
                    <a :href="'/users/' + vote.user_name" class="ui popover">
                        <img class="ui image avatar image-33 stargazer"
                             :src="vote.avatar">
                    </a>
            </span>
                    <span v-if="votes.length == 0"> 成为第一个点赞的人吧 &nbsp;&nbsp; <img alt=":smile:" class="emoji"
                                                                      src="/assets/images/emoji/smile.png"
                                                                      align="absmiddle"/> </span>
                </div>
            </div>
            <div class="ui threaded comments comment-list ">
                <div class="ui divider horizontal grey"><i class="icon comments"></i> {{ reply_count }}
                </div>

                <div class="comments-feed">
                    <div class="comment" v-for="(reply, index) in replies">
                        <a class="avatar" :href="'/users/' +reply.user_name">
                            <img :src="reply.avatar">
                        </a>
                        <div class="content">
                            <div class="comment-header">
                                <div class="meta">
                                    <a class="author ui popover" :href="'/users/' + reply.user_name"> <i
                                            class="icon user"></i>{{ reply.user_name }}</a>
                                    <div class="metadata">
                                        <span class="date"><i class="icon wait"></i>{{ reply.created_at }}</span>
                                    </div>
                                </div>
                                <div class="reaction">
                                    <div class="ui floating basic icon dropdown button" tabindex="0">
                                        <a title="删除" class="ui teal" href="javascript:;"
                                           v-if="canDelComment(reply.user_id)"
                                           @click="commentDelete(index, reply.id)"><i class="icon trash"></i></a>
                                        <a href="#comment_content" :title="'回复'+reply.user_name"
                                           @click="replyOne(reply.user_name)"
                                           class="ui teal reply-btn"><i class="icon reply"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="text comment-body markdown-reply" v-html="reply.content_html">
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div class="comment-box">
                    <h3 class="ui header" v-if="isChecked == 'false'">
                        <a href="" class="login-required">登录</a>
                    </h3>
                    <div class="ui warning message">
                        <i class="icon warning"></i> 支持 markdown 语法、支持表情,请务进行语言攻击。
                    </div>

                    <form class="ui reply form" @submit.prevent="functionReply"
                          accept-charset="UTF-8" id="comment-composing-form">
                        <input type="hidden" name="article_id" value=""/>

                        <div class="field">
                    <textarea name="body" required="请填写内容" :class="requireLogin" v-model="body"
                              id="comment_content"></textarea></div>
                        <button class="ui teal labeled icon button" :disabled="isSubmiting ? true : false"
                                v-if="isChecked != 'false'" type="submit"
                                id="comment-create-submit">
                            <i class="icon comment"></i> {{ isSubmiting ? '提交中...' : '评论' }}
                        </button>
                        <!--<span class="help-inline" title="Or Command + Enter">Ctrl+Enter</span>-->
                        <div class="box preview markdown-reply" id="preview-box" style="display: none"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {stack_error} from 'config/helper'
    import emojione from 'emojione';
    export default {
        props: {
            questionId: {
                type: String,
                default() {
                    return '0'
                }
            },
            isChecked: {
                type: String,
                default() {
                    return 'false'
                }
            },
            userid: {
                type: String,
                default() {
                    return ''
                }
            },
            isadmin: {
                default() {
                    return null;
                }
            }
        },
        data()
        {
            return {
                replies: [],
                body: '',
                isSubmiting: false,
                votes: [],
                reply_count: 0,
                loading: true,
            }
        }
        ,
        computed: {
            requireLogin()
            {
                return this.isChecked == 'false' ? 'login-required' : '';
            },
            noVote()
            {
                return this.votes.count < 1 ? true : false;
            },
            canVote()
            {
                if (this.userid < 1) return true;
                let a = [];
                this.votes.forEach((data) => {
                    a.push(data.id)
                });
                var i = a.find((n) => n == this.userid);
                if (!i) return true;
                return false;
            },

        }
        ,
        mounted()
        {
            var url = 'reply/' + this.questionId + '/reply';
            this.$http.get(url, {
                params: {
                    order_by: 'created_at'
                }
            }).then((response) => {
                response.data.data.forEach((data) => {
                    data.content_html = this.parse(data.content_raw);
                    return data
                });
                this.replies = response.data.data;
                this.reply_count = this.replies.length
            });
            this.loadVoteList()
        }
        ,
        methods: {
            canDelComment(uid)
            {
                if (this.isadmin || this.userid == uid) return true; // If nowUser has supper_admin role or is this comment's publish men

                return false;
            },
            userCenter(user_name)
            {
                return '//users/' + user_name;
            },
            functionVote(type) {
                var url = 'question/' + this.questionId + '/vote';
                this.$http.post(url, {type: type}).then((response) => {
                    toastr.info('操作成功');
                    if (type == 'up') {
                        this.votes.push(response.data.data);
                    } else {
                        this.loadVoteList()
                    }

                }).catch(({response}) => {
                    this.isSubmiting = false;
                    stack_error(response)
                })
            },
            loadVoteList() {
                var url = 'question/' + this.questionId + '/voteuser';
                this.$http.get(url).then((response) => {
                    this.votes = response.data;
                    this.loading = false;
                });
            },
            handleCount(type) {
                if (type == 0) {
                    this.reply_count += 1;
                } else {
                    this.reply_count -= 1;
                }
            },
            parse(html)
            {
                marked.setOptions({
                    highlight: (code) => {
                        return hljs.highlightAuto(code).value
                    }
                });
                return emojione.toImage(marked(html));
            }
            ,
            functionReply()
            {

                const data = {
                    body: this.body,
                    question_id: this.questionId
                };
                this.isSubmiting = true;

                this.$http.post('reply', data)
                    .then((response) => { // 只要这里面报错了，就会执行 catch 方法
                        let postResult = null;
                        postResult = response.data.data;
                        postResult.content_html = this.parse(postResult.content_raw);
                        this.replies.push(postResult);
                        this.body = '';
                        this.handleCount(0);
                        this.isSubmiting = false;
                        $("#preview-box").html(this.body);

                        toastr.info('评论成功');
                    })
                    .catch(({response}) => {
                        this.isSubmiting = false;
                        stack_error(response)
                    })

            }
            ,
            replyOne(user_name)
            {
                this.body = '@' + user_name + ' ';
            }
            ,
            commentDelete(index, id)
            {
                let defaults = this;
                swal({
                    title: "",
                    text: "确定要删除该评论么",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "取消",
                    confirmButtonText: "确定"
                }, function () {
                    defaults.$http.delete('reply/' + id)
                        .then((response) => {
                            defaults.replies.splice(index, 1);
                            defaults.handleCount(1);
                            toastr.info('评论删除成功');

                        })
                        .catch(({response}) => {
                            stack_error(response)
                        });
                });
            }
        }
    }
</script>