<template>
    <div class="extra content">
        <button class=" ui basic teal button fluid follow disabled"  v-if="loading"> 关注他 </button>
        <button class=" ui basic teal button fluid follow"
                v-else
                :class="requireLogin"
                v-text="text"
                v-on:click="followUser">
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            isChecked: {
                type: String,
                default() {
                    return 'false'
                }
            },
            user: {
                type: String,
                default() {
                    return ''
                }
            }
        },
        data() {
            return {
                followed: false,
                loading: true,
            }
        },
        mounted() {
            this.$http.get('user/followers/' + this.user).then(response => {
                this.followed = response.data.followed;
                this.loading = false;
            })
        },
        computed: {
            text() {
                return this.followed ? '取消关注' : '关注他';
            },
            requireLogin()
            {
                return this.isChecked == 'false' ? 'login-required' : '';
            },
        },
        methods: {
            followUser() {
                this.$http.post('user/follow', {'user': this.user}).then(response => {
                    this.followed = response.data.followed;
                    toastr.info('操作成功');
                }).catch(({response}) => {
                    toastr.error('出错了，请稍后重试');
                })
            }
        }
    }
</script>