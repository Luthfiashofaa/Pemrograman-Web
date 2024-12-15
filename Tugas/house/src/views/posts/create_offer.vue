<script setup>
//import ref
import { ref } from "vue";

//import router
import { useRouter, useRoute } from "vue-router";

//import api
import api from "../../api";

//init router
const router = useRouter();
const route = useRoute(); 

//define state
const offered_price = ref("");
const notes = ref("");
const phone_number = ref("");
const id_property = ref(route.params.id);
const errors = ref([]);


//method "storePost"
const storePost = async () => {

    //init formData
    let formData = new FormData();

    //assign state value to formData
    formData.append("offered_price", offered_price.value);
    formData.append("notes", notes.value);
    formData.append("phone_number", phone_number.value);
    formData.append("id_property", id_property.value); 

    await api.post('/api/offers', formData)
        .then(() => {
            router.push({ path: "/" });
        })
        .catch((error) => {

            errors.value = error.response.data;
        });
};
</script>

<template>
    <div class="form-container">
        <h1>Ajukan Penawaran</h1>
        <form @submit.prevent="storePost()">
            <div class="form-group">
                <label for="offered_price">Harga yang Diajukan:</label>
                <input type="number" id="offered_price" v-model="offered_price" required />
                <div v-if="errors.offered_price" class="alert alert-danger mt-2">
                    <span>{{ errors.offered_price[0] }}</span>
                </div>
            </div>

            <div class="form-group">
                <label for="notes">Catatan:</label>
                <textarea id="notes" v-model="notes" rows="4" required></textarea>
                <div v-if="errors.notes" class="alert alert-danger mt-2">
                    <span>{{ errors.notes[0] }}</span>
                </div>
            </div>

            <div class="form-group">
                <label for="phone_number">Nomor Telepon:</label>
                <input id="phone_number" v-model="phone_number" required />
                <div v-if="errors.phone_number" class="alert alert-danger mt-2">
                    <span>{{ errors.phone_number[0] }}</span>
                </div>
            </div>

            <button type="submit">Kirim</button>
        </form>

        <div v-if="submitted">
            <h2>Data yang Dikirim:</h2>
            <p><strong>Harga yang Diajukan:</strong> Rp{{ offered_price }}</p>
            <p><strong>Catatan:</strong> {{ notes }}</p>
            <p><strong>Nomor Telepon:</strong> {{ phone_number }}</p>
        </div>
    </div>
</template>