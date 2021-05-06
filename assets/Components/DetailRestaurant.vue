<template>
    <div class="detail-restaurant">
        <div class="container">
            <h1>
                {{this.restaurant.nom}}
            </h1>
            <p>
                {{this.restaurant.description}}
            </p>
            <ul class="collection with-header">
                <li class="collection-header"><h2>Plats</h2></li>
                <div v-for="plat in plats" v-bind:key="plat.id">
                    <li v-show="plat.restaurateur_id == this.restaurant.id" class="collection-item"><div>{{plat.nom}} - {{plat.prix}}€ <a href="#" class="secondary-content">Commander</a></div></li>
                </div>
            </ul>
        </div>
    </div>
</template>

<script>
import image from '../images/placeholder.png'
import axios from 'axios';

export default {
    name: "DetailRestaurant",
    props: ['id'],
    data() {
        return {
            restaurant: 
                    {
                        id: this.id,
                        nom: "Laska",
                        adresse: "13 Rue Terraille, 69001 Lyon",
                        description: "Recettes végétariennes à base de produits bio midi et soir dans une salle intime et cosy aux matières brutes.",
                        image: image
                    },
            plats: [
                    {
                        id: 1,
                        restaurateur_id: 3,
                        nom: "Pomme de terre au four , carotte fondante et tombée d’épinards ",
                        prix: 12,
                        image: image
                    },
                    {
                        id: 2, 
                        restaurateur_id: 3,
                        nom: "Wok de légumes au cacahuètes à l’asiatique et crème de chou-fleur",
                        prix: 10,
                        image: image
                    }
                ]
        }
    },
    // mounted() {
    //     this.getRestaurateurById()
    // },
    // methods: {
    //     getRestaurateurById() {
    //         console.log(this.restaurant.id);
    //         axios.get('/api/restaurateurs/' + this.restaurant.id, { 
    //                 })
    //                 .then(response => {
    //                     if (response.status == 200) {
    //                         let resto = null;
    //                         // let restaurateurs = [];
    //                         for(let i = 0; i<response.data["hydra:member"].length; i++) {
    //                             resto = response.data["hydra:member"][i];
    //                             let restoData = {
    //                                 id: resto.id,
    //                                 nom: resto.nomEtablissement,
    //                                 adresse: resto.adresse + " " + resto.codePostal + " " + resto.ville,
    //                                 image: image
    //                             }
    //                             // restaurateurs.push(restoData);
    //                             // console.log(restaurateurs);
    //                             console.log(restoData)
    //                         }
    //                         this.restaurant = restoData;
    //                         // this.restaurants = restaurateurs;
    //                     } else {
    //                         // console.log(response.status);
    //                         this.error = response.message;
    //                         console.log("error " + this.error);
    //                     }
                        
    //                     //this.$emit('user-authenticated', userUri);
    //                     //this.email = '';
    //                     //this.password = '';
    //                     // router.go('/accueil')
    //                 }).catch(error => {
    //                     console.log(error);
    //                     if(error.response.status == 401) {
    //                         this.error = "Nous n'avons pas pu vous identifier, veuillez vérifier votre adresse et votre mot de passe."
    //                     } else {
    //                         this.error = error.response.message;
    //                     }
    //                 }).finally(() => {
    //                     this.isLoading = false;
    //                     // localStorage.setItem('user-token', token);
    //                     // this.$router.push('/accueil')
    //                 })
    //         }, 
    // }
}
</script>
