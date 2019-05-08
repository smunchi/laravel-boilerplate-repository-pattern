<template>
    <div class="table-responsive">
        <template v-if="!loader">
            <table v-if="applications.length > 0" class="table table-striped">
                <thead>
                <tr>
                    <th v-for="column in columns">{{ column }}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(application,index) in applications">
                    <td>{{ parseInt(index) + 1 }}</td>
                    <td>
                        <a :href="webRoute + '/' + application.id" class="text-primary">
                            {{ application.customer ? application.customer.full_name : '-' }}
                        </a>
                    </td>
                    <td>{{ application.customer ? application.customer.user.email : '-' }}</td>
                    <td><span data-toggle="tooltip" :title="application.created_at">{{ application.human_time }}</span></td>
                    <td><span class="badge badge-dark">{{ application.status }}</span></td>
                    <td>{{ application.contact ? application.contact.full_number : '-' }}</td>
                    <td>{{ application.loan_amount }}</td>
                    <td>{{ application.loan_purpose ? application.loan_purpose.name : '' }}</td>
                    <td>
                        <a :href="webRoute + '/' + application.id" class="mL-5 mR-5 text-primary"
                           data-toggle="tooltip"
                           title="View">
                            <i class="ti-eye"></i>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <div v-else class="text-dark">No Application post yet !!</div>
        </template>
        <template v-else>
            <Loader></Loader>
        </template>
    </div>
</template>
<script>
    import Loader from '@comp/lib/Loader'
    import {applications} from "@/static/config/formColumn"
    import client from '@/client'
    export default {
        name: 'applications',
        components: {
            Loader,
        },
        data() {
            return {
                loader: true,
                applications: [],
                columns: applications.columns,
                webRoute: webRoute
            }
        },
        mounted() {
            this.fetchApplications()
        },
        methods: {
            fetchApplications() {
                client.get(route)
                    .then(response => {
                        if (response.status === 200) {
                            this.loader = false
                            this.applications = response.data
                        }
                    })
            },
        },
        updated() {
            $('[data-toggle="tooltip"]').tooltip();
        }

    }
</script>
