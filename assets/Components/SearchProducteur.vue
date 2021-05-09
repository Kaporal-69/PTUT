<template>
<div id="producteur" style="float:right;">
    <h3>Liste de Producteur</h3>
    <div class="producteur-container">
        <div class="card" v-for="producteur in producteurs" v-bind:key="producteur.id" @click="onClickCard(producteur.id)" style="cursor: pointer;">
            <div class="card-image" >
                <div>
                    <img :src="producteur.image" style="width:15%; float:left;" :alt="'Image du producteur'">
                </div> 
                <div class="card-content" style="line-height:35px; margin-left:15%;">
                    <h5>{{producteur.nom}}</h5>
                    <p>{{producteur.adresse}}</p>
                    <p>{{producteur.description}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import image from '../images/placeholder.png'
export default {
        name: "SearchProducteur",
        data() {
            return {
                producteurs: [
                    {
                        id: 1,
                        nom: "Aux ptit gourmand",
                        adresse: "rue du bonheur",
                        description: "ici une description",
                        image: image
                    },
                    {
                        id: 2,
                        nom: "Produit de la ferme",
                        adresse: "3 rue de la jungle",
                        description: "ici une description",
                        image: image
                    },
                    {
                        id: 3,
                        nom: "exotic box",
                        adresse: "45 avenue papaya",
                        description: "ici une description",
                        image: image
                    }
                ]
            }
        },
        methods: {
            onClickCard(id) {
                // console.log(id);
                this.$router.push({name: 'detail', params: {id: id, detail: 'producteur'}});
            }
        },
    }
</script>