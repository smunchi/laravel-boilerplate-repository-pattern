<template>
    <div class="credit-form">
        <div @click="showFields = !showFields" class="cursor-pointer border border-dark p-10 mB-15 bdrs-3">
            <div class="row">
                <p class="col-sm-10 m-0 pL-20">
                    <b>Risk bucket credit rules</b><br>
                    <span class="badge badge-warning">Click here to show risk bucket credit rule fields </span>
                </p>
                <div class="col-sm-2 text-right">
                    <button type="button"
                            class="btn btn-default mT-10 c-blue-900">
                        <span v-if="showFields"><i class="ti-angle-up"></i></span>
                        <span v-else><i class="ti-angle-down"></i></span>
                    </button>
                </div>
            </div>
        </div>
        <div v-show="showFields" v-for="(info, index) in apiFields" class="form-group border-bottom pB-15">
            <div class="row">
                <label class="col-sm-8" for="description"> <i class="ti-align-left c-orange-800 mR-10"></i> {{info.Description}}</label>
                <div class="col-sm-2">
                    <select class="form-control" @change="pushRule" v-model="rules[index].operator">
                        <option value="">N/A</option>
                        <option value="<"> < </option>
                        <option value=">"> > </option>
                        <option value="="> = </option>
                        <option value="<="> <= </option>
                        <option value=">="> >= </option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <input type="text" @keyup="pushRule" v-model="rules[index].value" class="form-control">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import client from '@/client'
    export default {
        name: "rule-input",
        props: {
            value: {
                type: Array,
                required: false
            }
        },
        data (){
            return {
                apiFields: [],
                showFields: false,
                rules: [],
            }
        },
        watch: {
            value() {
                if (_.isEmpty(this.value)) return;
                this.showFields = true
                this.value.forEach((objValue) => {
                    this.rules.forEach((rule, index) => {
                        if (objValue.field_name === rule.field_name){
                            this.rules[index].id = objValue.id;
                            this.rules[index].bucket_id = objValue.bucket_id;
                            this.rules[index].operator = objValue.operator;
                            this.rules[index].value = objValue.value;
                        }
                    })
                })
            }
        },
        mounted (){
            this.fetchapiFields()
        },
        methods: {
            fetchapiFields (){
                let self = this;
                client.get('/admin/api/call-credit/api-fields')
                    .then(response => {
                        this.apiFields = response.data;
                        this.apiFields.forEach(function(apiField){
                            self.rules.push({field_name: apiField.FieldNames, operator : '', value: ''});
                        })
                    })
            },
            pushRule (){
                this.$emit('input', this.rules.filter(rule => {
                    if (rule.operator || rule.value) return rule;
                }))
            },
        }
    }
</script>

<style scoped>
</style>