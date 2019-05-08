<template>
    <div>
        <div v-for="(shares, index) in cc.userShare" class="">
            <hr v-if="index !== 0">
            <p class="c-grey-900 mT-20"><b>
                <span class="badge badge-primary">{{index + 1}}</span>
                <span class="mL-5">Customer call credit share report</span>
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
                    <tr v-for="share in shares.share_info">
                        <td v-if="share.description">{{share.description}} <small><b>({{share.name}})</b></small> </td>
                        <td v-else>{{ share.name }}</td>
                        <td><span :class="{'badge badge-warning': share.name === 'Current_Status'}">{{share.value?share.value:'--'}}</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Balance</th>
                        <td v-for="balance in shares.balance">{{balance.balance}}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td v-for="balance in shares.balance">{{balance.date}}</td>
                    </tr>
                    <tr>
                        <th>Limit</th>
                        <td v-for="balance in shares.balance">{{balance.limit}}</td>
                    </tr>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Account</th>
                        <td v-for="account in shares.account">{{account.ps}}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td v-for="account in shares.account">{{account.as}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "share-report",
        props: ['cc']
    }
</script>

<style scoped>

</style>