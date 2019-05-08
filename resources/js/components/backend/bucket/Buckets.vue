<template>
    <div>
        <div v-for="(product, index) in products" class="border-bottom mB-10">
            <p class="c-grey-900"><b>
                <i class="c-orange-500 ti-layout-list-thumb"></i>
                <span class="mL-5">{{ product.name }}</span></b>
            </p>
            <div class="row" v-if="product.parent_buckets.length > 0">
                <div v-for="bucket in product.parent_buckets" class="col-sm-4">
                    <div class="bgc-white p-20 bd mB-20">
                        <div class="row">
                            <p class="col-sm-9 c-grey-900"><a :href="'/buckets/' + bucket.id" data-toggle="tooltip" title="View bucket detail">
                                <b>Risk bucket : {{ bucket.name }}</b></a>
                            </p>
                            <div class="col-sm-3 text-right">
                                <a :href="webRoute + '/' + bucket.id + '/edit'" class="text-primary"
                                   data-toggle="tooltip" title="Edit">
                                    <i class="ti-pencil-alt"></i>
                                </a>
                                <a href="#" @click.prevent="deleteBucket(bucket)" class="mL-4 text-danger"
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
                                    <span v-if="bucket.min_score" class="badge badge-success">{{bucket.min_score}}</span>
                                    <span> - to - </span>
                                    <span v-if="bucket.max_score" class="badge badge-dark">{{bucket.max_score}}</span>
                                </p>
                                <p>
                                    <abbr title="Click button to change status">Status</abbr>
                                    <a href="#" class="badge badge-success"> Active </a>
                                </p>
                            </div>
                            <div class="col-sm-4">
                                <img v-if="bucket.color" class="img-fluid" :src="'/' + bucket.color.src" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="alert alert-warning mB-20">No Bucket for this product</div>
        </div>
    </div>
</template>

<script>
    import client from '@/client'
    import alertify from 'alertifyjs'

    export default {
        name: 'buckets',
        data() {
            return {
                products: [],
                webRoute: webRoute,
            }
        },
        mounted() {
            this.fetchProducts()
        },
        updated() {
            $('[data-toggle="tooltip"]').tooltip();
        },
        methods: {
            fetchProducts() {
                client.get(route)
                    .then(response => {
                        this.products = response.data
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