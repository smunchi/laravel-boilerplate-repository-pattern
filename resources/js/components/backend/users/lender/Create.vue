<template>
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-15">
        <div class="row">
            <h4 class="col-sm-6 c-grey-900 mB-20">
                <i class="c-indigo-500 ti-money mR-15"></i>New Lender
            </h4>
            <div class="col-sm-6">
                <div class="btn-group pull-right">
                    <a href="#" onclick="window.history.back()" class="btn btn-primary">
                        <i class="ti-angle-left"></i></a>
                </div>
            </div>
        </div>
        <lender-form></lender-form>
    </div>
</template>

<script>
    import LenderForm from './Form'
    export default {
        name: "lender-create",
        components: {
            LenderForm
        }
    }
</script>

<style scoped>

</style>
