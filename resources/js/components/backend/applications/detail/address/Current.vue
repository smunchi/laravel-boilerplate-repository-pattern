<template>
    <div class="bgc-white bd bdrs-3 p-15 mB-15 mT-15">
        <p class="c-grey-900"><b>
            <i class="c-orange-500 ti-layout-list-thumb"></i>
            <span class="mL-5">Current address detail</span>
        </b></p>
        <div v-if="primary">
            <p v-if="primary.house_name"><b>{{primary.house_name}}</b></p>
            <p><b>Location :</b>
                <span v-if="primary.house_no"> #House No : {{primary.house_no}} </span>
                <span v-if="primary.road_no"> #Road No : {{primary.road_no}} </span>
                <span v-if="primary.road_name"> #Road Name : {{primary.road_name}} </span>
                <span v-if="primary.flat"> #Flat No : {{primary.flat}} </span>
            </p>
            <p v-if="primary.town"><b>Town : </b>{{primary.town}}</p>
            <p v-if="primary.city"><b>City : </b>{{primary.city}}</p>
            <p v-if="primary.county"><b>Country : </b>{{primary.county}}</p>
            <p v-if="primary.postcode"><b>PostCode : </b>{{primary.postcode}}</p>
            <p v-if="primary.months_at_address"><b>stay : </b>{{primary.months_at_address}} <small>(Month)</small></p>
            <p v-if="primary.residence_status"><b>Residence status : </b>{{primary.residence_status}}</p>
        </div>
        <div v-else>No current address</div>
    </div>
</template>
<script>
    export default {
        name: 'current-address',
        props: {
            primary: {
                required: true
            }
        }
    }
</script>