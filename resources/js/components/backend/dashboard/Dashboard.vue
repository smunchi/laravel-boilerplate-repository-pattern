<template>
    <div>
        <top-info></top-info>
        <div class="row">
            <div class="col-sm-6">
                <line-chart></line-chart>
            </div>
            <div class="col-sm-6">
                <bar-chart></bar-chart>
            </div>
        </div>
    </div>
</template>

<script>
    import TopInfo from './TopInfo'
    import LineChart from './LineChart'
    import BarChart from './BarChart'
    export default {
        name: "admin-dashboard",
        components: {
            LineChart, TopInfo, BarChart
        }
    }
</script>

<style scoped>

</style>