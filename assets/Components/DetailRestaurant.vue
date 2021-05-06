<template>
    <div class="detail-restaurant">
        <div class="container">
            <h1>
                {{restaurant.nom}}
            </h1>
            <p>
                {{restaurant.description}}
            </p>
            <ul class="collection with-header">
                <li class="collection-header"><h2>Plats</h2></li>
                <div v-for="plat in plats" v-bind:key="plat.id">
                    <li v-show="plat.restaurateur_id == restaurant.id" class="collection-item">
                        <div>{{plat.nom}} - {{plat.prix}}€
                            <div class="secondary-content">
                                <button v-on:click="ajoutAuPanier(plat.id)" class="waves-effect waves-light btn">
                                    <i class="material-icons">add</i>
                                </button>
                                {{panier.filter(pan => pan.id == plat.id).length}}
                                <button v-on:click="supprimerDuPanier(plat.id)" class="waves-effect waves-light btn red">
                                    <i class="material-icons">remove</i>
                                </button>
                            </div>
                        </div>
                    </li>
                </div>
            </ul>
            <div class="commander">
                <button class="waves-effect waves-light btn">Commander ({{panier.length}})</button>
            </div>
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
            panier: [],
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
    methods: {
        ajoutAuPanier(id) {
            var plat = this.plats.find(plat => plat.id == id);
            console.log(plat);
            this.panier.push(plat);
            console.log("Ajout");
            console.log(this.panier);
        },
        supprimerDuPanier(id) {
            var plat = this.plats.filter(plat => plat.id == id)
            if(this.panier.includes(plat[0])) {
                var idx = this.panier.findIndex(p => p.id == id);
                var removed = this.panier.splice(idx, 1);
                console.log("Suppression");
                console.log(this.panier)
            }
        }
    }
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
