<script>
import { ref } from "vue";
export default {
  data() {
    return {
      isVisible: false,
      username: "Luthfia",
    };
  },
  methods: {
    toggleMenu(event) {
      event.stopPropagation();
      this.isVisible = !this.isVisible;
    },
    handleClickOutside(event) {
      const subMenu = this.$refs.subMenu;
      const username = this.$refs.username;
      if (
        subMenu &&
        !subMenu.contains(event.target) &&
        username &&
        !username.contains(event.target)
      ) {
        this.isVisible = false;
      }
    },
  },
  mounted() {
    document.addEventListener("click", this.handleClickOutside);
  },
  beforeDestroy() {
    document.removeEventListener("click", this.handleClickOutside);
  },
};
</script>


<template>
  <header-nav>
    <div class="logo">
      <img src="/img/logo.png" alt="logo" />
    </div>
    <nav>
      <ul>
        <li><router-link :to="{ name: 'home' }" class="navbar-brand">About Us</router-link></li>
        <li><router-link :to="{ name: 'home' }" class="navbar-brand">Catalog</router-link></li>
        <li><router-link :to="{ name: 'home' }" class="navbar-brand">Contact Us</router-link></li>
      </ul>
    </nav>
    <div id="username" style="color: white; margin-left: 110pt" ref="username">Welcome, <a style="color: white "
        href="#" @click.prevent="toggleMenu">{{ username }}!</a>
    </div>

    <div id="sub-menu-wrap" class="sub-menu-wrap" v-bind:class="{ visible: isVisible }" ref="subMenu">
      <div class="sub-menu" style="gap: 10pt;">
        <a href="#">
          <img style="width: 15px; height: 15px" src="/img/profile.png" alt="" />
          <h1 style="font-size: 10pt; margin-top: 6pt;">Profile settings</h1>
        </a>
        <router-link to="/myproperties" style="text-decoration: none">
          <a href="">
            <img style="width: 15px; height: 15px" src="/img/properties.png" alt="" />
            <h1 style="font-size: 10pt; margin-top: 6pt;">My Properties</h1>
          </a>
        </router-link>

        <router-link to="/offer" style="text-decoration: none">
          <a href="">
            <img style="width: 15px; height: 15px" src="/img/offer.png" alt="" />
            <h1 style="font-size: 10pt; margin-top: 6pt;">My Offer</h1>
          </a>
        </router-link>

      </div>
    </div>
  </header-nav>
  <router-view></router-view>
</template>
