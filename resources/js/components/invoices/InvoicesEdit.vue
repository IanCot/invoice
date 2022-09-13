<template>
    <div class="flex container__form p-1">
      <div v-if="errors">
        <div v-for="(v, k) in errors" :key="k" class="bg-warning  text-white rounded  my-4 shadow-lg py-2 px-4 pr-0 text-center">
          <p v-for="error in v" :key="error" class="text-sm">
            {{ error }}
          </p>
        </div>
    </div>
    <form class="col-10" @submit.prevent="saveInvoice">
      <div class="mb-3">
      <label for="invoice_no" class="form-label">Numer faktury</label>
      <input type="text" class="form-control" id="invoice_no" aria-describedby="invoice_noHelp" required 
      v-model="invoice.invoice_no" >
      <div id="invoice_noHelp" class="form-text">Prosze podać numer faktury</div>
    </div>
    <div class="mb-3">
    <label for="date_of_issue" class="form-label">Data wystawienia faktury</label>
    <input type="date" class="form-control" id="date_of_issue" aria-describedby="date_of_issueHelp" required 
    v-model="invoice.date_of_issue" placeholder="Numer faktury">
    <div id="date_of_issueHelp" class="form-text">Prosze wybrać datę wystawienia faktury</div>
  </div>
    <div class="mb-3">
      <label for="seller_nip" class="form-label">Nip Sprzedawcy</label>
      <input type="text" class="form-control" id="seller_nip" aria-describedby="seller_nipHelp" required 
      v-model="invoice.seller_nip">
      <div id="seller_nipHelp" class="form-text">Numer Nip może oprócz cyfr zawierać znaki "-"," "</div>
    </div>
    <div class="mb-3">
      <label for="buyer_nip" class="form-label">Nip Nabywcy</label>
      <input type="text" class="form-control" id="buyer_nip" aria-describedby="buyer_nipHelp" required 
      v-model="invoice.buyer_nip">
      <div id="buyer_nipHelp" class="form-text">Numer Nip może oprócz cyfr zawierać znaki "-"," "</div>
    </div>
    <div class="mb-3">
      <label for="product" class="form-label">Nazwa Produktu</label>
      <input type="text" class="form-control" id="product" aria-describedby="productHelp" required 
      v-model="invoice.product">
      <div id="productHelp" class="form-text">Prosze  podać nazwę nie dłuższą niż 255 znaków</div>
    </div>
    <div class="mb-3">
      <label for="amount" class="form-label">Kwota netto</label>
      <input type="text" class="form-control" id="amount" aria-describedby="amountHelp" required  
      v-model="invoice.amount">
      <div id="amountHelp" class="form-text">Prosze  podać kwotę netto w PLN</div>
    </div>
    <button type="submit" class="btn btn-success">Zapisz zmiany</button>
    </form>
  </div>
  </template>
<script>
    import useInvoices from '../../composable/invoices';
    import { onMounted } from 'vue';
export default {
    props: {
        id: {
            required: true,
            type: String
        }
    },
    setup(props){
        const {errors,invoice,getInvoice,updateInvoice} = useInvoices()
        onMounted(getInvoice(props.id))
        const saveInvoice = async () => {
            await updateInvoice(props.id)
        }
        return {
            invoice,
            errors,
            saveInvoice
        }
    }
}
</script>