<template>
  <div id="appli">
    <header role="banner">
      <nav class="green lighten-3">
        <Navbar />
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

  export default {
    components: {
      Navbar,
      Search,
      Accueil,
      Dashboard
    },
  }
</script>

