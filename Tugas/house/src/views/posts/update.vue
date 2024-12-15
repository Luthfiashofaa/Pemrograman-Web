<script setup>
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import api from "../../api";

const router = useRouter();
const route = useRoute();

const image = ref(null);
const price = ref("");
const type = ref("");
const location = ref("");
const landArea = ref("");
const buildingArea = ref("");
const bedrooms = ref("");
const bathrooms = ref("");
const errors = ref([]);
const previewImageUrl = ref(null);

onMounted(async () => {
  const response = await api.get(`/api/posts/${route.params.id}`).then((response) => {
    const post = response.data.data;

    location.value = post.location;
    price.value = post.price;
    type.value = post.type;
    landArea.value = post.land_area;
    buildingArea.value = post.building_area;
    bedrooms.value = post.bedrooms;
    bathrooms.value = post.bathrooms;
    previewImageUrl.value = post.image;

    image.value = null;
  }).catch((error) => {
    errors.value = error.response.data;
  });
});

const handleFileChange = (e) => {
  const file = e.target.files[0];
  if (file && file.type.startsWith("image/")) {
    image.value = file;
    const reader = new FileReader();
    reader.onload = () => {
      previewImageUrl.value = reader.result;
    };
    reader.readAsDataURL(file);
  } else {
    alert("Please choose a valid image file.");
  }
};

const updatePost = async () => {
  let formData = new FormData();

  if (image.value) {
    formData.append("image", image.value);
  }
  
  formData.append("price", price.value);
  formData.append("type", type.value);
  formData.append("location", location.value);
  formData.append("land_area", landArea.value);
  formData.append("building_area", buildingArea.value);
  formData.append("bedrooms", bedrooms.value);
  formData.append("bathrooms", bathrooms.value);
  formData.append("_method", "PATCH");

  await api
    .post(`/api/posts/${route.params.id}`, formData)
    .then(() => {
      router.push({ path: "/myproperties" });
    })
    .catch((error) => {
      console.log("API error response:", error.response.data);
      errors.value = error.response.data;
    });
};
</script>

<template>
<div class="container-post">
  <form @submit.prevent="updatePost">
      <h1>Update Properties</h1>
      <div class="title">
        <h6>Update your properties</h6>
        <button class="upload-btn" type="submit">Update</button>
      </div>
      <div class="about-product">
        <h1>Create Properties</h1>
        <h6>Provide information on your properties</h6>
        <div class="desc">
          <div class="form">
            <label for="location">Location</label>
            <input v-model="location" type="text" id="location" required />

            <div class="area">
              <label for="price">Price</label>
              <input v-model="price" type="number" id="price" required />

              <label for="type">Type</label>
              <input style="width: 130pt" v-model="type" type="text" id="type" required />
            </div>

            <div class="area">
              <label for="LA">Land Area</label>
              <input v-model="landArea" type="number" id="LA" required />

              <label for="BA">Building Area</label>
              <input style="width: 112pt" v-model="buildingArea" type="number" id="BA" required />
            </div>

            <div class="area">
              <label for="bedrooms">Bedrooms</label>
              <input v-model="bedrooms" type="number" id="bedrooms" required />

              <label for="bathrooms">Bathrooms</label>
              <input style="width: 80pt" v-model="bathrooms" type="number" id="bathrooms" required />
            </div>
          </div>

          <div class="upload-img">
            <label for="file-input" class="upload-label">
              <img src="/img/upload.png" alt="Upload Icon" />
              <span>Choose a file</span>
            </label>
            <input type="file" id="file-input" @change="handleFileChange" accept="image/*" />
            <img
              v-if="previewImageUrl"
              :src="previewImageUrl"
              style="width: 100%; max-width: 200px; max-height: 150px; object-fit: cover; border-radius: 5pt; margin-top: 20px; margin-left: 10pt; "
              alt="Preview Image"
            />
          </div>
        </div>
      </div>
  </form>
</div>
</template>
