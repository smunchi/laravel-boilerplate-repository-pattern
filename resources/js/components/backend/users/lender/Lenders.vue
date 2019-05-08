<template>
    <div class="table-responsive">
        <template v-if="!loader">
            <table v-if="lenders.length > 0" class="table table-striped">
                <thead>
                <tr>
                    <th v-for="column in columns">{{ column }}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(lender, index) in lenders">
                    <td>{{ parseInt(index) + 1 }}</td>
                    <td><img v-if="lender.logo" class="img-fluid" :src="lender.logo.src" :alt="lender.name" width="50"></td>
                    <td>{{ lender.name }}</td>
                    <td>{{ lender.user?lender.user.email:lender.contact_email }}</td>
                    <td>{{ lender.website?lender.website.substring(0,20):'' }}</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox"
                                   :checked="Boolean(lender.user.is_active)"
                                   @click.prevent="toggleLenderActive(lender)"
                                   class="custom-control-input" :id="'lenderStatus'+lender.id">
                            <label class="custom-control-label" :for="'lenderStatus'+lender.id"
                                   v-text="Boolean(lender.user.is_active) ? 'Active':'Off'"></label>
                        </div>
                    </td>
                    <td>
                        <a :href="webRoute + '/' + lender.id" class="mL-5 mR-5 text-primary"
                           data-toggle="tooltip"
                           title="Detail">
                            <i class="ti-eye"></i></a>
                        <a :href="'lenders/' + lender.id + '/edit'" class="mL-5 mR-5 text-primary"
                           data-toggle="tooltip"
                           title="Edit">
                            <i class="ti-pencil-alt"></i></a>
                        <a href="#" class="mL-5 mR-5 text-danger"
                           data-toggle="tooltip"
                           @click.prevent="deleteLender(lender)"
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
    import {lenders} from "@/static/config/formColumn"

    export default {
        name: "lenders",
        components: {
            Loader,
        },
        data() {
            return {
                lenders: [],
                columns: lenders.columns,
                loader: true,
                webRoute: webRoute
            }
        },
        mounted() {
            this.fetchLenders()
        },
        methods: {
            fetchLenders() {
                this.loader = true
                client.get(route)
                    .then( response => {
                        this.lenders = response.data
                        this.loader = false
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
            },
            toggleLenderActive(lender) {
                let self = this
                alertify.confirm('Lender status change','Are you sure?', () => {
                    client.put(route + '/' + lender.id + '/active')
                        .then(respone => {
                            alertify.success(respone.data.message)
                            let lenders = self.lenders
                            self.lenders = lenders.map( obj => {
                                if (obj.id === lender.id){
                                    obj.user.is_active = !obj.user.is_active
                                }
                                return obj;
                            })
                        })
                },()=>{});
            },
        },
        updated() {
            $('[data-toggle="tooltip"]').tooltip();
        }
    }
</script>

<style scoped>

</style>