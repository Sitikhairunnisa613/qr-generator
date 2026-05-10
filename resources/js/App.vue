<template>
  <div class="page">

    <div class="card">

      <h2>QR Generator</h2>

      <!-- MODE -->
      <div class="tabs">
        <button @click="mode='text'" :class="{active: mode==='text'}">Text</button>
        <button @click="mode='payment'" :class="{active: mode==='payment'}">Payment</button>
      </div>

      <!-- TYPE -->
      <select v-if="mode==='text'" v-model="type" class="input">
        <option value="text">Text</option>
        <option value="url">URL</option>
        <option value="wa">WhatsApp</option>
        <option value="ig">Instagram</option>
      </select>

      <!-- INPUT TEXT -->
      <input
        v-if="mode==='text'"
        v-model="text"
        :placeholder="placeholderText"
        class="input"
      />

      <!-- INPUT PAYMENT -->
      <input
        v-if="mode==='payment'"
        v-model="amount"
        type="number"
        placeholder="Masukkan nominal"
        class="input"
      />

      <button class="btn" @click="generateQR">
        Generate QR
      </button>

      <div v-if="qr" class="result">
        <img :src="qr" />
        <p class="preview">{{ preview }}</p>
      </div>

    </div>

  </div>
</template>

<script>
export default {
  data() {
    return {
      mode: 'text',
      type: 'text',
      text: '',
      amount: '',
      qr: '',
      preview: '',
      invoiceId: ''
    }
  },

  computed: {
    placeholderText() {
      if (this.type === 'wa') return 'Contoh: 08123456789'
      if (this.type === 'ig') return 'Contoh: username_ig'
      if (this.type === 'url') return 'Contoh: google.com'
      return 'Masukkan text'
    }
  },

  methods: {
    generateQR() {

      const BASE_URL = 'http://192.168.100.104:8000'

      this.invoiceId = 'QR' + Date.now()

      // ================= TEXT =================
      if (this.mode === 'text') {

        if (!this.text) return

        let value = ''

        if (this.type === 'text') {
          value = this.text
        }

        if (this.type === 'url') {
          value = this.text.startsWith('http')
            ? this.text
            : 'https://' + this.text
        }

        if (this.type === 'wa') {
          let num = this.text.replace(/\D/g, '')
          num = num.replace(/^0/, '')
          value = `https://wa.me/62${num}`
        }

        if (this.type === 'ig') {
          value = `https://instagram.com/${this.text}`
        }

        this.preview = value

        // ✔ QR dari Laravel (NO API)
        this.qr = `${BASE_URL}/qr?data=${encodeURIComponent(value)}`

        return
      }

      // ================= PAYMENT =================
      if (this.mode === 'payment') {

        if (!this.amount) return

        const url =
          `${BASE_URL}/scan/payment/${this.invoiceId}?nominal=${this.amount}`

        this.preview = url

        // ✔ QR dari Laravel (NO API)
        this.qr = `${BASE_URL}/qr?data=${encodeURIComponent(url)}`
      }
    }
  }
}
</script>

<style>
.page {
  min-height: 100vh;
  background: linear-gradient(135deg, #ffe4f1, #fff5fa);
  display: flex;
  justify-content: center;
  align-items: center;
  font-family: Arial;
}

.card {
  background: white;
  padding: 30px;
  border-radius: 20px;
  width: 380px;
  box-shadow: 0 10px 30px rgba(255,105,180,0.15);
  text-align: center;
}

h2 {
  color: #ff69b4;
}

.tabs {
  display: flex;
  gap: 10px;
  justify-content: center;
  margin-bottom: 15px;
}

.tabs button {
  padding: 6px 14px;
  border: none;
  border-radius: 10px;
  background: #ffe4ef;
  cursor: pointer;
}

.tabs button.active {
  background: #ff69b4;
  color: white;
}

.input {
  width: 100%;
  padding: 10px;
  margin-top: 10px;
  border-radius: 10px;
  border: 1px solid #ffd1e6;
}

.btn {
  margin-top: 15px;
  width: 100%;
  padding: 10px;
  background: linear-gradient(135deg, #ff9acb, #ff69b4);
  color: white;
  border: none;
  border-radius: 12px;
  cursor: pointer;
}

.result {
  margin-top: 20px;
}

.preview {
  font-size: 12px;
  color: #666;
}
</style>