<template>
    <div class="table-responsive">
        <template v-if="!loader" >
            <table v-if="customers.length > 0" class="table table-striped">
                <thead>
                <tr>
                    <th v-for="column in columns">{{ column }}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(customer, index) in customers">
                    <td>{{ parseInt(index) + 1 }}</td>
                    <td><a :href="'customers/' + customer.id">{{ customer.full_name }}</a></td>
                    <td>{{ customer.user ? customer.user.email : '-' }}</td>
                    <td>{{ customer.gender }}</td>
                    <td>{{ customer.readable_dob }}</td>
                    <td>-</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox"
                                   :checked="Boolean(customer.user.is_active)"
                                   @click.prevent="toggleCustomerActive(customer.id)"
                                   class="custom-control-input" :id="'customerStatus'+customer.id">
                            <label class="custom-control-label" :for="'customerStatus'+customer.id"
                                   v-text="Boolean(customer.user.is_active) ? 'Active':'Off'"></label>
                        </div>
                    </td>
                    <td>
                        <a :href="webRoute + '/' + customer.id" class="mL-5 mR-5 text-primary"
                           data-toggle="tooltip"
                           title="Detail">
                            <i class="ti-eye"></i></a>
                        <a href="#" class="mL-5 mR-5 text-danger"
                           data-toggle="tooltip"
                           @click.prevent="deleteCustomer(customer)"
                           title="Delete">
                            <i class="ti-trash"></i></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </template>
        <template v-else>
            <Loader></Loader>
        </template>
    </div>
</template>

<script>
    import client from '@/client'
    import alertify from 'alertifyjs'
    import Loader from '@comp/lib/Loader'
    import {customers} from "@/static/config/formColumn"
    export default {
        name: "customers",
        components: {
            Loader
        },
        data() {
            return {
                loader: true,
                columns: customers.columns,
                customers: [],
                webRoute: webRoute
            }
        },
        mounted() {
            this.fetchCustomers();
        },
        methods: {
            fetchCustomers() {
                client.get(route)
                    .then(response => {
                        if (response.status === 200) {
                            this.loader = false;
                            this.customers = response.data
                        }
                    })
            },
            deleteCustomer(customer) {
                alertify.confirm('Customer delete', 'Are you sure?', () => {
                    client.delete(route + '/' + customer.id)
                        .then(respone => {
                            alertify.success(respone.data.message)
                            this.fetchCustomers();
                        })
                }, () => {});
            },
            toggleCustomerActive(customerID) {
                let self = this
                alertify.confirm('Customer status change','Are you sure?', () => {
                    client.put(route + '/' + customerID + '/active')
                        .then(respone => {
                            alertify.success(respone.data.message)
                            let customers = self.customers
                            self.customers = customers.map( obj => {
                                if (obj.id === customerID){
                                    obj.user.is_active = !obj.user.is_active
                                }
                                return obj;
                            })
                        })
                },()=>{});
            }
        },
        updated() {
            $('[data-toggle="tooltip"]').tooltip();
        }
    }
</script>

<style scoped>

</style>
