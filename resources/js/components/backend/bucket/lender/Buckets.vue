<template>
    <div v-if="lenderProducts.length > 0">
        <div v-for="(lenderProduct, index) in lenderProducts" class="mB-30">
            <p class="c-grey-900"><b>
                <i class="c-orange-500 ti-layout-list-thumb"></i>
                <span class="mL-5">{{ lenderProduct.product.name }}</span></b>
            </p>
            <div v-if="lenderProduct.product.buckets.length > 0">
                <div class="row border-top bdc-grey-300 border-bottom bgc-grey-200">
                    <div class="col-sm-4 pT-10 pB-10 c-grey-900">Parent Bucket</div>
                    <div class="col-sm-8 pT-10 pB-10 c-grey-900 bdc-grey-400 border-left">Children Bucket</div>
                </div>
                <div v-for="bucket in lenderProduct.product.buckets" class="row border-bottom bdc-grey-300">
                    <!-- parent bucket start-->
                    <div class="col-sm-4">
                        <p class="mT-10 c-grey-900"><a :href="webRoute + '/' + bucket.id" data-toggle="tooltip" title="View bucket detail">
                            <b>Risk bucket : {{ bucket.name }}</b></a>
                        </p>
                        <div class="row">
                            <div class="col-sm-8">
                                <p>
                                    <span>Applications </span>
                                    <span class="badge badge-light">44/56/12</span>
                                </p>
                                <p>
                                    <span> Score </span>
                                    <span v-if="bucket.min_score" class="badge badge-success">{{bucket.min_score}}</span>
                                    <span> - to - </span>
                                    <span v-if="bucket.max_score" class="badge badge-dark">{{bucket.max_score}}</span>
                                </p>
                                <p>
                                    <abbr title="Click button to change status">Status</abbr>
                                    <a href="#" class="badge badge-success"> Active </a>
                                </p>
                                <p><a :href="webRoute + '/'+bucket.id+'/create'"
                                      class="btn btn-sm btn-primary"
                                      data-toggle="tooltip" title="Edit">
                                        <i class="ti-plus"></i> New child bucket
                                </a></p>
                            </div>
                            <div class="col-sm-4">
                                <img v-if="bucket.color" class="img-fluid" :src="'/' + bucket.color.src" alt="">
                            </div>
                        </div>
                    </div><!-- parent bucket end-->

                    <!-- child bucket start-->
                    <div class="col-sm-8 border-left bdc-grey-300">
                        <div class="row" v-if="bucket.children.length > 0">
                            <div v-for="childBucket in bucket.children" class="col-sm-6 mT-10">
                                <div class="bgc-white p-20 bd mB-20">
                                    <div class="row">
                                        <p class="col-sm-9 c-grey-900"><a :href="webRoute + '/' + childBucket.id" data-toggle="tooltip" title="View bucket detail">
                                            <b>Risk bucket : {{ childBucket.name }}</b></a>
                                        </p>
                                        <div class="col-sm-3 text-right">
                                            <a :href="webRoute + '/' + childBucket.id + '/edit'" class="text-primary"
                                               data-toggle="tooltip" title="Edit">
                                                <i class="ti-pencil-alt"></i>
                                            </a>
                                            <a href="#" @click.prevent="deleteBucket(childBucket)" class="mL-4 text-danger"
                                               data-toggle="tooltip" title="Delete">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>
                                                <span>Applications </span>
                                                <span class="badge badge-light">44/56/12</span>
                                            </p>
                                            <p>
                                                <span> Score </span>
                                                <span v-if="childBucket.min_score" class="badge badge-success">{{childBucket.min_score}}</span>
                                                <span> - to - </span>
                                                <span v-if="childBucket.max_score" class="badge badge-dark">{{childBucket.max_score}}</span>
                                            </p>
                                            <p>
                                                <abbr title="Click button to change status">Status</abbr>
                                                <a href="#" class="badge badge-success"> Active </a>
                                            </p>
                                        </div>
                                        <div class="col-sm-4">
                                            <img v-if="childBucket.color" class="img-fluid" :src="'/' + childBucket.color.src" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else class="text-dark mT-15"><b>No child risk bucket added yet </b></div>
                    </div><!-- child bucket start-->
                </div>
            </div>
            <div v-else class="alert alert-secondary">No risk bucket for this product</div>
        </div>
    </div>
</template>

<script>
    import client from '@/client'
    import alertify from 'alertifyjs'
    export default {
        name: "lender-buckets",
        data() {
            return {
                lenderProducts: [],
                webRoute: webRoute
            }
        },
        mounted() {
            this.fetchLenderBuckets()
        },
        methods: {
            fetchLenderBuckets() {
                client.get(route)
                    .then(response => {
                        if (response.status >= 200 && response.status < 300) {
                            this.lenderProducts = response.data
                        }
                    })
            },
            deleteBucket(bucket) {
                alertify.confirm('Bucket delete', 'Are you sure?', () => {
                    client.delete(route + '/' + bucket.id)
                        .then(respone => {
                            alertify.success(respone.data.message)
                            this.fetchProducts();
                        })
                }, () => {});
            }
        }
    }
</script>

<style scoped>

</style>