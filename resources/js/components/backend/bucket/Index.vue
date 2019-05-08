<template>
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-15">
        <div class="row">
            <h4 class="col-sm-6 c-grey-900 mB-20"><i class="c-deep-orange-500 ti-archive mR-15"></i>Risk Buckets</h4>
            <div class="col-sm-6">
                <div class="btn-group pull-right">
                    <a href="/buckets/create"
                        class="btn btn-primary">New Bucket</a>
                </div>
            </div>
        </div>
        <buckets></buckets>
    </div>
</template>

<script>
    import Buckets from './Buckets'
    import {EventBus} from "@/event-bus"

    export default {
        name: "bucket-page",
        components: {
            Buckets
        },
        data (){
            return {
                createModal: false
            }
        },
        mounted (){
            EventBus.$on('modalClose', () => {this.createModal = false});
        },
        methods: {
            closeModal(){
                this.createModal = false
            },
        },
        beforeDestroy() {
            EventBus.$off('modalClose')
        }
    }
</script>

<style scoped>

</style>