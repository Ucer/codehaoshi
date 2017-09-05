<script>
    $(document)
        .ready(function () {
            $('.ui.form')
                .form({
                    fields: {
                        category_id: {
                            identifier: 'category_id',
                            rules: [
                                {
                                    type: 'empty',
                                    prompt: '请选择所属分类'
                                }
                            ]
                        },
                        title: {
                            identifier: 'title',
                            rules: [
                                {
                                    type: 'empty',
                                    prompt: '标题不能为空'
                                },
                                {
                                    type: 'minLength[3]',
                                    prompt: '标题长度至少为3位'
                                },
                                {
                                    type: 'maxLength[60]',
                                    prompt: '标题长度至多为60位'
                                }
                            ]
                        },
                        description: {
                            identifier: 'description',
                            rules: [
                                {
                                    type: 'empty',
                                    prompt: '描述不能为空'
                                },
                                {
                                    type: 'minLength[3]',
                                    prompt: '标题长度至少为3位'
                                },
                                {
                                    type: 'maxLength[200]',
                                    prompt: '标题长度至多为200位'
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
