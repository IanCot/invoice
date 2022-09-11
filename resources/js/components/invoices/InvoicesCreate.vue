<template>
  <!-- <dialog class="modal" id="createInvoice" open> -->
  <div class="flex container__form p-6">
    <header class="container__form">
    <h2>Dodawanie Faktury</h2>
    <button class="btn btn-danger">zamknij</button>
  </header>
    <div v-if="errors">
      <div v-for="(v, k) in errors" :key="k" class="bg-warning  text-white rounded  my-4 shadow-lg py-2 px-4 pr-0 text-center">
        <p v-for="error in v" :key="error" class="text-sm">
          {{ error }}
        </p>
      </div>
  </div>
  <form class="col-8" @submit.prevent="saveInvoice">
    <div class="mb-3">
    <label for="invoice_no" class="form-label">Numer faktury</label>
    <input type="text" class="form-control" id="invoice_no" aria-describedby="invoice_noHelp" required 
    v-model="form.invoice_no">
    <div id="invoice_noHelp" class="form-text">Prosze podać numer faktury</div>
  </div>
  <div class="mb-3">
    <label for="seller_nip" class="form-label">Nip Sprzedawcy</label>
    <input type="text" class="form-control" id="seller_nip" aria-describedby="seller_nipHelp" required 
    v-model="form.seller_nip">
    <div id="seller_nipHelp" class="form-text">Prosze  podać NIP składajacy się z samych cyfr bez znaków "-","/"," "</div>
  </div>
  <div class="mb-3">
    <label for="buyer_nip" class="form-label">Nip Nabywcy</label>
    <input type="text" class="form-control" id="buyer_nip" aria-describedby="buyer_nipHelp" required 
    v-model="form.buyer_nip">
    <div id="buyer_nipHelp" class="form-text">Prosze  podać NIP składajacy się z samych cyfr bez znaków "-","/"," "</div>
  </div>
  <div class="mb-3">
    <label for="product" class="form-label">Nazwa Produktu</label>
    <input type="text" class="form-control" id="product" aria-describedby="productHelp" required 
    v-model="form.product">
    <div id="productHelp" class="form-text">Prosze  podać nazwę nie dłuższą niż 255 znaków</div>
  </div>
  <div class="mb-3">
    <label for="amount" class="form-label">Nazwa Produktu</label>
    <input type="text" class="form-control" id="amount" aria-describedby="amountHelp" required  
    v-model="form.amount">
    <div id="amountHelp" class="form-text">Prosze  podać kwotę nett</div>
  </div>
  <button type="submit" class="btn btn-success">Zapis</button>
  </form>
</div>
<!-- </dialog> -->
</template>
<script>
import { reactive } from "vue";
import useInvoices from "../../composable/invoices";
export default {
  setup(){
    const form = reactive({
            'invoice_no': '',
            'seller_nip': '',
            'buyer_nip': '',
            'product': '',
            'amount':'',
        })
    const { errors, storeInvoice } = useInvoices()
    const saveInvoice = async ()=>{
      await storeInvoice({...form})
    }
    return {
      form,
      errors,
      saveInvoice
    }
  }
}
</script>