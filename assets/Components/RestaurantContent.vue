<template>
    <div id="restaurant">
        <h1>Restaurants à proximité</h1>
        <div class="restaurant-container">
            <div class="card" v-for="restaurant in restaurants" v-bind:key="restaurant.nom">
                <div class="card-image">
                    <a href="#">
                        <img :src="restaurant.image" :alt="'Image du restaurant'">
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
    import axios from 'axios';

    export default {
        name: "RestaurantContent",
        data() {
            return {
                restaurants: [
                ]
            }
        },
        beforeCreate() {
            axios.get('/api/restaurateurs', {
                    })
                    .then(response => {
                        if (response.status == 200) {
                            let resto = null;
                            let restaurateurs = [];
                            for(let i = 0; i<response.data["hydra:member"].length; i++) {
                                resto = response.data["hydra:member"][i];
                                let restoData = {
                                    nom: resto.id,
                                    adresse: resto.adresse + " " + resto.codePostal + " " + resto.ville,
                                    image: image
                                }
                                restaurateurs.push(restoData);
                            }
                            this.restaurants = restaurateurs;
                        } else {
                            // console.log(response.status);
                            this.error = response.message;
                            console.log("error " + this.error);
                        }
                        
                        //this.$emit('user-authenticated', userUri);
                        //this.email = '';
                        //this.password = '';
                        // router.go('/accueil')
                    }).catch(error => {
                        console.log(error);
                        if(error.response.status == 401) {
                            this.error = "Nous n'avons pas pu vous identifier, veuillez vérifier votre adresse et votre mot de passe."
                        } else {
                            this.error = error.response.message;
                        }
                    }).finally(() => {
                        this.isLoading = false;
                        // localStorage.setItem('user-token', token);
                        // this.$router.push('/accueil')
                    })
            },
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