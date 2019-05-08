<template>
    <div>
        <ul class="nav nav-tabs mT-20">
            <li class="nav-item">
                <a  @click.prevent="currentCCTab = 'UserSummery'"
                    class="nav-link" :class="{active: currentCCTab === 'UserSummery'}"
                    href="#">Summery</a>
            </li>
            <li class="nav-item">
                <a @click.prevent="currentCCTab = 'UserShare'"
                   class="nav-link" :class="{active: currentCCTab === 'UserShare'}"
                   href="#">Share Report</a>
            </li>
            <li class="nav-item">
                <a @click.prevent="currentCCTab = 'UserBAI'"
                   class="nav-link" :class="{active: currentCCTab === 'UserBAI'}"
                   href="#">BAI's Report</a>
            </li>
        </ul>
        <loader v-if="loader"></loader>
        <component v-else :is="currentCCTab" :cc="cc"></component>
    </div>
</template>

<script>
    import client from '@/client'
    import UserSummery from './callCreditTab/Summery'
    import UserShare from './callCreditTab/Share'
    import UserBAI from './callCreditTab/BAI'
    import Loader from '@comp/lib/Loader'
    export default {
        name: "call-credit-info",
        props: ['applicationID'],
        components: {
            UserSummery, UserShare, UserBAI, Loader
        },
        computed: {
            cc() {
                return {
                    userDetail: this.userDetail,
                    userDemographic: this.userDemographic,
                    userBAI: this.userBAI,
                    userCCJ: this.userCCJ,
                    userShare: this.userShare,
                }
            }
        },
        data() {
            return {
                userDetail: [],
                userDemographic: [],
                userBAI: [],
                userCCJ: [],
                userShare: [],
                currentCCTab: 'UserSummery',
                loader: true
            }
        },
        mounted() {
            this.fetchCallCreditDetail();
        },
        methods: {
            fetchCallCreditDetail() {
                client.get(route + '/' + this.applicationID + '/call_credit')
                    .then(response => {
                        this.userDetail = response.data.data.user_detail
                        this.userCCJ = response.data.data.user_ccj
                        this.userDemographic = response.data.data.user_demographic
                        this.userBAI = response.data.data.user_bai
                        this.userShare = response.data.data.user_shareloader
                        this.loader = false
                    })
            }
        }
    }
</script>

<style scoped>

</style>