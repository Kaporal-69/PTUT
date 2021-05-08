<template>
    <div class="mon-etablissement">
        <title>Tableau de bord: {{typeEtablissement}}</title>
        <div class="row">
            <div class="col s6">
                <div class="card">
                    <h1 class="title">Mon {{typeEtablissement}}</h1>
                    <div class="content" style="margin-left: 1em">
                        <div style="text-align: left;">
                                <img :src="etablissement.image" style="width:15%;" :alt="'Image du {{typeEtablissement}}'">
                        </div>
                        <p>
                            <b>Nom : </b>{{etablissement.nom}}
                        </p>
                        <p>
                            <b>Adresse : </b>{{etablissement.adresse}}
                        </p>
                        <p><b>Description</b></p>
                        <p style="margin-left: 1em">
                            {{etablissement.description}}
                        </p>
                        <div><a class="waves-effect waves-light btn blue" href="#">Modifier</a></div>
                    </div>
                </div>
            </div>
            <div class="col s6">
                <div class="card">
                    <div class="mes-items">
                        <h1 class="title" v-if="typeEtablissement == 'Restaurant'">Mes Plats</h1>
                        <h1 class="title" v-else>Mes Produits</h1>
                        <div class="card" v-for="plat in items" v-bind:key="plat.nom">
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
import image from '../images/placeholder.png';
import axios from 'axios';


export default {
    name: "DashboardRestaurant",
    data() {
            return {
                etablissement: 
                    {
                        id: 1,
                        nom: "Laska",
                        adresse: "13 Rue Terraille, 69001 Lyon",
                        description: "Recettes végétariennes à base de produits bio midi et soir dans une salle intime et cosy aux matières brutes.",
                        image: image
                    },
                items: [
                    {
                        nom: "Pomme de terre au four , carotte fondante et tombée d’épinards ",
                        image: image
                    },
                    {
                        nom: "Wok de légumes au cacahuètes à l’asiatique et crème de chou-fleur",
                        image: image
                    }
                ],
                typeEtablissement: "Restaurant"
            }
        },
    methods: {
        // getImagePlat(nom) {
        //     return require('../images/plats/'+nom+'.png');
        // }
    },
    mounted() {
            if(localStorage.getItem('user-token')) {
                const token = localStorage.getItem('user-token');
                    axios.get('/api/dashboard/data', {
                        headers: { Authorization: `Bearer ${token}`}
                    })
                    .then(response => {
                        if (response.status == 200) {
                            console.log(response.data);
                            this.typeEtablissement = response.data.typeEtablissement;
                            this.etablissement.adresse = response.data.etablissement.adresse;
                            this.items = response.data.etablissement.items;
                            for (let index = 0; index < this.items.length; index++) {
                                this.items[index].image = image;
                            }
                        } else if (response.status == 401) {
                           this.$router.push('/login')
                        } 
                    }).catch(error => {
                        console.log(error);
                        if(error.response.status == 401) {
                            this.error = "Nous n'avons pas pu vous identifier, veuillez vérifier votre adresse et votre mot de passe."
                        } else {
                            this.error = error.response.message;
                        }
                    }).finally(() => {
                        this.isLoading = false;
                    })
            } else {
                this.router.push('/login');
            }
            },
}
</script>