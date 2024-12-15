//import vue router 
import { createRouter, createWebHistory } from 'vue-router' 
 
 
//define a routes 
const routes = [ 
    { 
        path: '/', 
        name: 'home', 
        component: () => import( '../views/home.vue'),
  
    }, 
    { 
        path: '/myproperties', 
        name: 'create', 
        component: () => import('../views/posts/create.vue') 
    }, 
    { 
        path: '/update/:id', 
        name: 'posts.edit', 
        component: () => import( /* webpackChunkName: "edit" */ '../views/posts/update.vue') 
    },
    { 
        path: '/offer/:id', 
        name: 'offer.create', 
        component: () => import( /* webpackChunkName: "edit" */ '../views/posts/create_offer.vue') 
    },
    { 
        path: '/offer', 
        name: 'offer.view', 
        component: () => import( /* webpackChunkName: "edit" */ '../views/posts/list_offer.vue') 
        
    } ,
    { 
        path: '/offer', 
        name: 'offer.view', 
        component: () => import( /* webpackChunkName: "edit" */ '../views/posts/list_offer.vue') 
        
    } 
] 
 
//create router 
const router = createRouter({ 
    history: createWebHistory(), 
    routes // <-- routes, 
}) 

router.beforeEach((to, from, next) => {
    const isAuthenticated = !!localStorage.getItem('token');
  
    if (to.meta.requiresAuth && !isAuthenticated) {
      next('/login');
    } else {
      next();
    }
  });
  
 
export default router 