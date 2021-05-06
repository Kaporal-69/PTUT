<template>
    <div id="accueil-content">
      <title>Acceuil</title>
      <!-- <div class="carousel">
        <a class="carousel-item" href="#one!">1</a>
        <a class="carousel-item" href="#two!">2</a>
        <a class="carousel-item" href="#three!">3</a>
        <a class="carousel-item" href="#four!">4</a>
        <a class="carousel-item" href="#five!">5</a>
      </div> -->
      <Map/>
      <RestaurantContent/>
      <NouveauteContent/>
      <PromotionContent/>
    </div>
</template>

<script>
    import RestaurantContent from './RestaurantContent';
    import NouveauteContent from './NouveauteContent';
    import PromotionContent from './PromotionContent';
    import Map from './Map';
    import M from 'materialize-css';

  export default {
    name: "Accueil",
    components: {
      RestaurantContent,
      NouveauteContent,
      PromotionContent,
      Map
    },
    data: {
      mounted() {
        var elems = document.querySelectorAll('.carousel');
        var instances = M.Carousel.init(elems, {
            fullWidth: true,
            indicators: true
        });
      }
    },
  }
</script>