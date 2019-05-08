<template>
    <div>
        <form @submit.prevent="submitForm"
              :class="{'was-validated': errors.length > 0}" method="post">
            <div class="form-group">
                <label for="bucket_color"><b>Select risk bucket color</b></label>
                <image-select v-model="bucket.image"
                              v-validate=""
                              :class="{'is-invalid':errors.first('image')}"
                              name="image"
                              :width="'80'"></image-select>
                <div v-if="errors.first('image')"
                     class="text-danger"><small>{{ errors.first('image') }}</small></div>
            </div>
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="bucket_name"><b>Risk bucket name</b></label>
                    <input type="text" v-model="bucket.name"
                           v-validate="'required'"
                           :class="{'is-invalid':errors.first('name')}"
                           name="name"
                           class="form-control"
                           placeholder="Risk Bucket Name">
                    <div v-if="errors.first('name')"
                         class="invalid-feedback">{{ errors.first('name') }}</div>

                </div>
                <div class="col-sm-3 form-group">
                    <label for="min_score"><b>Min Score</b></label>
                    <input type="number" v-model="bucket.min_score"
                           v-validate="'required'"
                           :class="{'is-invalid':errors.first('min_score')}"
                           name="min_score"
                           class="form-control" placeholder="Applicant min score">
                    <div v-if="errors.first('min_score')"
                         class="invalid-feedback">{{ errors.first('min_score') }}</div>

                </div>
                <div class="col-sm-3 form-group">
                    <label for="min_score"><b>Max Score</b></label>
                    <input type="number" v-model="bucket.max_score"
                           v-validate="'required'"
                           :class="{'is-invalid':errors.first('max_score')}"
                           name="max_score"
                           class="form-control"
                           placeholder="Applicant max score">
                    <div v-if="errors.first('max_score')"
                         class="invalid-feedback">{{ errors.first('max_score') }}</div>

                </div>
            </div>
            <div class="form-group">
                <label for="bucket_product"><b>Select Product</b></label>
                <div v-if="errors.first('product')"
                     class="text-danger"><small>{{ errors.first('product') }}</small></div>
                <text-select v-model="bucket.product_id"
                         v-validate="'required'"
                         name="product"></text-select>
            </div>
            <rule-input v-model="bucket.rules" :value="bucket.rules"></rule-input>
            <div class="form-group">
                <button type="submit" :disabled="load" class="btn btn-primary">
                    <i class="ti-upload mR-5"></i>
                    <span v-if="method === 'put'"> Update</span>
                    <span v-else> Save</span>
                    risk bucket
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    import client from '@/client'
    import ImageSelect from '@comp/lib/form/ImageSelect'
    import TextSelect from '@comp/lib/form/TextSelect'
    import RuleInput from './RuleInput'
    import alertify from 'alertifyjs'
    export default {
        name: 'bucket-form',
        components: {
            ImageSelect, TextSelect, RuleInput
        },
        props: {
            value: {
                type: Object,
                required: false,
                default: () => {}
            },
            method: {
                type: String,
                required: false,
            }
        },
        data (){
            return {
                bucket: {
                    name: '',
                    image: '',
                    min_score: '',
                    max_score: '',
                    product_id: '',
                    rules: []
                },
                load: false,
            }
        },
        watch: {
            value() {
                this.bucketAssign();
            }
        },
        created() {
            this.bucketAssign();
        },
        methods: {
            submitForm() {
                if (this.method === 'put')
                    return this.updateBucket();
                return this.storeBucket();
            },
            storeBucket (){
                let self = this;
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        self.load = true;
                        client.post(route + '/', self.bucket)
                            .then(response => {
                                self.load = false;
                                alertify.success(response.data.message);
                                self.emptyBucket
                                window.location.replace(webRoute)
                            })
                    }
                })
            },
            updateBucket (){
                let self = this;
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        self.load = true;
                        client.put(route + '/' + self.value.id, self.bucket)
                            .then(response => {
                                self.load = false;
                                alertify.success(response.data.message);
                                self.emptyBucket
                                window.location.replace(webRoute)
                            })
                    }
                })
            },
            bucketAssign() {
                if (this.method !== 'put' || _.isEmpty(this.value)) return
                this.bucket.name = this.value.name
                this.bucket.min_score = this.value.min_score
                this.bucket.max_score = this.value.max_score
                this.bucket.product_id = this.value.product_id
                this.bucket.image = this.value.color ? this.value.color.src : ''
                this.bucket.rules = this.value.rules;
            },
            emptyBucket (){
                this.bucket = {
                    name: '',
                    image: '',
                    min_score: '',
                    max_score: '',
                    product_id: '',
                    rules: []
                }
            }
        }

    }
</script>

<style scope>
</style>