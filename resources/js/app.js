require('./bootstrap');

window.Vue = require('vue');

import { Form, HasError, AlertError } from 'vform';

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

/* Write custom js below */

const hello = () => console.log('Hello World');
window.addEventListener('load', hello);



Vue.component('question-create', require('./components/question/create.vue').default);
Vue.component('messsage-create', require('./components/message/create.vue').default);

const app = new Vue({
    el: '#app',
    data:{}
});

