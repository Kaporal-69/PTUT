<template>
<div id="restaurant" style="float:right;">
    <h1>Liste de Restaurant</h1>
    <div class="restaurant-container">
        <div class="card" v-for="restaurant in restaurants" v-bind:key="restaurant.id" @click="onClickCard(restaurant.id)" style="cursor: pointer;">
            <div class="card-image" >
                <div>
                    <img :src="restaurant.image" style="width:15%; float:left" :alt="'Image du restaurant'">
                </div> 
                <div class="card-content" style="line-height:35px; margin-left:15%;">
                    <h5>{{restaurant.nom}}</h5>
                    <p>{{restaurant.adresse}}</p>
                    <p>{{restaurant.description}}</p>
                </div>
                
            </div>
           
        </div>
    </div>
</div>
</template>

<script>
import image from '../images/placeholder.png'
import axios from 'axios';

export default {
        name: "SearchRestaurant",
        data() {
            return {
                restaurants: []
                // restaurants: [
                //     {
                //         nom: "McDonald",
                //         adresse: "rue du bonheur",
                //         description: "ici une description",
                //         image: image
                //     },
                //     {
                //         nom: "Burger's",
                //         adresse: "3 rue de la jungle",
                //         description: "ici une description",
                //         image: image
                //     },
                //     {
                //         nom: "China Exupery",
                //         adresse: "45 avenue ChinaTown",
                //         description: "ici une description",
                //         image: image
                //     }
                // ]
            }
        },
        methods: {
            onClickCard(id) {
                // console.log(id);
                this.$router.push({name: 'detail', params: {id: id, detail: 'restaurant'}});
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
                                    id: resto.id,
                                    nom: resto.nomEtablissement,
                                    adresse: resto.adresse + " " + resto.codePostal + " " + resto.ville,
                                    image: image
                                }
                                restaurateurs.push(restoData);
                                console.log(restaurateurs);
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