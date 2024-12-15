<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";


import api from "../../api";

const router = useRouter();

const first_name = ref("");
const last_name = ref("");
const email = ref("");
const password = ref("");
const password_confirmation = ref("");


const storePost = async () => {
    try {
        let formData = new FormData();
        formData.append("first_name", first_name.value);
        formData.append("last_name", last_name.value);
        formData.append("email", email.value);
        formData.append("password", password.value);
        formData.append("password_confirmation", password_confirmation.value);

        await api.post('/api/users', formData);
        alert("Registration successful! Redirecting to login page.");

        router.push({ path: "/login" });
    } catch (error) {
        alert("Registration failed: " + error.response?.data?.message || "An unexpected error occurred.");
    }
};
</script>

<template>
    <div class="container-register">
        <div class="img">
            <img src="/img/login.jpg" alt="Background Image">
        </div>

        <form @submit.prevent="storePost" style="display: flex; justify-content:center">
            <div class="login" style="top:50%">
                <h1>Create an Account</h1>
                <p style="color: white; margin-top: 0">
                    Already have an Account? <a class="register-btn" href="/login">Login</a>
                </p>

                <div class="name">
                    <input
                        style="width: 192pt;"
                        v-model="first_name"
                        type="text"
                        id="first-name"
                        placeholder="First Name"
                        required
                    >
                    <input
                        style="width: 192pt; margin-left: 10pt"
                        v-model="last_name"
                        type="text"
                        id="last-name"
                        placeholder="Last Name"
                        required
                    >
                </div>

                <input
                    style="width: 395pt;"
                    v-model="email"
                    type="email"
                    id="email"
                    placeholder="Enter your email"
                    required
                >
                <input
                    style="width: 395pt;"
                    v-model="password"
                    type="password"
                    id="password"
                    placeholder="Enter your password"
                    required
                >

                <button type="submit" class="login-btn">Register</button>
            </div>
        </form>
    </div>
</template>
