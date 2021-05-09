<template>
    <div id="accueil-content">
      <title>Accueil</title>
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

  export default {
    name: "Accueil",
    components: {
      RestaurantContent,
      NouveauteContent,
      PromotionContent,
      Map
    }
  }
</script>