<template>
    <div class="bgc-white bd bdrs-3 p-15 mB-15 mT-15">
        <p class="c-grey-900"><b>
            <i class="c-orange-500 ti-layout-list-thumb"></i>
            <span class="mL-5">Previous address detail</span>
        </b></p>
        <div v-if="previousAddress" class="row">
            <div v-for="(previous, index) in previousAddress"
                 class="col-sm-6">
                <div class="bgc-white bd bdrs-3 p-15">
                    <p v-if="previous.house_name">
                        <span class="badge badge-dark mR-10">{{index + 1}}</span>
                        <b>{{previous.house_name}}</b></p>
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
        </div>
        <div v-else>No previous address</div>
    </div>
</template>
<script>
    export default {
        name: 'previous-address',
        props: ['previousAddress'],

    }
</script>