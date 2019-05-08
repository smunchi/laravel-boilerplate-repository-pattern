<template>
<div class="row">
    <template v-if="!loader">
    <div class="col-sm-6">
        <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-20">
            <p class="c-grey-900"><b>
                <i class="c-orange-500 ti-layout-list-thumb"></i>
                <span class="mL-5">Application info</span>
            </b></p>
            <p><b>Loan purpose : </b> <span class="c-deep-purple-500">{{ application.loan_purpose ? application.loan_purpose.name : '' }}</span></p>
            <p><b>Loan amount : </b> <span class="badge badge-info">{{ application.loan_amount }}</span></p>
            <p><b>Apply Date : </b> <span>{{ application.created_at }}</span></p>
            <p><b>Loan term : </b> <span class="badge badge-warning">{{ application.loan_term }} Month </span></p>
            <p><b>Status : </b> <span class="badge badge-danger">{{ application.status }} </span></p>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-20">
            <p class="c-grey-900"><b>
                <i class="c-orange-500 ti-layout-list-thumb"></i>
                <span class="mL-5">Customer info</span>
            </b></p>
            <p><b>Name : </b> <span>{{ customer.full_name }} </span></p>
            <p><b>Email : </b> <span>{{ customer.user ? customer.user.email:'--' }} </span></p>
            <p><b>Phone : </b> <span>{{ application.contact ? application.contact.full_number : '--' }} </span></p>
            <p><b>Birth Date : </b> <span>{{ customer.readable_dob }} </span></p>
            <p><b>Gender : </b> <span>{{ customer.gender }} </span></p>
            <p><b>Marital Status : </b> <span>{{ customer.marital_status }} </span></p>
            <p><b>Month of self employment : </b> <span>{{ customer.months_as_self_employed }} </span></p>
            <p><b>Total dependent : </b> <span>{{ customer.total_dependent }} </span></p>
            <p><b>Member since : </b> <span>{{ customer.created_at }} </span></p>
        </div>
    </div>
    </template>
    <loader v-else></loader>
</div>
</template>

<script>
    import client   from '@/client'
    import Loader   from '@comp/lib/Loader'
    import mixins   from '@/mixins'

    export default {
        name: "application-info",
        props: ['applicationID'],
        components: { Loader },
        mixins: [mixins],
        computed: {
            customer() {
                if (_.isEmpty(this.application) || _.isEmpty(this.application.customer)) return;
                return this.application.customer;
            }
        },
        data() {
            return {
                application: {},
                loader: true,
            }
        },
        mounted() {
            this.fetchApplication();
        },
        methods: {
            fetchApplication() {
                client.get(route + '/' + this.applicationID)
                    .then(response => {
                        if (response.status === 200) {
                            this.application = response.data
                            this.loader = false
                        }
                    })
            },
        }
    }
</script>

<style scoped>

</style>
