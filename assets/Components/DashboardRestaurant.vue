<template>
    <div class="mon-restaurant">
        <title>Tableau de bord: Restaurant</title>
        <div class="row">
            <div class="col s6">
                <div class="card">
                    <h1 class="title">Mon Restaurant</h1>
                    <div class="content" style="margin-left: 1em">
                        <div style="text-align: left;">
                                <img :src="restaurant.image" style="width:15%;" :alt="'Image du restaurant'">
                        </div>
                        <p>
                            <b>Nom : </b>{{restaurant.nom}}
                        </p>
                        <p>
                            <b>Adresse : </b>{{restaurant.adresse}}
                        </p>
                        <p><b>Description</b></p>
                        <p style="margin-left: 1em">
                            {{restaurant.description}}
                        </p>
                        <div><a class="waves-effect waves-light btn blue" href="#">Modifier</a></div>
                    </div>
                </div>
            </div>
            <div class="col s6">
                <div class="card">
                    <div class="mes-plats">
                        <h1 class="title">Mes Plats</h1>
                        <div class="card" v-for="plat in plats" v-bind:key="plat.nom">
                            <div style="text-align: left">
                                <img :src="plat.image" style="width:15%;" :alt="'Image du plat'">
                                <span>
                                    {{plat.nom}}
                                </span>
                            </div>
                        </div>
                        <div>
                            <a class="waves-effect waves-light btn blue" href="#">Modifier un plat</a>
                            <a class="waves-effect waves-light btn" href="/ajout">Ajouter un plat</a>
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
    name: "DashboardRestaurant",
    data() {
            return {
                restaurant: 
                    {
                        nom: "Laska",
                        adresse: "13 Rue Terraille, 69001 Lyon",
                        description: "Recettes végétariennes à base de produits bio midi et soir dans une salle intime et cosy aux matières brutes.",
                        image: image
                    },
                plats: [
                    {
                        nom: "Pomme de terre au four , carotte fondante et tombée d’épinards ",
                        image: image
                    },
                    {
                        nom: "Wok de légumes au cacahuètes à l’asiatique et crème de chou-fleur",
                        image: image
                    }
                ]
            }
        }
}
</script>