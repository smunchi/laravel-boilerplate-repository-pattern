<template>
    <div>
        <p class="c-grey-900 mB-20">
            <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
            <b>Address information </b>
        </p>
        <div v-if="current" class="border-bottom mB-15">
            <p class="c-grey-900"><b>Current Address : </b></p>
            <p v-if="current.house_name"><b>{{current.house_name}}</b></p>
            <p><b>Location :</b>
                <span v-if="current.house_no"> #House No : {{current.house_no}} </span>
                <span v-if="current.road_no"> #Road No : {{current.road_no}} </span>
                <span v-if="current.road_name"> #Road Name : {{current.road_name}} </span>
                <span v-if="current.flat"> #Flat No : {{current.flat}} </span>
            </p>
            <p v-if="current.town"><b>Town : </b>{{current.town}}</p>
            <p v-if="current.city"><b>City : </b>{{current.city}}</p>
            <p v-if="current.county"><b>Country : </b>{{current.county}}</p>
            <p v-if="current.postcode"><b>PostCode : </b>{{current.postcode}}</p>
            <p v-if="current.months_at_address"><b>stay : </b>{{current.months_at_address}} <small>(Month)</small></p>
            <p v-if="current.residence_status"><b>Residence status : </b>{{current.residence_status}}</p>
        </div>
        <div v-if="previous">
            <p class="c-grey-900"><b>Previous Address : </b></p>
            <p v-if="previous.house_name"><b>{{previous.house_name}}</b></p>
            <p><b>Location :</b>
                <span v-if="previous.house_no"> #House No : {{previous.house_no}} </span>
                <span v-if="previous.road_no"> #Road No : {{previous.road_no}} </span>
                <span v-if="previous.road_name"> #Road Name : {{previous.road_name}} </span>
                <span v-if="previous.flat"> #Flat No : {{previous.flat}} </span>
            </p>
            <p v-if="previous.town"><b>Town : </b>{{previous.town}}</p>
            <p v-if="previous.city"><b>City : </b>{{previous.city}}</p>
            <p v-if="previous.county"><b>Country : </b>{{previous.county}}</p>
            <p v-if="previous.postcode"><b>PostCode : </b>{{previous.postcode}}</p>
            <p v-if="previous.months_at_address"><b>stay : </b>{{previous.months_at_address}} <small>(Month)</small></p>
            <p v-if="previous.residence_status"><b>Residence status : </b>{{previous.residence_status}}</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "customer-address-info",
        props: ['customer'],
        computed: {
            current() {
                if (this.customer.addresses) {
                    return this.customer.addresses.filter( obj => {return obj.type === 'current'})[0]
                }
                return;
            },
            previous() {
                if (this.customer.addresses) {
                    return this.customer.addresses.filter( obj => {return obj.type === 'previous'})[0]
                }
                return;
            }
        }
    }
</script>

<style scoped>

</style>