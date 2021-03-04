<template>
    <div id="nouveaute">
        <h3>Nouveautés</h3>
        <div class="nouveaute-container">
            <div class="card" v-for="nouveaute in nouveautes" v-bind:key="nouveaute.nom">
                <div class="card-image">
                    <a href="#">
                        <img :src="nouveaute.image" :alt="'image de la nouveauté'">
                    </a>
                </div>
                <div class="card-content">
                    <span class="card-title">{{nouveaute.nom}}</span>
                    <p>{{nouveaute.adresse}}</p>
                    <p v-if="nouveaute.prix != null">{{nouveaute.prix}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import image from '../images/placeholder.png'
    export default {
        name: "NouveauteContent",
        data() {
            return {
                nouveautes: [
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
                        prix: '8€',
                        image: image
                    },
                    {
                        nom: "Produit 3",
                        adresse: "Nom Producteur",
                        prix: '5€',
                        image: image
                    }
                ]
            }
        }
    }
</script>

<style scoped>
    .nouveaute-container {
        display: flex;
        align-items: start;
    }

    .card {
        height: 350px;
        width: 350px;
        margin: .5rem 0em 1rem 1.65em;
    }
</style>