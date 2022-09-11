import { createRouter , createWebHistory } from "vue-router";

import InvoiceIndex  from "../components/invoices/InvoicesIndex";
import InvoicesCreate from '../components/invoices/InvoicesCreate';
import InvoicesEdit from '../components/invoices/InvoicesEdit';

const routes = [
    {
        path:'/',
        name: 'invoices.index',
        component:InvoiceIndex
    },
    {
        path:'/invioces/create',
        name: 'invoices.create',
        component:InvoicesCreate
    },
    {
        path:'/invioces/:id/edit',
        name: 'invoices.edit',
        component:InvoicesEdit,
        props:true
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})