<template>

<Teleport to="body">
  <!-- use the modal component, pass in the prop -->
  <modal :show="showModal" @close="showModal = false">
    <template #header>
      <h3>Dodawanie Faktury</h3>
    </template>
    <template #body > 
        <invoices-create @close="showModal = false"></invoices-create>
    </template>
  </modal>
</Teleport>
<teleport to="body">
    <edit-modal  :show="showEditNodal" @closeEdit="showEditNodal = false">
        <template #header><h3>Edycja Faktury</h3></template>
        <template #body> 
            <invoices-edit :id=itemId></invoices-edit>
        </template>
    </edit-modal>
</teleport>
    <div class="flex place-content-end mb-4">
            <div class="px-4 py-2">
            <button @click="showModal = true" class="btn btn-success">Dodaj fakturę</button>
            </div>
        </div>
<div class="invoice__table">
    <div class="table__row">
            <div class="table__col">Nr Faktury</div>
            <div class="table__col">Nip kupujacego</div>
            <div class="table__col">Nip Sprzedajacego</div>
            <div class="table__col">Nazwa produktu</div>
            <div class="table__col">Kwota netto</div>
            <div class="table__col">Data wystawienia</div>
            <div class="table__col">Data wystawienia</div>
            <div class="table__col">Funkcje</div>
        </div>
        <template v-for="item in invoices" :key="item.id">
            <div class="table__row">
            <div class="table__col">{{item.invoice_no}}</div>
            <div class="table__col">{{item.buyer_nip}}</div>
            <div class="table__col">{{item.seller_nip}}</div>
            <div class="table__col">{{item.product}}</div>
            <div class="table__col">{{item.amount}}</div>
            <div class="table__col">{{item.date_of_issue}}</div>
            <div class="table__col">{{item.updated_at}}</div>
            <div class="table__col">
                <button class="btn btn-primary m-1" @click="showEditNodal=true , itemId=item.id">Edytuj</button>
                <button  @click="deleteInvoice(item.id)"  class="btn btn-danger m-1">Usuń</button>       
            </div>
        </div>
        </template>
</div>      
<div class="flex flex-wrap place-content-center mt-4 , mb-4">
    <template v-for="item in pagination.links" :key="item.label">
        <div class="btn m-1" :class="[item.active ? 'btn-secondary': 'btn-outline-secondary',{'disabled':!item.url}]" @click="getPage(item.url)"  v-html="item.label"></div>
    </template>
</div>
</template>
<script>
    import useInvoices from '../../composable/invoices';
    import Modal from './Modal.vue';
    import EditModal from './EditModal.vue'
    import InvoicesCreate from './InvoicesCreate.vue';
    import InvoicesEdit from './InvoicesEdit.vue';
    
    import { onMounted } from 'vue';
    export default {
        components:{
            Modal,
            EditModal,
            InvoicesCreate,
            InvoicesEdit
        },
        data() {
                return {
                showModal: false,
                showEditNodal: false,
                itemId:null
                }
         },
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
                getPage,
              
            }
        }
    }
</script>