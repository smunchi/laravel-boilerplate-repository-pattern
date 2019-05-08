<template>
    <div>
        <p class="c-grey-900 mT-20 mB-20">
            <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
            <b>User bank info</b>
        </p>
        <div v-if="!loader" class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Account No</th>
                        <th>Sort code</th>
                        <th>Card type</th>
                        <th>Stay <small>(Month)</small></th>
                        <th>Last update</th>
                    </tr>
                </thead>
                <tbody v-if="banks.length > 0">
                    <tr v-for="(bank, index) in banks">
                        <td>{{index + 1}}</td>
                        <td>{{ bank.account_no }}</td>
                        <td>{{ bank.sort_code }}</td>
                        <td>{{ bank.primary_debit_card_type }}</td>
                        <td>{{ bank.months_at_bank }}</td>
                        <td>{{ bank.updated_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <loader v-else></loader>
    </div>
</template>

<script>
    import client from '@/client'
    import Loader from '@comp/lib/Loader'
    export default {
        name: "bank-info",
        props: ['applicationID'],
        components: {Loader},
        data() {
            return {
                banks: [],
                loader: true
            }
        },
        mounted() {
            this.fetchBanks()
        },
        methods: {
            fetchBanks() {
                client.get(route + '/' + this.applicationID + '/banks')
                    .then(response => {
                        this.banks = response.data.data
                        this.loader = false
                    })
            }
        }
    }
</script>

<style scoped>

</style>