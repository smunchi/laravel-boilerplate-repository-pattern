<template>
    <div>
        <p class="c-grey-900 mB-20">
            <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
            <b>Contact information </b>
        </p>
        <div class="row">
            <div class="col-sm-7">
                <p><b>Email : </b> {{customer.email}}</p>
                <p v-if="contacts.length > 0"
                   v-for="contact in contacts">
                    <b>{{contact.type}} phone : </b> {{ contact.full_number }}
                </p>
            </div>
            <div class="col-sm-5">
                <p>
                    <b>Contact by email : </b>
                    <span v-if="comman.by_email" class="badge badge-success">Yes</span>
                    <span v-else class="badge badge-warning">No</span>
                </p>
                <p>
                    <b>Contact by phone : </b>
                    <span v-if="comman.by_phone" class="badge badge-success">Yes</span>
                    <span v-else class="badge badge-warning">No</span>
                </p>
                <p>
                    <b>Contact by SMS : </b>
                    <span v-if="comman.by_sms" class="badge badge-success">Yes</span>
                    <span v-else class="badge badge-warning">No</span>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "customer-contact-info",
        props: ['customer'],
        computed: {
            comman() {
                return this.customer.comms_preference;
            },
            contacts() {
                console.log(this.customer.contacts)
                return this.customer.contacts;
            }
        }
    }
</script>

<style scoped>

</style>