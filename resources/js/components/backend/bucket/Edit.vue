<template>
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-15">
        <div class="row">
            <h4 class="col-sm-6 c-grey-900 mB-20">
                <i class="c-deep-orange-500 ti-archive mR-15"></i>
                Edit Risk Bucket
            </h4>
            <div class="col-sm-6">
                <div class="btn-group pull-right">
                    <a href="#" onclick="window.history.back()" class="btn btn-primary">
                        <i class="ti-angle-left"></i></a>
                </div>
            </div>
        </div>

        <product-form :value="bucket" method="put"></product-form>
    </div>
</template>

<script>
    import ProductForm from './Form'
    import client from '@/client'
    export default {
        name: "bucket-edit",
        components: {
            ProductForm
        },
        props: {
            bucketid: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                bucket: {}
            }
        },
        mounted() {
            this.fetchBucket()
        },
        methods: {
            fetchBucket() {
                client.get(route + '/' + this.bucketid)
                    .then(response => {
                        this.bucket = response.data
                    })
            }
        }
    }
</script>

<style scoped>

</style>
