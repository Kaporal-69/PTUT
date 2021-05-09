<template>
    <div class="detail-producteur">
        <div class="container">
            <h1>
                {{producteur.nom}}
            </h1>
            <p>
                {{producteur.description}}
            </p>
            <ul class="collection with-header">
                <li class="collection-header"><h2>produits</h2></li>
                <li v-for="produit in produits" v-bind:key="produit.id" v-show="produit.producteur_id == producteur.id" class="collection-item">
                    <div>{{produit.nom}} - {{produit.prix}}€
                        <div class="secondary-content">
                            <button v-on:click="ajoutAuPanier(produit.id)" class="waves-effect waves-light btn">
                                <i class="material-icons">add</i>
                            </button>
                            {{panier.filter(pan => pan.id == produit.id).length}}
                            <button v-on:click="supprimerDuPanier(produit.id)" class="waves-effect waves-light btn red">
                                <i class="material-icons">remove</i>
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="total-commande">Total de votre commande : {{prixTotal(panier)}}€</div>
            <div class="commander">
                <button class="waves-effect waves-light btn red" style="margin-right: 2px;" @click="$router.go(-1)">RETOUR</button>
                <router-link
                    to="/commande"
                    v-show="panier.length > 0">
                    <button class="waves-effect waves-light btn" @click="addPanierToLocalStorage(panier)">Commander ({{panier.length}})</button>
                </router-link>
            </div>
            <!-- <div v-show="errorMessage"><span class="red-text">Votre panier est vide!</span></div> -->
        </div>
    </div>
</template>

<script>
import image from '../images/placeholder.png'
import axios from 'axios';

export default {
    name: "DetailProducteur",
    props: ['id'],
    data() {
        return {
            errorMessage: false,
            panier: [],
            producteur: 
                    {
                        id: this.id,
                        nom: "Nom",
                        adresse: "98, boulevard Grégoire Munoz, 1000 Bourg en Bresse"
                    },
            produits: [
                    {
                        id: 1,
                        producteur_id: 1,
                        nom: "Boeuf",
                        prix: 12,
                        image: image
                    },
                    {
                        id: 2, 
                        producteur_id: 1,
                        nom: "Poulet",
                        prix: 6.50,
                        image: image
                    }
                ]
        }
    },
    methods: {
        ajoutAuPanier(id) {
            if(this.errorMessage) 
                this.errorMessage = false;
            var produit = this.produits.find(produit => produit.id == id);
            console.log(produit);
            this.panier.push(produit);
            console.log("Ajout");
            console.log(this.panier);
        },
        supprimerDuPanier(id) {
            var produit = this.produits.filter(produit => produit.id == id)
            if(this.panier.includes(produit[0])) {
                var idx = this.panier.findIndex(p => p.id == id);
                var removed = this.panier.splice(idx, 1);
                console.log("Suppression");
                console.log(this.panier)
            }
        },
        addPanierToLocalStorage(panier) {
            if(panier.length > 0) {
                const parsed = JSON.stringify(panier);
                localStorage.setItem('panier', parsed);
            }
            else {
                this.errorMessage = true;
            }
            
        },
        prixTotal(panier) {
            var prixTotal = 0;
            panier.map(i => prixTotal += i.prix);
            return prixTotal;
        }
    }
    // mounted() {
    //     this.getRestaurateurById()
    // },
    // methods: {
    //     getRestaurateurById() {
    //         console.log(this.producteur.id);
    //         axios.get('/api/restaurateurs/' + this.producteur.id, { 
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
    //                         this.producteur = restoData;
    //                         // this.producteurs = restaurateurs;
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

<style scoped>
.collection .collection-item {
    line-height: 3;
}

.total-commande {
    font-size: 22px;
}
</style>
