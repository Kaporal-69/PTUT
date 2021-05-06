<template>
<div class="container" style="margin-top: 1em">
    <div class="ajout-plat row card">
        <div class="col s10 offset-s1">
            <h1>Ajout Plat</h1>
        </div>
        <hr/>
        <div class="row">
            <div class="col s2 offset-s1 input-field">
                <input id="nom_plat" title="Votre nom de plat" type="text" class="validate" v-model="name">
                <label for="nom_plat">Nom du plat</label>
            </div>
        </div>
        
        <div class="row">
            <div class="col s4 offset-s1 input-field">
                <textarea id="textarea-desc-plat" title="Votre description du plat" class="materialize-textarea" v-model="description"></textarea>
                <label for="textarea-desc-plat">Description du plat</label>
            </div>
        </div>

        <div class="row">
            <div class="col s4 offset-s1 input-field">
                <textarea id="textarea-allergies" title="Les allergies possibles dans le plat" class="materialize-textarea" v-model="allergies"></textarea>
                <label for="textarea-allergies">Allergies</label>
            </div>
        </div>
        
        <div class="row">
            <div class="input-field col s4 offset-s1">
                <select title="Sélection de la catégorie" v-model="category" style="display:inherit">
                    <option v-for="categoryData in categories" :value="categoryData.id" v-bind:key="categoryData.id"> {{categoryData.nom}} </option>
                </select>
                <label>Catégorie</label>
            </div>
        </div>

        <div class="row">
            <div class="col s1 offset-s1 input-field">
                <input id="prix_plat" title="Prix du plat" type="text" class="validate" v-model="price">
                <label for="prix_plat">Prix</label>
            </div>
        </div>
        <div class="row">
            <div class="col s4 offset-s1">
                <a href="/dashboard" class="red-text" aria-label="Retour à la page précédente">Retour</a>
                <button class="waves-effect waves-light btn" aria-label="Ajout un plat" v-on:click="handleSubmit">Ajouter</button>
            </div>
        </div>
    </div>
</div>
    
</template>

<script>
import M from 'materialize-css';
import axios from 'axios';


export default {
    name: "AjoutPlatForm",
    mounted() {
        M.AutoInit()
    },
        data() {
            return {
                name: '',
                description: '',
                allergies: '',
                price: '',
                category: null,
                categories:null
            }
        },
        props: ['user'],
        mounted() {
            axios
            .get('/api/categorie_plats')
            .then(response => (this.categories = response.data["hydra:member"]))
        },
        methods: {
            handleSubmit() {
                const data = {
                    name: this.name,
                    description: this.description,
                    allergies: this.allergies,
                    category: this.category,
                    price: this.price
                }
                const token = localStorage.getItem('user-token');
                 const requestOptions = {
                    method: "POST",
                    headers: { "Content-Type": "application/json",
                                "Authorization": `Bearer ${token}` 
                    },
                    body: JSON.stringify(data)
                };
                fetch('/api/plat/add', requestOptions)
                    .then(response => {
                        if (response.status == 200) {
                            console.log(response.data);
                            this.$router.push('/dashboard')
                        } else {
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
        },
}
</script>