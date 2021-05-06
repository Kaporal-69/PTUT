<template>
    <div id="mapContainer" class="basemap">
    </div>
</template>

<script>

export default {
    name: "Map",
    data: function() {
            return {
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
        .setLngLat([46.21594385441138, 5.241776676703764])
        .addTo(map);

        const geolocate = new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true
        },
        trackUserLocation: true
        });

    map.addControl(geolocate, "top-right")
    },
}
</script>

<style scoped>
.basemap {
        width: 500px;
        height: 500px;
        top: 35px;
        left: 10px;
    }
</style>