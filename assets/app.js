/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import 'materialize-css/dist/css/materialize.min.css';
import 'materialize-css/dist/js/materialize.min';

import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './Components/App.vue'
import Search from './Components/Search.vue'
import LoginForm from './Components/LoginForm.vue'
import RegisterForm from './Components/RegisterForm.vue'
import Accueil from './Components/Accueil.vue'
import Dashboard from './Components/Dashboard.vue'
import AjoutForm from './Components/AjoutForm.vue'


Vue.use(VueRouter);

export const router = new VueRouter({
    mode: "history",
    routes: [
      { path: "/login", component: LoginForm },
      { path: "/register", component: RegisterForm },
      { path: "/search", component: Search },
      { path: "/accueil", component: Accueil },
      { path: "/dashboard", component: Dashboard },
      { path: "/ajout", component: AjoutForm }
    ]
  });

new Vue({ 
  router, 
  render: h => h(App),
  created: function() {
    document.documentElement.setAttribute('lang', 'fr');
  }
 }).$mount('#app')