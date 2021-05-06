<template>
  <div id="appli">
    <header role="banner">
      <nav class="green lighten-3">
        <Navbar :isLoggedIn="this.isLoggedIn" :key="$route.fullPath"/>
      </nav>
    </header>
    <main role="main">
     <router-view></router-view>
    </main>
  </div>
</template>

<script>
  import Navbar from './Navbar';
  import Search from './Search';
  import Accueil from './Accueil';
  import Dashboard from './Dashboard';
  import AjoutForm from './AjoutForm';
  import Detail from './Detail';

  export default {
    computed: {
      isLoggedIn() {
        return  localStorage.getItem('user-token') != null;
      }
    },
    components: {
      Navbar,
      Search,
      Accueil,
      Dashboard,
      AjoutForm,
      Detail
    },
  }
</script>

