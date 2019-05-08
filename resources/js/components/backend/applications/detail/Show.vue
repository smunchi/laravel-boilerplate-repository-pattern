<template>
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mT-15">
        <div class="row">
            <h4 class="col-sm-6 c-grey-900 mB-20">
                <i class="c-deep-purple-500 ti-id-badge mR-15"></i>Application Details
            </h4>
            <div class="col-sm-6 text-right">
                <div class="btn-group btn-group-sm">
                    <a href="#" onclick="window.history.back()" class="btn btn-dark">
                        <i class="ti-angle-left"></i></a>
                    <a href="#" @click.prevent="deleteApplication(application)" class="btn btn-danger">
                        <i class="ti-trash"></i>
                    </a>
                </div>
            </div>
        </div>

        <div>
            <ul class="nav nav-pills grayBg">
                <li class="nav-item">
                    <a class="nav-link" href="#"
                       @click.prevent="currentTabComponent = 'ApplicationInfo'"
                       :class="{active: currentTabComponent === 'ApplicationInfo'}"
                    >Application info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"
                       @click.prevent="currentTabComponent= 'OfferInfo'"
                       :class="{active: currentTabComponent === 'OfferInfo'}"
                    >Offers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"
                       @click.prevent="currentTabComponent = 'CallCreditInfo'"
                       :class="{active: currentTabComponent === 'CallCreditInfo'}"
                    >Call Credit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"
                       @click.prevent="currentTabComponent = 'AddressInfo'"
                       :class="{active: currentTabComponent === 'AddressInfo'}"
                    >Address</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"
                       @click.prevent="currentTabComponent = 'EmploymentInfo'"
                       :class="{active: currentTabComponent === 'EmploymentInfo'}"
                    >Employment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"
                       @click.prevent="currentTabComponent='BankInfo'"
                       :class="{active: currentTabComponent === 'BankInfo'}"
                    >Bank Report</a>
                </li>
            </ul>
            <components :applicationID="applicationid" :is="currentTabComponent"></components>
        </div>

    </div>
</template>

<script>
    import ApplicationInfo  from './Application'
    import OfferInfo        from './Offers'
    import CallCreditInfo   from './CallCredit'
    import EmploymentInfo   from './Employment'
    import BankInfo         from './BankInfo'
    import AddressInfo      from './Address'
    export default {
        name: 'application-show',
        props: ['applicationid'],
        data() {
            return {
                currentTabComponent: 'ApplicationInfo'
            }
        },
        components: {
            ApplicationInfo, OfferInfo, CallCreditInfo,
            BankInfo, EmploymentInfo, AddressInfo
        }
    }
</script>
<style scoped>
    .grayBg {background-color: #e2e2e2; }
</style>