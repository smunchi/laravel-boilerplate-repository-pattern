<template>
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-15">
        <div class="row">
            <h4 class="col-sm-6 c-grey-900 mB-20"><i class="c-deep-orange-500 ti-archive mR-15"></i>Risk Buckets</h4>
            <div class="col-sm-6">
            </div>
        </div>
        <lender-buckets></lender-buckets>
    </div>
</template>

<script>
    import LenderBuckets from './Buckets'
    export default {
        name: 'lender-bucket-page',
        components: {
            LenderBuckets,
        }
    }
</script>