<template>
    <div v-if="rawHtml == null" class="ui icon message info">
        <i class="notched circle loading icon"></i>
        <div class="content">
            <div class="header">稍候 </div>
            <p>正在努力加载中。。。</p>
        </div>
    </div>
    <div v-else>
        <div class="ui readme markdown-body content-body" v-html="rawHtml">
        </div>
    </div>
</template>

<script>

    import emojione from 'emojione'

    export default {
        props: {
            content: {
                type: String,
                default() {
                    return null
                }
            }
        },
        data() {
            return {
                rawHtml: null,
            }
        },
        created() {
            this.rawHtml = emojione.toImage(marked(this.content))
        }
    }
</script>
