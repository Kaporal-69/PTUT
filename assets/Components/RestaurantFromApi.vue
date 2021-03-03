<template>
    <div id="restaurant">
        <h3>TEST</h3>
        <!-- <div class="restaurant-container">
            <div class="card" v-for="restaurant in restaurants" v-bind:key="restaurant.id">
                <div class="card-image">
                    <a href="#">
                        <img :src="image">
                    </a>
                </div>
                <div class="card-content">
                    <span class="card-title">{{restaurant.id}}</span>
                    <p>{{restaurant.adresse}}</p>
                </div>
            </div>
        </div> -->
        <span>TEST RECUP VALEUR DEPUIS L'API (CHECK CONSOLE LOG)</span>
    </div>
</template>

<script>
    import image from '../images/placeholder.png';
    import axios from 'axios';

    export default {
        name: "RestaurantContent",
        computed: {

        },
        created() {
            console.log("test log")
            this.fetchRestaurateurs();
        },
        methods: {
            fetchRestaurateurs() {
                axios.get('/getrestaurateurs')
                .then(res => {
                    console.log("data : ");
                    console.log(res);
                })
                .catch(err => {
                    console.log('Erreur : ' + err);
                })
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
        margin: .5rem 0em 1rem 1.65em;
    }
</style>