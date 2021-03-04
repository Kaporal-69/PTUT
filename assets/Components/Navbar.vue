<template>
  <nav class="green lighten-3" role="navigation">
    <div class="nav-wrapper">
      <a href="/accueil" class="brand-logo">Logo</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <!-- <li><a href="">Panier</a></li> -->
        <li><a href="/search">Rechercher</a></li>
        <li><a href="/dashboard">Mon Compte</a></li>
        <li><a href="/login">Se connecter</a></li>
      </ul>
    </div>
  </nav>
</template>

<script>

  export default {
    data() {
      return {
        greeting: "Hello world"
      };
    }
  };
</script>