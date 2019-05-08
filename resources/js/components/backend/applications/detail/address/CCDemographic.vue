<template>
    <div class="bgc-white bd bdrs-3 p-15 mB-15 mT-15">
        <p class="c-grey-900 mB-20">
            <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
            <b>Call Credit Demographic Details</b>
        </p>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="demographic in ccDemographic">
                    <td>{{demographic.detail}}</td>
                    <td>{{demographic.data}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'cc-demographic',
        props: ['ccDemographic'],
    }
</script>