<template>
<div id="mapContainer" class="basemap">
    <h1>Restaurants à proximité</h1>
    <!---<div id="restaurant">
        
        <div class="restaurant-container">
            <div class="card" v-for="restaurant in restaurants" v-bind:key="restaurant.nom">
                <div class="card-image">
                    <a href="#">
                        <img :src="restaurant.image" :alt="'Image du restaurant'">
                    </a>
                </div>
                <div class="card-content">
                    <span class="card-title">{{restaurant.nom}}</span>
                    <p>{{restaurant.adresse}}</p>
                </div>
            </div>
        </div>
    </div>-->
</div>
    
</template>

<script>
    import image from '../images/placeholder.png'
    import axios from 'axios';
    //import mapboxgl from "mapbox-gl";

    export default {
        name: "RestaurantContent",
        data: function() {
            return {
                restaurants: [],
                accessToken: 'pk.eyJ1Ijoia2Fwb3JhbCIsImEiOiJja29jbmcyNWkwamlwMnZuMWlwN3R3N2ZzIn0.66WNy78D3_ie4xrrKKGxpg'
            };
        },
        mounted() {
            var mapboxgl = require('mapbox-gl/dist/mapbox-gl.js');
            var MapboxGeocoder = require('mapbox-gl-geocoder');
 
            mapboxgl.accessToken = this.accessToken;
            var map = new mapboxgl.Map({
            container: 'mapContainer',
            style: 'mapbox://styles/mapbox/streets-v11',
            });
            
            map.addControl(new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl
            }, "top-right")
            );

            const nav = new mapboxgl.NavigationControl();
            map.addControl(nav, "top-right");

            const marker = new mapboxgl.Marker()
            .setLngLat([103.811279, 1.345399])
            .addTo(map);

            const geolocate = new mapboxgl.GeolocateControl({
            positionOptions: {
                enableHighAccuracy: true
            },
            trackUserLocation: true
            });

        map.addControl(geolocate, "top-right")
        
        },
        beforeCreate() {
            axios.get('/api/restaurateurs', {
                    })
                    .then(response => {
                        if (response.status == 200) {
                            let resto = null;
                            let restaurateurs = [];
                            for(let i = 0; i<response.data["hydra:member"].length; i++) {
                                resto = response.data["hydra:member"][i];
                                let restoData = {
                                    nom: resto.id,
                                    adresse: resto.adresse + " " + resto.codePostal + " " + resto.ville,
                                    image: image
                                }
                                restaurateurs.push(restoData);
                            }
                            this.restaurants = restaurateurs;
                        } else {
                            // console.log(response.status);
                            this.error = response.message;
                            console.log("error " + this.error);
                        }
                        
                        //this.$emit('user-authenticated', userUri);
                        //this.email = '';
                        //this.password = '';
                        // router.go('/accueil')
                    }).catch(error => {
                        console.log(error);
                        if(error.response.status == 401) {
                            this.error = "Nous n'avons pas pu vous identifier, veuillez vérifier votre adresse et votre mot de passe."
                        } else {
                            this.error = error.response.message;
                        }
                    }).finally(() => {
                        this.isLoading = false;
                        // localStorage.setItem('user-token', token);
                        // this.$router.push('/accueil')
                    })
            },
        }
</script>

<style scoped>
    .restaurant-container {
        display: flex;
        align-items: start;
    }

    .card {
        height: 350px;
        width: 350px;
        margin: .5em 0em 1em 1.65em;
    }

    .basemap {
        width: 500px;
        height: 500px;
        top: 35px;
        left: 10px;
    }
   
</style>