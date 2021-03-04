<template>
    <div class="mon-restaurant">
        <title>Tableau de bord: Restaurant</title>
        <div class="row">
            <div class="col s6">
                <div class="card">
                    <h1 class="title">Mon Restaurant</h1>
                    <div class="content">
                        <div style="text-align: left">
                                <img :src="restaurant.image" style="width:15%;" :alt="'Image du restaurant'">
                        </div>
                        <p>
                            {{restaurant.nom}}
                        </p>
                        <p>
                            {{restaurant.adresse}}
                        </p>
                        <p>
                            {{restaurant.description}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col s6">
                <div class="card">
                    <div class="mes-plats">
                        <h1 class="title">Mes Plats</h1>
                        <div class="card" v-for="plat in plats" v-bind:key="plat.nom">
                            <div style="text-align: left">
                                <img :src="plat.image" style="width:15%;">
                                <span>
                                    {{plat.nom}}
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
    name: "DashboardRestaurant",
    data() {
            return {
                restaurant: 
                    {
                        nom: "McDonald",
                        adresse: "rue du bonheur",
                        description: "ici une description",
                        image: image
                    },
                plats: [
                    {
                        nom: "Big Mac",
                        image: image
                    },
                    {
                        nom: "Mc Chicken",
                        image: image
                    },
                    {
                        nom: "CBO",
                        image: image
                    },
                    {
                        nom: "BEEF BBQ",
                        image: image
                    }
                ]
            }
        }
}
</script>