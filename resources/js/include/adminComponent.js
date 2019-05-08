import Vue from 'vue'

// dashboard components
Vue.component('admin-dashboard', require('@/components/backend/dashboard/Dashboard.vue').default);
Vue.component('backend-profile', require('@/components/backend/users/Profile.vue').default);
// product components
Vue.component('product-page', require('@/components/backend/product/Product.vue').default);
// bucket components
Vue.component('bucket-page', require('@/components/backend/bucket/Index.vue').default);
Vue.component('bucket-create', require('@/components/backend/bucket/Create.vue').default);
Vue.component('bucket-show', require('@/components/backend/bucket/show/Show.vue').default);
Vue.component('bucket-edit', require('@/components/backend/bucket/Edit.vue').default);
// lender bucket components
Vue.component('lender-bucket-page', require('@/components/backend/bucket/lender/Index.vue').default);
Vue.component('lender-bucket-create', require('@/components/backend/bucket/lender/Create.vue').default);
Vue.component('lender-bucket-edit', require('@/components/backend/bucket/lender/Edit.vue').default);
// lender components
Vue.component('lender-page', require('@/components/backend/users/lender/Index.vue').default);
Vue.component('lender-create', require('@/components/backend/users/lender/Create.vue').default);
Vue.component('lender-edit', require('@/components/backend/users/lender/Edit.vue').default);
Vue.component('lender-show', require('@/components/backend/users/lender/Show.vue').default);
Vue.component('lender-profile', require('@/components/backend/users/lender/profile/Show.vue').default);
Vue.component('lender-profile-edit', require('@/components/backend/users/lender/profile/Edit.vue').default);

// customer components
Vue.component('customer-page', require('@/components/backend/users/customer/Index').default);
Vue.component('customer-show', require('@/components/backend/users/customer/show/Show').default);

//admin user components
Vue.component('admin-page', require('@/components/backend/users/admin/Index').default);

// applications components
Vue.component('application-page', require('@/components/backend/applications/Index').default);
Vue.component('application-show', require('@/components/backend/applications/detail/Show').default);

// config components
Vue.component('setting-page', require('@/components/backend/config/Setting').default);
Vue.component('loan-purpose-page', require('@/components/backend/config/LoanPurpose').default);