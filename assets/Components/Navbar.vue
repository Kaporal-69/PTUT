<template>
  <nav class="green darken-1">
    <div class="nav-wrapper">
      <a href="/accueil" class="brand-logo">Logo</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <!-- <li><a href="">Panier</a></li> -->
        <li><a href="/search">Rechercher</a></li>
        <li><a href="/dashboard">Mon Compte</a></li>
        <li v-if="!isLoggedIn"><a href="/login">Se connecter</a></li>
        <li v-else><a v-on:click="logout()" >Se déconnecter</a></li>

      </ul>
      <ul id="nav-mobile" class="right hide-on-large-only">
        <li><a href="/search"><i class="material-icons">search</i></a></li>
        <li><a href="/dashboard"><i class="material-icons">account_box</i></a></li>
        <li v-if="!isLoggedIn"><a href="/login"><i class="material-icons">login</i></a></li>
        <li v-else><a v-on:click="logout()"><i class="material-icons">login</i></a></li>
      </ul>
    </div>
  </nav>
</template>

<script>

  export default {
    data: function() {
      return {
        greeting: "Hello world",
        isLoggedIn: false
      };
    },
    methods: {
      logout() {
        localStorage.getItem('user-token') == '';
        this.isLoggedIn = false;
      }
    },
    beforeMount() {
        if(localStorage.getItem('user-token') === "undefined") {
            this.isLoggedIn = false;
        } else {
           this.isLoggedIn = true;
        }
    }
  };
</script>