<template>
    <div>
        <loader v-if="load"></loader>
        <template v-else>
        <div class="row">
            <div class="col-sm-4">
                <current-address :primary="address.primary"></current-address>
            </div>
            <div class="col-sm-8">
                <previous-address :previousAddress="address.previous"></previous-address>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <cc-address :ccAddress="address.ccAddress"></cc-address>
            </div>
            <div class="col-sm-6">
                <cc-demographic :ccDemographic="address.ccDemographic"></cc-demographic>
            </div>
        </div>

        <electroral :electrorals="address.ccEelectoral"></electroral>
        </template>
    </div>
</template>

<script>
    import client           from '@/client'
    import CurrentAddress   from './address/Current'
    import PreviousAddress  from "./address/Previous"
    import CcAddress        from "./address/CCAddress"
    import CcDemographic    from './address/CCDemographic'
    import Electroral       from './address/Electroral'
    import Loader           from '@comp/lib/Loader'

    export default {
        name: "address-info",
        components: {
            PreviousAddress, CurrentAddress, CcAddress, CcDemographic, Electroral, Loader
        },
        props: ['applicationID'],
        data() {
            return {
                address: {},
                load: true
            }
        },
        mounted() {
            this.fetchAddress()
        },
        methods: {
            fetchAddress() {
                client.get(route + '/' + this.applicationID + '/address')
                    .then( response => {
                        this.load = false
                        this.address = response.data.data
                    })
            }
        }
    }
</script>

<style scoped>

</style>