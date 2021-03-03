<template>
    <div id="restaurant">
        <h3>Restaurants à proximité</h3>
        <div class="restaurant-container">
            <div class="card" v-for="restaurant in restaurants" v-bind:key="restaurant.nom">
                <div class="card-image">
                    <a href="#">
                        <img :src="restaurant.image">
                    </a>
                </div>
                <div class="card-content">
                    <span class="card-title">{{restaurant.nom}}</span>
                    <p>{{restaurant.adresse}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import image from '../images/placeholder.png'
    export default {
        name: "RestaurantContent",
        data() {
            return {
                restaurants: [
                    {
                        nom: "Restau 1",
                        adresse: "222 rue aaaa",
                        image: image
                    },
                    {
                        nom: "Restau 2",
                        adresse: "223 rue bbbb",
                        image: image
                    },
                    {
                        nom: "Restau 3",
                        adresse: "224 rue cccc",
                        image: image
                    },
                    {
                        nom: "Restau 4",
                        adresse: "223 rue bbbb",
                        image: image
                    },
                    {
                        nom: "Restau 5",
                        adresse: "223 rue bbbb",
                        image: image
                    }
                ]
            }
        }
    }
</script>

<style scoped>
    .restaurant-container {
        display: flex;
        align-items: start;
    }

    .card {
        height: 350px;
        width: 350px;
        margin: .5em 0em 1em 1.65em;
    }
</style>