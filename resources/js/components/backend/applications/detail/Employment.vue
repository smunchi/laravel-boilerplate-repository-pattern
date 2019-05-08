<template>
    <div>
        <p class="c-grey-900 mT-20 mB-20">
            <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
            <b>User employment info</b>
        </p>
        <div v-if="!loader" class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th>Job title</th>
                    <th>Employer name</th>
                    <th>Payment method</th>
                    <th>Payment type</th>
                </tr>
                </thead>
                <tbody v-if="employments.length > 0">
                <tr v-for="(employment, index) in employments">
                    <td>{{index + 1}}</td>
                    <td>{{ employment.job_title }}</td>
                    <td>{{ employment.employer_name }}</td>
                    <td>{{ employment.payment_method }}</td>
                    <td>{{ employment.payment_frequency }}</td>
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
        name: "employment-info",
        props: ['applicationID'],
        components: { Loader },
        data() {
            return {
                employments: [],
                loader: true,
            }
        },
        mounted() {
            this.fetchEmployment()
        },
        methods: {
            fetchEmployment() {
                client.get(route + '/' + this.applicationID + '/employments')
                    .then(response => {
                        this.employments = response.data
                        this.loader = false
                    })
            }
        }
    }
</script>

<style scoped>

</style>