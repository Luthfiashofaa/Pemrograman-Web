<script setup>
import { ref, onMounted } from "vue";
import api from "../../api";

const offers = ref([]);
const posts = ref([]);
const editedOffer = ref(null);
const isEditing = ref(false); 

const fetchDataOffer = async () => {
    const response = await api.get("/api/offers");
    offers.value = response.data.data.data || [];
};

const fetchDataPosts = async () => {
    const response = await api.get("/api/posts");
    posts.value = response.data.data.data || [];
};

onMounted(() => {
    fetchDataOffer();
    fetchDataPosts();
});

const deletePost = async (id) => {
  try {
    await api.delete(`/api/offers/${id}`);
    fetchDataOffer();
  } catch (error) {
    console.error("Error deleting post:", error);
  }
};

const startEdit = (offer) => {
    editedOffer.value = { ...offer };
    isEditing.value = true;
};

const saveEdit = async () => {
    try {
        await api.put(`/api/offers/${editedOffer.value.id}`, {
            offered_price: editedOffer.value.offered_price,
            notes: editedOffer.value.notes,
            phone_number: editedOffer.value.phone_number
        });
        fetchDataOffer();  
        isEditing.value = false;
    } catch (error) {
        console.error("Error saving post:", error);
    }
};

</script>


<template>
    <div style="padding: 20pt; margin-top: 30pt;">
        <h1 style="margin-top: 50pt;color: white;">Daftar Tawaran</h1>

        <div v-if="isEditing" style="background-color: #f4f4f4; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
            <h3>Edit Tawaran</h3>
            <form @submit.prevent="saveEdit">
                <div>
                    <label for="offered_price">Harga Penawaran (Rp):</label>
                    <input type="number" id="offered_price" v-model="editedOffer.offered_price" required>
                </div>
                <div>
                    <label for="notes">Catatan:</label>
                    <textarea id="notes" v-model="editedOffer.notes" required></textarea>
                </div>
                <div>
                    <label for="phone_number">Nomor Telepon:</label>
                    <input type="text" id="phone_number" v-model="editedOffer.phone_number" required>
                </div>
                <button type="submit" style="margin-right: 10pt; margin-top: 20pt;">Simpan</button>
                <button type="button" @click="isEditing = false">Batal</button>
            </form>
        </div>

        <table style="background-color: #f4f4f4;">
            <thead>
                <tr>
                    <th>Property</th>
                    <th>Harga Penawaran (Rp)</th>
                    <th>Catatan</th>
                    <th>Nomor Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="offers.length == 0">
                    <td colspan="5" class="text-center">
                        <div class="alert alert-danger mb-0">
                            Data Belum Tersedia!
                        </div>
                    </td>
                </tr>
                <tr v-for="(offer, index) in offers" :key="offer.id">
                    <td>
                        <div v-for="(post, index) in posts" :key="post.id_property" style="padding: 0;">
                            <img style="width: 150pt;" :src="post.image" alt="home" />
                            <h3 style="font-size: 10pt; margin-top: 10pt;">{{ post.price }} juta - {{ post.location }} </h3>
                            <h5 style="font-size: 10pt;">Rumah Tipe {{ post.type }} - {{ post.bedrooms }} kamar tidur {{ post.bathrooms }} kamar mandi</h5>
                            <h5 style="font-size: 10pt;">LT : {{ post.land_area }} LB : {{ post.building_area }}</h5>
                        </div>
                    </td>
                    <td>Rp {{ offer.offered_price }} juta</td>
                    <td>{{ offer.notes }}</td>
                    <td>{{ offer.phone_number }}</td>
                    <td class="action-buttons">
                        <button @click="startEdit(offer)" class="btn btn-warning" style="border: none; background: transparent; cursor: pointer;">
                            <img src="/img/edit.png" alt="" style="width:25px; height:auto; margin-top:10pt">
                        </button>
                        <button @click.prevent="deletePost(offer.id)" class="btn btn-danger" style="border: none; background: transparent; cursor: pointer;">
                            <img src="/img/trash.png" alt="" style="width:25px; height:auto">
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
