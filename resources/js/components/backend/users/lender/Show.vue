<template>
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-15">
        <div class="row">
            <h4 class="col-sm-6 c-grey-900 mB-20">
                <i class="c-indigo-500 ti-money mR-15"></i>Lenders Details
            </h4>
            <div class="col-sm-6 text-right">
                <div class="btn-group btn-group-sm">
                    <a href="#" onclick="window.history.back()" class="btn btn-dark">
                        <i class="ti-angle-left"></i></a>
                    <a :href="webRoute + '/' + lender.id + '/edit'" class="btn btn-primary">
                        <i class="ti-pencil-alt"></i>
                    </a>
                    <a href="#" @click.prevent="deleteLender(lender)" class="btn btn-danger">
                        <i class="ti-trash"></i>
                    </a>
                </div>
            </div>
        </div>
        <div v-if="!load" class="row">
            <div class="col-sm-8">
                <p class="c-grey-900 mB-20">
                    <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
                    <b>Personal Information of lender </b>
                </p>
                <p class="row">
                    <b class="col-sm-4 text-right">Name : </b>
                    <span class="col-sm-8">{{ lender.name}}</span>
                </p>
                <p class="row">
                    <b class="col-sm-4 text-right">Contact Email : </b>
                    <span class="col-sm-8">{{ lender.contact_email}}</span>
                </p>
                <p class="row">
                    <b class="col-sm-4 text-right">Website : </b>
                    <span class="col-sm-8">{{ lender.website}}</span>
                </p>
                <p class="row">
                    <b class="col-sm-4 text-right">logo : </b>
                    <span class="col-sm-8"><img v-if="lender.logo" width="200"
                                                :src="lender.logo.src"
                                                :alt="lender.name"
                                                class="img-fluid"></span>
                </p>
            </div>
            <div class="col-sm-4">
                <p class="c-grey-900 mB-20">
                    <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
                    <b>Lender api credentials </b>
                </p>
                <div class="" v-if="lender.api_credentials">
                    <pre><code>{{lender.api_credentials}}</code></pre>
                </div>
                <div v-else class="text-black-50 mL-20">No api credentials</div>

                <p class="c-grey-900 mB-20">
                    <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
                    <b>Lender products </b>
                </p>
                <div v-if="lender.products.length > 0">
                    <p v-for="(product, index) in lender.products"
                       class="mL-15"><b>{{index + 1}}</b>{{ '. '+product.name}}</p>
                </div>
                <div v-else class="text-black-50 mL-20">No product selected yet</div>
            </div>
            <div class="col-sm-8">
                <p class="c-grey-900 mB-20">
                    <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
                    <b>Lender login credentials </b>
                </p>
                <p class="row">
                    <b class="col-sm-4 text-right">Email : </b>
                    <span class="col-sm-8">{{ lender.user.email}}</span>
                </p>

            </div>
        </div>
        <Loader v-else></Loader>
    </div>
</template>

<script>
    import client from '@/client'
    import alertify from 'alertifyjs'
    import Loader from '@comp/lib/Loader'

    export default {
        name: "lender-show",
        props: {
            lenderid: {
                type: Number,
                required: true
            }
        },
        components: { Loader },
        data() {
            return {
                lender: {},
                load: true,
                webRoute: webRoute
            }
        },
        mounted() {
            this.fetchLender();
        },
        methods: {
            fetchLender() {
                client.get(route + '/' + this.lenderid )
                    .then(response => {
                        this.lender = response.data
                        this.load = false
                    })
            },
            deleteLender(lender) {
                alertify.confirm('Lender delete', 'Are you sure?', () => {
                    client.delete(route + '/' + lender.id)
                        .then(respone => {
                            alertify.success(respone.data.message)
                            this.fetchLenders();
                        })
                }, () => {});
            }
        }
    }
</script>

<style scoped>

</style>