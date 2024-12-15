//import createApp from Vue 
import { createApp } from 'vue'; 
//import component App 
import App from './App.vue'; 
//import config router 
import router from './router' 

import './assets/css/homepage.css';
import './assets/css/login.css';
import './assets/css/register.css';
import './assets/css/post.css';
import './assets/css/offer.css';


//create App Vue 
const app = createApp(App); 
//gunakan "router" di Vue dengan plugin "use" 
app.use(router); 
app.mount('#app'); 