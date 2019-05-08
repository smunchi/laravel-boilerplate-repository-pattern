<template>
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-15">
        <div class="row">
            <h4 class="col-sm-6 c-grey-900 mB-20">
                <i class="c-indigo-500 ti-user mR-15"></i>Profile Detail
            </h4>
            <div class="col-sm-6">
                <div class="btn-group pull-right">
                    <a href="#" onclick="window.history.back()" class="btn btn-primary">
                        <i class="ti-angle-left"></i></a>
                </div>
            </div>
        </div>
        <div v-if="!load" class="row">
            <div class="col-sm-8">
                <p class="c-grey-900 mB-20">
                    <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
                    <b>Personal Information </b>
                </p>
                <p class="row">
                    <b class="col-sm-4 text-right">Name : </b>
                    <span class="col-sm-8">{{ lender.lender.name}}</span>
                </p>
                <p class="row">
                    <b class="col-sm-4 text-right">Contact Email : </b>
                    <span class="col-sm-8">{{ lender.lender.contact_email}}</span>
                </p>
                <p class="row">
                    <b class="col-sm-4 text-right">Website : </b>
                    <span class="col-sm-8">{{ lender.lender.website}}</span>
                </p>
                <p class="row">
                    <b class="col-sm-4 text-right">logo : </b>
                    <span class="col-sm-8"><img v-if="lender.lender.logo" width="200"
                                                :src="lender.lender.logo.src"
                                                :alt="lender.name"
                                                class="img-fluid"></span>
                </p>
            </div>
            <div class="col-sm-4">
                <p class="c-grey-900 mB-20">
                    <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
                    <b>Api credentials </b>
                </p>
                <div class="" v-if="lender.lender.api_credentials">
                    <pre><code>{{lender.lender.api_credentials}}</code></pre>
                </div>
                <div v-else class="text-black-50 mL-20">No api credentials</div>

                <p class="c-grey-900 mB-20">
                    <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
                    <b>Your products </b>
                </p>
                <div v-if="lender.lender.products.length > 0">
                    <p v-for="(product, index) in lender.lender.products"
                        class="mL-15"><b>{{index + 1}}</b>{{ '. '+product.name}} <small>({{product.pivot.min_loan + ' -- ' + product.pivot.max_loan}})</small></p>
                </div>
                <div v-else class="text-black-50 mL-20">No product selected yet</div>
            </div>
            <div class="col-sm-8">
                <p class="c-grey-900 mB-20">
                    <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
                    <b>Login credentials </b>
                </p>
                <p class="row">
                    <b class="col-sm-4 text-right">Email : </b>
                    <span class="col-sm-8">{{ lender.email}}</span>
                </p>

                <div class="">
                    <a :href="webRoute + '/edit'" class="btn btn-primary">Edit profile</a>
                    <a href="#" @click.prevent="createModal =!createModal" class="btn btn-dark">Change Password</a>
                </div>
            </div>
        </div>
        <Loader v-else></Loader>
        <lender-password v-show="createModal"></lender-password>
    </div>
</template>

<script>
    import client from '@/client'
    import Loader from '@comp/lib/Loader'
    import {EventBus} from "@/event-bus"
    import LenderPassword from "./Password";

    export default {
        name: "lender-profile",
        components: {LenderPassword, Loader },
        data() {
            return {
                lender: {},
                load: true,
                createModal: false,
                password: {},
                webRoute: webRoute
            }
        },
        mounted() {
            this.fetchLender();
            EventBus.$on('modalClose', () => {this.createModal = false});
        },
        methods: {
            fetchLender() {
                client.get(route)
                    .then(response => {
                        this.lender = response.data
                        this.load = false
                    })
            },
        },
        beforeDestroy() {
            EventBus.$off('modalClose')
        }
    }
</script>

<style scoped>

</style>