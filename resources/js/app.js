require('./bootstrap');

window.Vue = require('vue');

import Gate from "./gate";
Vue.prototype.$gate = new Gate(window.laravel);
const auth = new Gate(window.laravel);

//Sweet alert
import swal from 'sweetalert2';
window.swal = swal;

//Moment JS
import moment from 'moment';
window.moment = require('moment');
Vue.filter('formatDate', function(value) {
	if (value) {
		return moment(String(value)).format('Do MMMM YYYY ');
	}
});

//Vue router
import VueRouter from 'vue-router';
Vue.use(VueRouter)
const routes = [

    {path:'/',component: require('./components/dashboard.vue').default},

    {path:'/employees',component: require('./components/employees/list.vue').default,meta: { role: 'admin'}},
    {path:'/employees/:id',component: require('./components/employees/detail.vue').default},
    {path:'/employee/new',component: require('./components/employees/new.vue').default,meta: { role: 'admin'}},

    {path:'/salaries',component: require('./components/salaries/list.vue').default},
    {path:'/salaries/:id',component: require('./components/salaries/detail.vue').default},
    {path:'/salary/new/:id',component: require('./components/salaries/new.vue').default,meta: { role: 'admin'}},
    
]
const router = new VueRouter({
    routes,
    mode: 'history'
});

router.beforeEach((to, from, next) => {
    var roles = auth.roles
    if(to.meta.role) {
        for(var i=0; i < roles.length; i++){
            if(roles[i]['name'] == to.meta.role){
              return next()
            }
        }
        return next('')    
    }
    next()
});

//Vue form
import { Form, HasError, AlertError } from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


const app = new Vue({
    el: '#app',
    router
});
