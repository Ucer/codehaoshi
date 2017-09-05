<script>
    $(document)
        .ready(function () {
            $('.ui.form')
                .form({
                    fields: {
                        name: {
                            identifier: 'user_name',
                            rules: [
                                {
                                    type: 'empty',
                                    prompt: '请输入用户名'
                                },
                                {
                                    type: 'regExp[/^[a-zA-Z0-9]+$/]',
                                    prompt: '用户名只能由数字和英文字母组成'
                                }
                            ]
                        },
                        email: {
                            identifier: 'email',
                            rules: [
                                {
                                    type: 'empty',
                                    prompt: '请输入邮箱'
                                },
                                {
                                    type: 'email',
                                    prompt: '邮箱格式不正确'
                                }
                            ]
                        },
                        password: {
                            identifier: 'password',
                            rules: [
                                {
                                    type: 'empty',
                                    prompt: '请输入密码'
                                },
                                {
                                    type: 'minLength[6]',
                                    prompt: '密码长度至少为6位'
                                }
                            ]
                        },
                        old_password: {
                            identifier: 'old_password',
                            rules: [
                                {
                                    type: 'empty',
                                    prompt: '请输入原密码'
                                },
                                {
                                    type: 'minLength[6]',
                                    prompt: '原密码长度至少为6位'
                                }
                            ]
                        },
                        password_confirmation: {
                            identifier: 'password_confirmation',
                            rules: [
                                {
                                    type: 'match[password]',
                                    prompt: '确认密码必须和密码一致'
                                }
                            ]
                        },
                        bio: {
                            identifier: 'bio',
                            rules: [
                                {
                                    type: 'empty',
                                    prompt: '请输入个人简介'
                                },
                                {
                                    type: 'minLength[6]',
                                    prompt: '个人简介至少6个长度'
                                }
                            ]
                        }
                    },
                    inline: true,
                    on: 'blur'
                });
        })
    ;
</script>
