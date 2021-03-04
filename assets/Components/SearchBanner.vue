<template>

    <div style="float:left; margin-top:50px; margin-left:12px;">
        <title>Recherche Restaurant/Producteur</title>
        <h1 style="font-size:18px;">Selectionnez</h1>
        <button v-on:click="showR=true, showP=false, showAll=false" id="b-restaurant" >Restaurant</button>
        <button v-on:click="showP=true, showR=false, showAll=false" id="b-producteur">Producteur</button>
        <button v-on:click="showAll=true" id="b-all">Tout</button>

        <SearchRestaurant v-show="showR || showAll"></SearchRestaurant>
        <SearchProducteur v-show="showP || showAll"></SearchProducteur>
    </div>
</template>

<script>
import SearchRestaurant from './SearchRestaurant';
import SearchProducteur from './SearchProducteur';
export default {
    name: "SearchBanner",
    components: {
     SearchRestaurant,
     SearchProducteur
    },
    data(){
        return{
            showR: false,
            showP: false,
            showAll: true
        }
    }
}

</script>