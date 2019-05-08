<template>
    <form class="table" @submit.prevent="processFormSubmit">
        <p class="c-grey-900 mB-20">
            <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
            <b>Personal Information of lender </b>
        </p>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name"><b>Name</b></label>
                    <input type="text" name="name"
                           v-model="lender.name"
                           v-validate="'required'"
                           :class="{'is-invalid':errors.first('name')}"
                           class="form-control" placeholder="Lender Name">
                    <div v-if="errors.first('name')"
                         class="invalid-feedback">{{ errors.first('name') }}</div>
                </div>
                <div class="form-group">
                    <label for="contact_email"><b>Contact Email</b></label>
                    <input type="text" name="contact_email"
                           v-model="lender.contact_email"
                           v-validate="'required|email'"
                           :class="{'is-invalid':errors.first('contact_email')}"
                           class="form-control" placeholder="Contact Email">
                    <div v-if="errors.first('contact_email')"
                         class="invalid-feedback">{{ errors.first('contact_email') }}</div>
                </div>
                <div class="form-group">
                    <label for="website"><b>Web site link</b></label>
                    <input type="text" name="website"
                           v-model="lender.website"
                           v-validate="'url'"
                           :class="{'is-invalid':errors.first('website')}"
                           class="form-control" placeholder="Web site">
                    <div v-if="errors.first('website')"
                         class="invalid-feedback">{{ errors.first('website') }}</div>
                </div>
                <div class="form-group">
                    <label for="logo"><b>Logo</b></label>
                    <div class="custom-file">
                        <input type="file" name="logo" id="customFile"
                               @change="fileChange($event)"
                               v-validate="'mimes:image/*'"
                               :class="{'is-invalid':errors.first('logo')}"
                               class="custom-file-input">
                        <label class="custom-file-label" for="customFile">{{logoName?logoName:'Choose file'}}</label>
                    </div>
                    <div v-if="lenderLogo">
                        <img :src="lenderLogo" alt="" width="200">
                    </div>
                    <div v-if="errors.first('logo')"
                         class="text-danger"><small>{{ errors.first('logo') }}</small></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="api_credentials"><b>Api credentials </b><small>(JSON)</small></label>
                    <textarea name="api_credentials" id="api_credentials"
                          v-model="lender.api_credentials"
                          v-validate="'json'"
                          :class="{'is-invalid':errors.first('api_credentials')}"
                          class="form-control" placeholder="Api credentials json format"></textarea>
                    <div v-if="errors.first('api_credentials')"
                         class="invalid-feedback">{{ errors.first('api_credentials') }}</div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <p class="c-grey-900">
                <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
                <b>Products </b>
            </p>
            <multiple-product-select name="products"
                 v-model="lender.products"></multiple-product-select>
            <div v-if="errors.first('products')"
                 class="invalid-feedback">{{ errors.first('products') }}</div>
        </div>
        <p class="c-grey-900 mB-20">
            <i class="c-orange-500 ti-layout-list-thumb mR-15"></i>
            <b>Login Information of lender </b>
        </p>
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="login_email"><b>Login email</b></label>
                <input type="text" name="email"
                       v-model="lender.email"
                       v-validate="'required|email'"
                       :class="{'is-invalid':errors.first('email')}"
                       class="form-control" placeholder="Email">
                <div v-if="errors.first('email')"
                     class="invalid-feedback">{{ errors.first('email') }}</div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="ti-upload"></i>
                <span v-if="method === 'put'">Update</span>
                <span v-else>Save</span>
                lender
            </button>
        </div>
    </form>
</template>

<script>
    import client from '@/client'
    import alertify from 'alertifyjs'
    import MultipleProductSelect from '@comp/lib/form/MultipleProductSelect'

    export default {
        name: "lender-form",
        components: { MultipleProductSelect },
        props: {
            value: {
                type: Object,
                required: false,
                default: () => {}
            },
            method: {
                type: String,
                required: false,
                default: 'post'
            }
        },
        data(){
            return {
                logoName: '',
                previewLogo: '',
                lender: {}
            }
        },
        computed: {
            lenderLogo() {
                if (_.isEmpty(this.value)) {
                    return false;
                }
                let logo = this.value.logo?this.value.logo.src:'';
                return this.previewLogo ? this.previewLogo : logo;
            }
        },
        watch: {
            value() {
                this.valueAssign()
            }
        },
        created() {
            this.valueAssign()
            this.$validator.extend('json', {
                getMessage(field, val) {
                    return 'API credential must be a json object'
                },
                validate(value, field) {
                    try {
                        JSON.parse(value);
                        return true;
                    } catch (e) { return false }
                }
            })
        },
        methods: {
            fileChange(event) {
                if (!_.isEmpty(event.target.files) && event.target.files.length > 0){
                    this.logoName = event.target.files[0].name
                    this.previewLogo = URL.createObjectURL(event.target.files[0]);
                    return this.lender.logo = event.target.files[0];
                }
            },
            processFormSubmit() {
                if (this.method === 'put')
                    return this.updateLender();
                return this.submitLender();
            },
            submitLender() {
                let self = this
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        client.post(route , self.formatLender())
                            .then(response => {
                                if (response.status === 200){
                                    alertify.success(response.message)
                                    window.location.replace('/lenders')
                                }
                            })
                        return;
                    }
                    alertify.warning('Correct above errors!')
                });
            },
            updateLender() {
                let self = this
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        client.post(route + '/' + self.lender.id, self.formatLender())
                            .then(response => {
                                if (response.status === 200){
                                    alertify.success(response.data.message)
                                    window.location.replace('/lenders')
                                }
                            });
                        return;
                    }
                    alertify.warning('Correct above errors!')
                });
            },
            formatLender() {
                let self = this;
                return (() => {
                    let data = new FormData()
                    data.append('name', self.lender.name)
                    data.append('email', self.lender.email)
                    data.append('contact_email', self.lender.contact_email)
                    data.append('website', self.lender.website)
                    data.append('logo', self.lender.logo)
                    data.append('products', JSON.stringify(self.lender.products.filter(product => product.select === true)))
                    data.append('api_credentials', self.lender.api_credentials?self.lender.api_credentials:'{}')
                    data.append('_method', self.method);
                    if (self.lender.user_id)
                        data.append('user_id', self.lender.user_id)
                    return data;
                })();
            },
            valueAssign() {
                if (this.method !== 'put' || _.isEmpty(this.value)) return
                this.lender.id = this.value.id
                this.lender.user_id = this.value.user?this.value.user.id:''
                this.lender.name = this.value.name
                this.lender.website = this.value.website
                this.lender.products = this.value.products
                this.lender.contact_email = this.value.contact_email
                this.lender.api_credentials = this.value.api_credentials
                this.lender.logo = this.value.logo ? this.value.logo.src : ''
                this.lender.email = this.value.user ? this.value.user.email : ''
            }
        }
    }
</script>

<style scoped>
#api_credentials {
    height: 17.2rem;
}
</style>