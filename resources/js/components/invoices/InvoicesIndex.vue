<template>
    <div class="flex place-content-end mb-4">
            <div class="px-4 py-2">
                <router-link :to="{ name: 'invoices.create' }" class="btn btn-primary">Create company</router-link>
            </div>
        </div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nr Faktury</th>
      <th scope="col">Nip kupujacego</th>
      <th scope="col">Nip Sprzedajacego</th>
      <th scope="col">Nazwa produktu</th>
      <th scope="col">Kwota netto</th>
      <th scope="col">Data wystawienia</th>
      <th scope="col">Data edycji</th>
      <th scope="col">Funkcje</th>
    </tr>
  </thead>
  <tbody>
    <template v-for="item in invoices" :key="item.id">
        <tr>
            <td>{{item.invoice_no}}</td>
            <td>{{item.buyer_nip}}</td>
            <td>{{item.seller_nip}}</td>
            <td>{{item.product}}</td>
            <td>{{item.amount}}</td>
            <td>{{item.created_at}}</td>
            <td>{{item.updated_at}}</td>
            <td><router-link :to="{ name: 'invoices.edit', params: { id: item.id } }" class="btn btn-primary">edycja</router-link>
                 <button  @click="deleteInvoice(item.id)"  class="btn btn-danger">usuń</button></td>
        </tr>
    </template>
  </tbody>
</table>
<div class="flex place-content-center mt-4 , mb-4">
    <template v-for="item in pagination.links" :key="item.label">
        <div class="btn m-1" :class="[item.active ? 'btn-secondary': 'btn-outline-secondary',{'disabled':!item.url}]" @click="getPage(item.url)"  v-html="item.label"></div>
    </template>
</div>
</template>
<script>
    import useInvoices from '../../composable/invoices';
    import InvoicesCreate from './InvoicesCreate.vue';
    import { onMounted } from 'vue';
    export default {

        setup(){
            const {invoices,pagination , getInvoices,getInvoicesByPage,destroyInvoice} = useInvoices()
            onMounted(getInvoices);
            const deleteInvoice = async (id)=>{
            if (!window.confirm('Czy napewno usunąć fakturę?')) {
                return
            }
            await destroyInvoice(id);
            await getInvoices();
            }
            const getPage = async (url)=>{
                let params = (new URL(url)).searchParams;
                if(params === null){
                    return;
                }
                let page =parseInt(params.get('page'));
                await getInvoicesByPage(page);
            }
            return {
                invoices,
                pagination,
                deleteInvoice,
                getPage
            }
        }
    }
</script>