<template>
    <div class="pT-10">
        <table v-if="rules.length > 0 && apiFields.length > 0" class="table table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Field Name</th>
                    <th>Operator</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(rule, index) in rules">
                    <td>{{parseInt(index) + 1}}</td>
                    <td>{{ fetchApiFieldDetail(rule.field_name) }}</td>
                    <td>{{rule.operator}}</td>
                    <td>{{rule.value}}</td>
                </tr>
            </tbody>
        </table>
        <div v-else class="text-dark">
            <span>No bucket rules set yet !!</span>
        </div>
    </div>
</template>

<script>
    import client from '@/client'
    export default {
        name: "Rules",
        props: {
            rules: {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                apiFields: []
            }
        },
        mounted() {
            this.fetchapiFields()   ;
        },
        methods: {
            fetchapiFields() {
                let self = this;
                client.get(callCredit)
                    .then(response => {
                        self.apiFields = response.data
                    })
            },
            fetchApiFieldDetail(apiField) {
                if (this.apiFields.length  === 0) return;
                let fetch = this.apiFields.filter((field) => {
                    return field.FieldNames === apiField
                });
                return fetch.length > 0 ? fetch[0].Description : '';
            }
        }
    }
</script>

<style scoped>

</style>