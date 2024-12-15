<script>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import api from "../../api";


export default {
  setup() {
    const router = useRouter();
    const posts = ref([]);
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

    const fetchDataPosts = async () => {
      await api.get("/api/posts").then((response) => {
        console.log(response.data.data.data);
        posts.value = response.data.data.data;
      });
    };

    const deletePost = async (id) => {
      await api.delete(`/api/posts/${id}`).then(() => {

        fetchDataPosts();
      });
};

    onMounted(async () => {
      await fetchDataPosts();
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

    
    const storePost = async () => {
      let formData = new FormData();
      formData.append("image", image.value);
      formData.append("price", price.value);
      formData.append("type", type.value);
      formData.append("location", location.value);
      formData.append("land_area", landArea.value);
      formData.append("building_area", buildingArea.value);
      formData.append("bedrooms", bedrooms.value);
      formData.append("bathrooms", bathrooms.value);

      const response = await api.post("/api/posts", formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      });

      alert("Property uploaded successfully!");

      price.value = "";
      type.value = "";
      location.value = "";
      landArea.value = "";
      buildingArea.value = "";
      bedrooms.value = "";
      bathrooms.value = "";
      image.value = null;
      previewImageUrl.value = null;
      
      router.push({ path: "/myproperties" });
    };

    return {
      posts,
      price,
      type,
      location,
      landArea,
      buildingArea,
      bedrooms,
      bathrooms,
      errors,
      previewImageUrl,
      handleFileChange,
      storePost,
      deletePost,
    };
  },
};
</script>

<template>
  <div>
    <form @submit.prevent="storePost">
      <div class="container-post">
        <h1>Upload Properties</h1>
        <div class="title">
          <h6>Upload and share your properties</h6>
          <button class="upload-btn" type="submit">Upload</button>
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
                <input
                  style="width: 112pt"
                  v-model="type"
                  type="text"
                  id="type"
                  required
                />
              </div>
              <div class="area">
                <label for="LA">Land Area</label>
                <input v-model="landArea" type="number" id="LA" required />
                <label for="BA">Building Area</label>
                <input
                  style="width: 98pt"
                  v-model="buildingArea"
                  type="number"
                  id="BA"
                  required
                />
              </div>
              <div class="area">
                <label for="bedrooms">Bedrooms</label>
                <input
                  style="width: 107pt"
                  v-model="bedrooms"
                  type="number"
                  id="bedrooms"
                  required
                />
                <label for="bathrooms">Bathrooms</label>
                <input
                  style="width: 107pt"
                  v-model="bathrooms"
                  type="number"
                  id="bathrooms"
                  required
                />
              </div>
            </div>
            <div class="upload-img">
              <label for="file-input" class="upload-label">
                <img src="/img/upload.png" alt="" />
                <span>Choose a file</span>
              </label>
              <input
                type="file"
                id="file-input"
                @change="handleFileChange"
                accept="image/*"
              />
              <img
                v-if="previewImageUrl"
                :src="previewImageUrl"
                style="
                  width: 100%;
                  max-width: 200px;
                  max-height: 150px;
                  object-fit: cover;
                  border-radius: 5pt;
                  margin-top: 20px;
                  margin-left: 10pt;
                "
                alt="Preview Image"
              />
            </div>
          </div>
        </div>
      </div>
    </form>

    <div class="list-home">
      <div v-for="(post, index) in posts" :key="index" class="home">
        <img v-if="post.image" :src="post.image" alt="home" />
        <h3>{{ post.price }} juta</h3>
        <h5>Rumah Tipe {{ post.type }} - {{ post.bedrooms }} kamar</h5>
        <h6>{{ post.location }}</h6>
        <hr />
        <h5>LT : {{ post.land_area }} LB : {{ post.building_area }}</h5>
        <h5 style="margin-bottom: 10pt">
          {{ post.bedrooms }} kamar tidur, {{ post.bathrooms }} kamar mandi
        </h5>
        <div class="icon" style="display: flex; flex-direction: row">
          <button
            @click.prevent="deletePost(post.id)"
            type="button"
            class="btn btn-danger"
            style="border: none; background: transparent; cursor: pointer"
          >
            <img
              src="/img/trash.png"
              alt="Delete"
              style="width: 25px; height: auto"
            />
          </button>

          <router-link :to="{ name: 'posts.edit', params: { id: post.id } }">
            <a
              type="submit"
              class="btn btn-danger"
              style="border: none; background: transparent; cursor: pointer"
            >
              <img
                src="/img/edit.png"
                alt=""
                style="width: 25px; height: auto; margin-top: 10pt"
              />
            </a>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>
