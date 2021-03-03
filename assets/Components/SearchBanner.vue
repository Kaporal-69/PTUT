<template>
    <div style="float:left; margin-top:50px; margin-left:15px;">
        <h6>Selectionnez</h6>
        <button v-on:click="showR=true, showP=false" id="b-restaurant" >Restaurant</button>
        <button v-on:click="showP=true, showR=false" id="b-producteur">Producteur</button>
        <button v-on:click="showP=true, showR=true" id="b-producteur">Tout</button>

        <div style="float:right;">
            <SearchRestaurant v-show="showR"> </SearchRestaurant>
            <SearchProducteur v-show="showP"></SearchProducteur>
        </div>
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
            showP: false
        }
    }
}

</script>