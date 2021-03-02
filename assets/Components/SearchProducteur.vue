<template>
<div id="producteur" style="float:right;">
    <h3>Liste de Producteur</h3>
    <div class="producteur-container">
        <div class="card" v-for="producteur in producteurs" v-bind:key="producteur.nom">
            <div class="card-image" >
                <a href="#">
                    <img :src="producteur.image" style="width:15%; float:left;">
                </a> 
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
                        nom: "Aux ptit gourmand",
                        adresse: "rue du bonheur",
                        description: "ici une description",
                        image: image
                    },
                    {
                        nom: "Produit de la ferme",
                        adresse: "3 rue de la jungle",
                        description: "ici une description",
                        image: image
                    },
                    {
                        nom: "exotic box",
                        adresse: "45 avenue papaya",
                        description: "ici une description",
                        image: image
                    }
                ]
            }
        }
    }
</script>