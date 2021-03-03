<template>
<div id="restaurant" style="float:right;">
    <h3>Liste de Restaurant</h3>
    <div class="restaurant-container">
        <div class="card" v-for="restaurant in restaurants" v-bind:key="restaurant.nom">
            <div class="card-image" >
                <a href="#">
                    <img :src="restaurant.image" style="width:15%; float:left">
                </a> 
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
export default {
        name: "SearchRestaurant",
        data() {
            return {
                restaurants: [
                    {
                        nom: "McDonald",
                        adresse: "rue du bonheur",
                        description: "ici une description",
                        image: image
                    },
                    {
                        nom: "Burger's",
                        adresse: "3 rue de la jungle",
                        description: "ici une description",
                        image: image
                    },
                    {
                        nom: "China Exupery",
                        adresse: "45 avenue ChinaTown",
                        description: "ici une description",
                        image: image
                    }
                ]
            }
        }
    }
</script>