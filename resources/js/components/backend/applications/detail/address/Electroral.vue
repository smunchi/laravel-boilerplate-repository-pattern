<template>
    <div>
        <p class="c-grey-900"><b>
            <i class="c-orange-500 ti-layout-list-thumb"></i>
            <span class="mL-5">Call Credit electoral eoll details</span>
        </b></p>
        <div v-for="(electroral, index) in electrorals" class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Resident Name</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Option status</th>
                        <th>Roll status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ electroral.ResidentName }}</td>
                        <td>{{ electroral.ERHistory_StartDate }}</td>
                        <td>{{ electroral.ERHistory_EndDate }}</td>
                        <td>{{ electroral.ERHistory_OptOut }}</td>
                        <td>{{ electroral.ERHistory_RollingRoll }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="bgc-deep-purple-50">{{ electroral.PAFValid }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'electroral',
        props: ['electrorals'],
    }
</script>
