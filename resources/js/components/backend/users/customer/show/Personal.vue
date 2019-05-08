<template>
    <div class="mB-15  bd bdrs-3 p-15">
        <p class="c-grey-900 mB-20">
            <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
            <b>Personal information </b>
        </p>
        <p><b>Name : {{ personal.full_name }}</b></p>

        <div class="row">
            <p class="col-sm-6"><b>Date of birth :</b> {{ personal.dob }}</p>
            <p class="col-sm-6"><b>Status :</b>
                <span class="badge badge-success" v-if="isActive(personal)">Active</span>
                <span class="badge badge-danger" v-else>Blocked</span>
            </p>
        </div>
        <div class="row">
            <p class="col-sm-6"><b>Gender :</b> {{ personal.gender }}</p>
            <p class="col-sm-6"><b>Marital Status :</b> {{ personal.marital_status }}</p>
        </div>
        <div class="row">
            <p class="col-sm-6"><b>Total dependent :</b> {{ personal.total_dependent }}</p>
            <p class="col-sm-6"><b>Self employed :</b> {{ personal.months_as_self_employed?months_as_self_employed:0 }} <small>(Month)</small></p>
        </div>
        <div class="row">
            <p class="col-sm-6"><b>Joined at :</b> {{ personal.created_at }} </p>
            <p class="col-sm-6"><b>Hear from :</b> {{ personal.hear_from }}</p>
        </div>

    </div>
</template>

<script>
    export default {
        name: "personal",
        props: {
            personal: {
                type: Object,
                required: true
            }
        },
        methods: {
            generateFullName(customer) {
                let name = '';
                name += customer.title ? customer.title + ' ' : ''
                name += customer.first_name ? customer.first_name + ' ' : ''
                name += customer.middle_name ? customer.middle_name + ' ' : ''
                name += customer.last_name ? customer.last_name + ' ' : ''
                return name;
            },
            isActive(customer) {
                if (customer.user_profile) {
                    return customer.user_profile.is_active;
                }
                return false;
            }
        }
    }
</script>

<style scoped>

</style>