import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useInvoices() {

    const invoices = ref([])
    const invoice = ref([])
    const pagination = ref([])
    const errors = ref('')
    const router = useRouter()

    const getInvoice = async (id) =>{
      let response = await axios.get('/api/invoices/' + id)
      invoice.value = response.data.data
    }
    const  getInvoices = async ()=>{
      let response =  await axios.get('/api/invoices')
      invoices.value = response.data.data
      pagination.value = response.data.meta
    }
    const getInvoicesByPage = async (page) => {
      let response = await axios.get('/api/invoices?page='+page)
      invoices.value = response.data.data
      pagination.value = response.data.meta
    }
    const storeInvoice = async (data)=>{
      errors.value='';
      try {
        await axios.post('/api/invoices',data).then(function (res) {
          window.location.reload();
        })
      } catch (e) {
        if (e.response.status === 422) {
          errors.value = e.response.data.errors
        }
      }

    }
    const updateInvoice = async (id)=>{
      errors.value='';
      try {
        await axios.put('/api/invoices/'+id,invoice.value).then(function (res) {
          window.location.reload();
        })
      } catch (e) {
        if (e.response.status === 422) {
          errors.value = e.response.data.errors
        }
      }
    }
    const destroyInvoice = async (id)=>{
       await axios.delete('/api/invoices/'+ id )
    }
    return {
        invoice,
        invoices,
        pagination,
        errors,
        getInvoice,
        getInvoices,
        destroyInvoice,
        getInvoicesByPage,
        storeInvoice,
        updateInvoice
    }
}