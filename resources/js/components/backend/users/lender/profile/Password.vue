<template>
    <modal :customClass="'sm'">
        <template  v-slot:header>
            <h4 class="col-sm-6 c-grey-900 p-20">
                <i class="c-blue-500 ti-package mR-15"></i>
                Change password
            </h4>
        </template>
        <template v-slot:body>
            <form @submit.prevent="updatePassword" class="pL-20 pR-20" method="put">
                <div class="form-group">
                    <label for="current"><b>Current Password</b></label>
                    <input type="password" name="current"
                           v-model="password.current"
                           v-validate="'required|min:6'"
                           :class="{'is-invalid':errors.first('current')}"
                           class="form-control" placeholder="Current password">
                    <div v-if="errors.first('current')"
                         class="invalid-feedback">{{ errors.first('current') }}</div>
                </div>
                <div class="form-group">
                    <label for="new_password"><b>New Password</b></label>
                    <input type="password" name="new_password"
                           v-model="password.password"
                           ref="password"
                           v-validate="'required|min:6'"
                           :class="{'is-invalid':errors.first('new_password')}"
                           class="form-control" placeholder="New Password">
                    <div v-if="errors.first('new_password')"
                         class="invalid-feedback">{{ errors.first('new_password') }}</div>
                </div>
                <div class="form-group">
                    <label for="confirm_password"><b>Confirm Password</b></label>
                    <input type="password" name="confirm_password"
                           v-model="password.password_confirmation"
                           v-validate="'required|confirmed:password|min:6'"
                           :class="{'is-invalid':errors.first('confirm_password')}"
                           class="form-control" placeholder="Confirm password">
                    <div v-if="errors.first('confirm_password')"
                         class="invalid-feedback">{{ errors.first('confirm_password') }}</div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Update Password</button>
                </div>
            </form>
        </template>
    </modal>
</template>

<script>
    import modal from '@comp/lib/Modal'
    import client from '@/client'
    import alertify from 'alertifyjs'
    import {EventBus} from "@/event-bus";
    export default {
        name: "lender-password",
        components: {
            modal
        },
        data() {
            return {
                password: {}
            }
        },
        methods: {
            updatePassword() {
                let self = this
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        client.put(parentRoute + '/password', self.password)
                            .then(response => {
                                if (response.status === 200){
                                    self.password = {}
                                    EventBus.$emit('modalClose');
                                    alertify.success(response.data.message)
                                }
                            });
                        return;
                    }
                    alertify.warning('Correct above errors!')
                });
            },
        }
    }
</script>

<style scoped>

</style>