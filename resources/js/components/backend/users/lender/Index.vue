<template>
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-15">
        <div class="row">
            <h4 class="col-sm-6 c-grey-900 mB-20"><i class="c-indigo-500 ti-money mR-15"></i>Lenders</h4>
            <div class="col-sm-6">
                <div class="btn-group pull-right">
                    <a :href="webRoute + '/create'"
                       class="btn btn-primary">New Lender</a>
                </div>
            </div>
        </div>
        <lenders></lenders>
    </div>
</template>

<script>
    import Lenders from './Lenders'
    export default {
        name: "lender-page",
        components: {
            Lenders
        },
        data() {
            return {
                webRoute: webRoute
            }
        }
    }
</script>

<style scoped>

</style>