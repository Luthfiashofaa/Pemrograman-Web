<script setup>
import { ref, onMounted } from "vue";
import api from "../api";

const posts = ref([]); 
const fetchDataPosts = async () => {
  try {
    console.log("Fetching data from API...");
    const response = await api.get("/api/posts");
    console.log("API response:", response);
    posts.value = response.data.data.data;
    console.log("Data posts:", posts.value); 
  } catch (error) {
    console.error("Gagal mengambil data properti:", error);
  }
};

onMounted(() => {
  console.log("Component mounted. Fetching posts..."); 
  fetchDataPosts();
});


</script>


<template>
<div class="container-home" ref="homeSection">
    <img src="/img/background.jpg" alt="background" />
    <div class="description">
      <h1>Discover Your Dream Home or</h1>
      <h1>Sell Your Property Quickly and Easily</h1>
      <p>
        At FindSellHome, we make it easy for you to buy or sell your home with
        confidence —whether you're searching for your dream property or ready to
        list your own, our platform connects you with the right buyers and
        sellers for a seamless real estate experience
      </p>
    </div>
    <button style="color:black;" class="explore-button">
      Explore Our Catalog
      <img src="/img/arrow.png" alt="" />
    </button>
</div>

<div class="catalog">
    <h1 style="margin-top: 30pt">Recommended Properties:</h1>
    <h1 style="margin-top: -9pt">Find Your Perfect Match!</h1>
    <hr style="width: 95%" />
  </div>

  <section class="list-home">
    <div class="home">
      <img src="/img/home1.jpg" alt="home1" />
      <h3>Rp 250 Juta</h3>
      <h5>Rumah Tipe 36 - 2 kamar</h5>
      <h6>Surabaya</h6>
      <hr />
      <h5>LT : 60 m² LB : 36 m²</h5>
      <h5 style="margin-bottom: 10pt">2 kamar tidur, 2 kamar mandi</h5>
    </div>
    <div class="home">
      <img src="/img/home2.jpg" alt="home2" />
      <h3>Rp 500 Juta</h3>
      <h5>Rumah Tipe 75 - 3 kamar</h5>
      <h6>Malang</h6>
      <hr />
      <h5>LT : 75 m² LB : 50 m²</h5>
      <h5 style="margin-bottom: 10pt">3 kamar tidur, 2 kamar mandi</h5>
    </div>
    <div class="home">
      <img src="/img/home3.jpg" alt="home3" />
      <h3>Rp 100 Juta</h3>
      <h5>Rumah Tipe 30 - 2 kamar</h5>
      <h6>Mojokerto</h6>
      <hr />
      <h5>LT : 30 m² LB : 30 m²</h5>
      <h5 style="margin-bottom: 10pt">2 kamar tidur, 1 kamar mandi</h5>
    </div>
    <div class="home">
      <img src="/img/home4.jpg" alt="home4" />
      <h3>Rp 285 Juta</h3>
      <h5>Rumah Tipe 55 - 2 kamar</h5>
      <h6>Malang</h6>
      <hr />
      <h5>LT : 55 m² LB : 86 m²</h5>
      <h5 style="margin-bottom: 10pt">3 kamar tidur, 2 kamar mandi</h5>
    </div>
  </section>

  <section class="list-home">
    <div class="home">
      <img src="/img/home5.jpg" alt="home1" />
      <h3>Rp 450 Juta</h3>
      <h5>Rumah Tipe 75 - 3 kamar</h5>
      <h6>Bandung</h6>
      <hr />
      <h5>LT : 75 m² LB : 50 m²</h5>
      <h5 style="margin-bottom: 10pt">3 kamar tidur, 2 kamar mandi</h5>
    </div>
    <div class="home">
      <img src="/img/home6.jpg" alt="home2" />
      <h3>Rp 700 Juta</h3>
      <h5>Rumah Tipe 75 - 4 kamar</h5>
      <h6>Surabaya</h6>
      <hr />
      <h5>LT : 75 m² LB : 75 m²</h5>
      <h5 style="margin-bottom: 10pt">4 kamar tidur, 3 kamar mandi</h5>
    </div>
    <div class="home">
      <img src="/img/home7.jpg" alt="home3" />
      <h3>Rp 1 miliar</h3>
      <h5>Rumah Tipe 150 - 5 kamar</h5>
      <h6>Jakarta</h6>
      <hr />
      <h5>LT : 150 m² LB : 150 m²</h5>
      <h5 style="margin-bottom: 10pt">5 kamar tidur, 5 kamar mandi</h5>
    </div>

    <div class="home">
      <img src="/img/home8.jpg" alt="home4" />
      <h3>Rp 500 Juta</h3>
      <h5>Rumah Tipe 75 - 3 kamar</h5>
      <h6>Jakarta</h6>
      <hr />
      <h5>LT : 75 m² LB : 75 m²</h5>
      <h5 style="margin-bottom: 10pt">3 kamar tidur, 3 kamar mandi</h5>
    </div>
  </section>

  <section class="list-home">
    <div v-for="(post, index) in posts" :key="index" class="home">
      <img :src="post.image" alt="home" />

      <h3>{{ post.price }} juta</h3>
      <h5>Rumah Tipe {{ post.type }} - {{ post.bedrooms }} kamar</h5>
      <h6>{{ post.location }}</h6>
      <hr />
      <h5>LT : {{ post.land_area }} LB : {{ post.building_area }}</h5>
      <h5 style="margin-bottom: 10pt">
        {{ post.bedrooms }} kamar tidur, {{ post.bathrooms }} kamar mandi
      </h5>
      <router-link :to="{ name: 'offer.create', params: { id: post.id }}">
        <a
        type="submit"
        class="btn btn-danger"
        style="border: none; background: transparent; cursor: pointer"
      >
        <button class="offer-button" @click="openModal(post)">
          Submit an Offer
        </button>
      </a>
        </router-link>
    </div>
  </section>

  <a style="text-decoration: none" href="catalog.html">
    <button class="more-button">More</button>
  </a>

  <hr/>

  <footer>
    <div class="container-footer">
      <div class="contact">
        <h6>Contact</h6>
        <h5>House@gmail.com</h5>
        <h5>+62 810 123 098</h5>
      </div>
      <div class="sell">
        <h5 style="font-size: 30px">Want to sell your home?</h5>
        <button style="color:black;" class="call-button">Submit Your Offer</button>
      </div>

      <div class="address">
        <h5 style="margin-top: 20pt">Jakarta</h5>
        <h6 style="margin-top: 0">
          Jalan Ir. Soekarno No. 135 Jakarta Selatan
        </h6>
        <h5>Surabaya</h5>
        <h6 style="margin-top: 0">Jalan Hang Tuah No. 10 Surabaya</h6>
      </div>
    </div>
  </footer>

</template>
