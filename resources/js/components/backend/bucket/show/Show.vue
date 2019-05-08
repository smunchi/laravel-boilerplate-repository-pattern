<template>
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-15">
        <template v-if="!load">
        <div class="row">
            <h4 class="col-sm-6 c-grey-900 mB-20"><i class="c-deep-orange-500 ti-archive mR-15"></i>{{bucket.name}}</h4>
            <div class="col-sm-6 text-right">
                <div class="btn-group btn-group-sm">
                    <a href="#" onclick="window.history.back()" class="btn btn-dark">
                        <i class="ti-angle-left"></i></a>
                    <a :href="webRoute + '/' + bucket.id + '/edit'" class="btn btn-primary">
                        <i class="ti-pencil-alt"></i>
                    </a>
                    <a href="#" @click.prevent="deleteBucket(bucket)" class="btn btn-danger">
                        <i class="ti-trash"></i>
                    </a>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" @click.prevent="currentTabComponent = 'Info'"
                   :class="{active: currentTabComponent === 'Info'}"
                    href="#"><b>Bucket Detail</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" @click.prevent="currentTabComponent = 'Rules'"
                   :class="{active: currentTabComponent === 'Rules'}"
                    href="#"><b>Bucket Rules</b></a>
            </li>
        </ul>
        <keep-alive>
            <component v-bind:is="currentTabComponent" v-bind="currentProperties"></component>
        </keep-alive>
        </template>
        <template v-else>
            <loader></loader>
        </template>
    </div>
</template>

<script>
    import client from '@/client'
    import Info from './Info'
    import Rules from './Rules'
    import Loader from '@comp/lib/Loader'
    import alertify from 'alertifyjs'

    export default {
        name: "bucket-show",
        props: {
            bucketid: {
                type: Number,
                required: true
            }
        },
        components: {
            Info, Rules, Loader
        },
        computed: {
            currentProperties() {
                if (this.currentTabComponent === 'Info')
                    return {bucket: this.bucket}
                if (this.currentTabComponent === 'Rules')
                    return {rules: this.bucket.rules}
            }
        },
        data() {
            return {
                bucket: {},
                load: true,
                currentTabComponent: 'Info',
                webRoute: webRoute
            }
        },
        mounted() {
            this.fetchBucket()
        },
        methods: {
            fetchBucket() {
                let self = this
                client.get(route + '/' + this.bucketid)
                    .then(response => {
                        self.bucket = response.data
                        self.load = false
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