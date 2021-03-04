<template>
  <nav class="green darken-1">
    <div class="nav-wrapper">
      <a href="/accueil" class="brand-logo">Logo</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <!-- <li><a href="">Panier</a></li> -->
        <li><a href="/search">Rechercher</a></li>
        <li><a href="/dashboard">Mon Compte</a></li>
        <li><a href="/login">Se connecter</a></li>
      </ul>
      <ul id="nav-mobile" class="right hide-on-large-only">
        <li><a href="/search"><i class="material-icons">search</i></a></li>
        <li><a href="/dashboard"><i class="material-icons">account_box</i></a></li>
        <li><a href="/login"><i class="material-icons">login</i></a></li>
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