<template>
<div id="appli">
  <nav class="green lighten-3">
    <Navbar />
  </nav>
  <Search />  
</div>
</template>

<script>
  import Navbar from './Navbar';
  import Search from './Search';

  export default {
    components: {
      Navbar,
      Search,
    },
  }
</script>

