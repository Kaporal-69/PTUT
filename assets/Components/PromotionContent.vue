<template>
    <div id="promotion">
        <h3>Promotions</h3>
        <div class="promotion-container">
            <div class="card" v-for="promotion in promotions" v-bind:key="promotion.nom">
                <div class="card-image">
                    <a href="#">
                        <img :src="promotion.image" :alt="'Image de la promotion'">
                    </a>
                </div>
                <div class="card-content">
                    <span class="card-title">{{promotion.nom}}</span>
                    <p>{{promotion.adresse}}</p>
                    <p>{{promotion.prix}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import image from '../images/placeholder.png'
    export default {
        name: "PromotionContent",
        data() {
            return {
                promotions: [
                    {
                        nom: "Restau 1",
                        adresse: "222 rue aaaa",
                        prix: null,
                        image: image
                    },
                    {
                        nom: "Produit 1",
                        adresse: "Nom Producteur",
                        prix: '15€',
                        image: image
                    },
                    {
                        nom: "Restau 2",
                        adresse: "224 rue cccc",
                        prix: null,
                        image: image
                    },
                    {
                        nom: "Produit 2",
                        adresse: "Nom Producteur",
                        prix: '11€',
                        image: image
                    },
                    {
                        nom: "Produit 3",
                        adresse: "Nom Producteur",
                        prix: '7€',
                        image: image
                    }
                ]
            }
        }
    }
</script>

<style scoped>
    .promotion-container {
        display: flex;
        align-items: start;
    }

    .card {
        height: 350px;
        width: 350px;
        margin: .5rem 0em 1rem 1.65em;
    }
</style>