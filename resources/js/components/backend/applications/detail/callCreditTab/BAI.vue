<template>
    <div class="">
        <p class="c-grey-900 mT-20"><b>
            <i class="c-orange-500 ti-layout-list-thumb"></i>
            <span class="mL-5">Customer call credit BAIs report</span>
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
                <tr v-for="bai in cc.userBAI">
                    <td v-if="bai.description">{{bai.description}} <small><b>({{bai.name}})</b></small> </td>
                    <td v-else>{{ bai.name }}</td>
                    <td><span>{{bai.value?bai.value:'--'}}</span></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'bai-report',
        props: ['cc']
    }
</script>