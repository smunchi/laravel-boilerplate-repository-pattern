<template>
    <div class="row mT-15">
        <div class="col-sm-3">
            <div class="layers bd bgc-white p-20">
                <h6>
                    <span class="c-indigo-500 bgc-indigo-50 pX-15 pY-5">{{lenders}}</span>
                    <span>Lenders</span>
                </h6>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="layers bd bgc-white p-20">
                <h6>
                    <span class="c-deep-purple-500 bgc-deep-purple-50 pX-15 pY-5">{{customers}}</span>
                    <span>Customers</span>
                </h6>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="layers bd bgc-white p-20">
                <h6>
                    <span class="c-orange-500 bgc-orange-50 pX-15 pY-5">{{applications}}</span>
                    <span>Applications</span>
                </h6>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="layers bd bgc-white p-20">
                <h6>
                    <span class="c-green-500 bgc-green-50 pX-15 pY-5">{{approved}}</span>
                    <span>Approved</span>
                </h6>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "top-info",
        data() {
            return {
                lenders: 20,
                customers: 34567,
                applications: 45674,
                approved: 34567
            }
        }
    }
</script>

<style scoped>

</style>