<template>
    <div>
        <p class="c-grey-900 mT-20"><b>
            <i class="c-orange-500 ti-layout-list-thumb"></i>
            <span class="mL-5">Lender offers</span>
        </b></p>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th v-for="column in columns">{{ column }}</th>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import {offers} from '@/static/config/formColumn'
    export default {
        name: "offers-info",
        data() {
            return {
                columns: offers.columns
            }
        }
    }
</script>

<style scoped>

</style>