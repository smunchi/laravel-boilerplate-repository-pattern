<template>
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-15">
        <div class="row">
            <h4 class="col-sm-6 c-grey-900 mB-20">
                <i class="c-deep-purple-500 ti-user mR-15"></i>Customers
            </h4>
            <div class="col-sm-6">
            </div>
        </div>
        <customers></customers>
    </div>
</template>

<script>
    import Customers from './Customers'

    export default {
        name: "customer-page",
        components: {
            Customers,
        }
    }
</script>

<style scoped>

</style>