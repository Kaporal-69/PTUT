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

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    routes: [
      { path: "/search", component: Search },
      { path: "*", redirect: "/search" }
    ]
  });

new Vue({ render: h => h(App) }).$mount('#app')