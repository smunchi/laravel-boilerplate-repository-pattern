<template>
    <div class="pT-10">
        <div class="row">
            <div class="col-sm-10">
                <p>
                    <i class="ti-align-left c-orange-800 mR-10"></i>
                    A bucket of <b>{{bucket.product_name.name}} </b>product
                </p>
                <p>
                    <i class="ti-align-left c-orange-800 mR-10"></i>
                    <span> Score </span>
                    <span v-if="bucket.min_score" class="badge badge-success">{{bucket.min_score}}</span>
                    <span> - to - </span>
                    <span v-if="bucket.max_score" class="badge badge-dark">{{bucket.max_score}}</span>
                </p>
                <p>
                    <i class="ti-align-left c-orange-800 mR-10"></i>
                    <abbr title="Click button to change status">Status</abbr>
                    <a href="#" class="badge badge-success"> Active </a>
                </p>
            </div>
            <div class="col-sm-2">
                <div class="img-thumbnail" v-if="bucket.color">
                    <img :src="bucket.color ?'/'+ bucket.color.src:''" class="img-fluid" :alt="bucket.name">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "bucket-info",
        props: {
            bucket: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>