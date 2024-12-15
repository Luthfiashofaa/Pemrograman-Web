<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const email = ref('');
const password = ref('');
const errorMessage = ref('');
const router = useRouter();

const setAuthHeader = (token) => {
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
};

const handleLogin = async () => {
  try {
    const response = await axios.post('http://localhost:8000/api/login', {
      email: email.value,
      password: password.value,
    });
    if (response.data && response.data.token) {
      localStorage.setItem('token', response.data.token);
      setAuthHeader(response.data.token);
      router.push('/');
    } else {
      errorMessage.value = 'Token tidak ditemukan dalam respons!';
    }
  } catch (error) {
    if (error.response) {
      console.error('Response error:', error.response);
      if (error.response.status === 401) {
        errorMessage.value = 'Email atau password salah.';
      } else {
        errorMessage.value = error.response.data.message || 'Login failed';
      }
    } else if (error.request) {
      console.error('Request error:', error.request);
      errorMessage.value = 'Tidak ada respons dari server.';
    } else {
      console.error('Error:', error.message);
      errorMessage.value = 'Terjadi kesalahan saat memproses permintaan.';
    }
  }
};
</script>

<template>
  <div class="container-login">
    <div class="img">
      <img src="/img/login.jpg" alt="background" />
    </div>

    <form @submit.prevent="handleLogin" style="display: flex; justify-content:center">
      <div class="login">
        <h1>Sign In</h1>
        <p style="color: white; margin-top: 0">
          Don't have an account? 
          <router-link to="/register" style="text-decoration: none">
              <a class="register-btn" href="/register">Register</a>
          </router-link>  
        </p>
        <input 
          style="width: 530px" 
          type="text" 
          id="email" 
          placeholder="Email" 
          v-model="email" 
          required
        >
        <input 
          style="width: 530px" 
          type="password" 
          id="password" 
          placeholder="Password" 
          v-model="password" 
          required
        >
        <button type="submit" class="login-btn">Login</button>
        <p v-if="errorMessage" style="color: red; margin-top: 10px">{{ errorMessage }}</p>
      </div>
    </form>
  </div>
</template>