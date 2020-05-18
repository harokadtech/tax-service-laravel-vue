<template>

    <div>
        <canvas class="signature"></canvas>

        <div class="clearfix"></div>

        <div class="btn-group">
            <v-btn text small outlined  color="primary" @click="clear" type="button" >
                <i class="fa fa-times"></i>
                Clear
            </v-btn>
        </div>

    </div>

</template>

<style>
    .signature {
        border: 2px solid #cbc9c6;
        border-radius: 5px;
    }
</style>

<script>
    import SignaturePad from 'signature_pad';
    export default {
        props: {
            value: String,
        },
        data() {
            return {
                pad: null,
            };
        },
        mounted() {
            let canvas = document.querySelector('canvas');
            this.pad = new SignaturePad(canvas, {
                onEnd: () => {
                    this.$emit('input', this.pad.toDataURL());
                    /*this.sign = this.pad.toDataURL();
                    console.log(this.sign);*/
                }
            });
        },
        methods: {
            clear() {
                this.pad.clear();
                this.$emit('input', this.pad.toDataURL());
            },
        }
    }
</script>
