<template>
    <div class="producteur">
        <div class="row">
            <div class="col s6">
                <div class="card">
                    <h1 class="title">Producteur</h1>
                    <div class="content">
                        <div style="text-align: left">
                                <img :src="producteur.image" style="width:15%;">
                        </div>
                        <p>
                            {{producteur.nom}}
                        </p>
                        <p>
                            {{producteur.adresse}}
                        </p>
                        <p>
                            {{producteur.description}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col s6">
                <div class="card">
                    <div class="mes-produits">
                        <h1 class="title">Mes Produits</h1>
                        <div class="card" v-for="produit in produits" v-bind:key="produit.nom">
                            <div style="text-align: left">
                                <img :src="produit.image" style="width:15%;">
                                <span>
                                    {{produit.nom}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import image from '../images/placeholder.png'

export default {
    name: "DashboardProducteur",
    data() {
            return {
                producteur: 
                    {
                        nom: "EasyProduit",
                        adresse: "rue du bonheur",
                        description: "ici une description",
                        image: image
                    },
                produits: [
                    {
                        nom: "Steak",
                        image: image
                    },
                    {
                        nom: "Salade",
                        image: image
                    },
                    {
                        nom: "Tomate",
                        image: image
                    },
                    {
                        nom: "Fromage",
                        image: image
                    }
                ]
            }
        }
}
</script>