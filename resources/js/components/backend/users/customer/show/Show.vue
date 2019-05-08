<template>
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-15">
        <div class="row">
            <h4 class="col-sm-6 c-grey-900 mB-20">
                <i class="c-deep-purple-500 ti-user mR-15"></i>Customer Details
            </h4>
            <div class="col-sm-6 text-right">
                <div class="btn-group btn-group-sm">
                    <a href="#" onclick="window.history.back()" class="btn btn-dark">
                        <i class="ti-angle-left"></i></a>
                    <a href="#" @click.prevent="deleteCustomer(customer)" class="btn btn-danger">
                        <i class="ti-trash"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-9">
                <template v-if="!customerLoader">
                    <personal :personal="customer"></personal>
                    <div class="">
                            <ul class="nav nav-tabs mB-15">
                                <li class="nav-item">
                                    <a @click.prevent="currentTabComponent = 'Contact'" :class="{active:currentTabComponent === 'Contact'}" class="nav-link" href="#"><b>Contact</b></a>
                                </li>
                                <li class="nav-item">
                                    <a @click.prevent="currentTabComponent = 'Address'" :class="{active:currentTabComponent === 'Address'}" class="nav-link" href="#"><b>Address</b></a>
                                </li>
                                <li class="nav-item">
                                    <a @click.prevent="currentTabComponent = 'Bank'" :class="{active:currentTabComponent === 'Bank'}" class="nav-link" href="#"><b>Bank</b></a>
                                </li>
                            </ul>
                            <keep-alive>
                                <component :is="currentTabComponent" :customer="customer.user_profile"></component>
                            </keep-alive>
                    </div>
                </template>
                <template v-else>
                    <loader></loader>
                </template>
            </div>
            <div class="col-sm-3">
                <p class="c-grey-900 mB-20">
                    <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
                    <b>Applications Information </b>
                </p>
            </div>
        </div>

    </div>
</template>

<script>
    import Personal from './Personal'
    import Bank from './Bank'
    import Address from './Address'
    import Contact from './Contact'
    import client from '@/client'
    import Loader from '@comp/lib/Loader'
    import alertify from 'alertifyjs'
    export default {
        name: 'customer-show',
        props: {
            customerid: {
                required: true
            }
        },
        components: {
            Personal, Bank, Address, Contact, Loader
        },
        data() {
            return {
                customer: {},
                customerLoader: true,
                currentTabComponent: 'Contact'
            }
        },
        mounted() {
            this.fetchPersonalInfo();
        },
        methods: {
            fetchPersonalInfo() {
                client.get(route + '/' + this.customerid)
                    .then(response => {
                        if (response.status === 200) {
                            this.customer = response.data
                            this.customerLoader = false
                        }
                    })
            },
            deleteCustomer(customer) {
                alertify.confirm('Customer delete', 'Are you sure?', () => {
                    client.delete(route + '/' + this.customerid)
                        .then(respone => {
                            alertify.success(respone.data.message)
                            window.location.replace(route)
                        })
                }, () => {});
            },
        }
    }
</script>