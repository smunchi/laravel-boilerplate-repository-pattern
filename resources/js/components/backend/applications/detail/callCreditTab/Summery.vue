<template>
    <div class="row">
        <div class="col-sm-7">
            <div class="bgc-white bd bdrs-3 mT-20 p-15">
                <p class="c-grey-900"><b>
                    <i class="c-orange-500 ti-layout-list-thumb"></i>
                    <span class="mL-5">Customer call credit summary</span>
                </b></p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Description</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="detail in cc.userDetail">
                            <td v-if="detail.description">{{detail.description}} <small><b>({{detail.name}})</b></small> </td>
                            <td v-else>{{ detail.name }}</td>
                            <td><span :class="{'badge badge-info': detail.name === 'score'}">{{detail.value?detail.value:'--'}}</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="bgc-white bd bdrs-3 mT-20 p-15">
                <p class="c-grey-900"><b>
                    <i class="c-orange-500 ti-layout-list-thumb"></i>
                    <span class="mL-5">Customer CCJ output</span>
                </b></p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Detail</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="ccj in cc.userCCJ">
                            <td>{{ ccj.description ? ccj.description : ccj.name }}</td>
                            <td>{{ ccj.value ? ccj.value : '--' }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bgc-white bd bdrs-3 mT-20 p-15">
                <p class="c-grey-900"><b>
                    <i class="c-orange-500 ti-layout-list-thumb"></i>
                    <span class="mL-5">Customer demographics detail</span>
                </b></p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Detail</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="demographic in cc.userDemographic">
                            <td>{{ demographic.description ? demographic.description : demographic.name }}</td>
                            <td>{{ demographic.value ? demographic.value : '--' }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "cc-summery",
        props: ['cc']
    }
</script>

<style scoped>

</style>