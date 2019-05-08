<template>
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-15">
        <div class="row">
            <h4 class="col-sm-6 c-grey-900 mB-20">
                <i class="c-brown-500 ti-id-badge mR-15"></i>
                Applications
            </h4>
            <div class="col-sm-6">
            </div>
        </div>
        <applications></applications>
    </div>
</template>
<script>
    import Applications from './Applications'
    export default {
        name: 'application-page',
        components: {
            Applications
        }

    }
</script>