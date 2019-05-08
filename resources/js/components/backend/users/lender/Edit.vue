<template>
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-15">
        <div class="row">
            <h4 class="col-sm-6 c-grey-900 mB-20">
                <i class="c-indigo-500 ti-money mR-15"></i>Edit Lender
            </h4>
            <div class="col-sm-6">
                <div class="btn-group pull-right">
                    <a href="#" onclick="window.history.back()" class="btn btn-primary">
                        <i class="ti-angle-left"></i></a>
                </div>
            </div>
        </div>
        <lender-form v-if="!checkEmptyLender" :value="lender" method="put"></lender-form>
    </div>
</template>

<script>
    import client from '@/client'
    import LenderForm from './Form'
    export default {
        name: "lender-edit",
        components: {
            LenderForm
        },
        props: {
            lenderid: {
                type: Number,
                required: true
            }
        },
        computed: {
            checkEmptyLender() {
                return _.isEmpty(this.lender)
            }
        },
        data (){
            return {
                lender: {}
            }
        },
        mounted() {
            this.fetchLender();
        },
        methods: {
            fetchLender (){
                client.get(route + '/' + this.lenderid)
                    .then(response => {
                        this.lender = response.data
                        this.lender.products = response.data.products.map((product) => {
                            return {
                                id: product.id,
                                name: product.name,
                                min_loan: product.pivot.min_loan,
                                max_loan: product.pivot.max_loan,
                                select: true
                            };
                        });
                    })
            }
        }
    }
</script>

<style scoped>

</style>
