<template>
    <div :class="wrapper">
        <div :class="cropperWrapper">
            <img id="cropImage" style="width:100%" :src="image.msg">
        </div>
        <span slot="footer" class="footer">
      <button class="btn btn-outline-secondary" @click="cancel">{{ $t('form.cancel') }}</button>
      <button class="btn btn-primary" @click="upload">{{ $t('form.ok') }}</button>
    </span>
    </div>
</template>
<script>
    import 'cropperjs/dist/cropper.css'
    import Cropper from 'cropperjs'
    export default {
        props: {
            image: {
                type: Object,
                default() {
                    return {}
                }
            },
            wrapper: {
                type: String,
                default() {
                    return ''
                }
            },
            cropperWrapper: {
                type: String,
                default() {
                    return ''
                }
            },
        },
    }
</script>
