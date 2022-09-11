require('./bootstrap');


import { createApp } from 'vue';
import router from './router';
import InvoicesIndex from './components/invoices/InvoicesIndex.vue'
createApp({
    components:{
        InvoicesIndex
    }
}).use(router).mount("#app")