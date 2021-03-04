<template>
<div class="container" style="margin-top: 1em">
    <div class="ajout-plat row card">
        <div class="col s10 offset-s1">
            <h1>Ajout Plat</h1>
        </div>
        <hr/>
        <div class="row">
            <div class="col s2 offset-s1 input-field">
                <input id="nom_plat" title="Votre nom de plat" type="text" class="validate">
                <label for="nom_plat">Nom du plat</label>
            </div>
        </div>
        
        <div class="row">
            <div class="col s4 offset-s1 input-field">
                <textarea id="textarea-desc-plat" title="Votre description du plat" class="materialize-textarea"></textarea>
                <label for="textarea-desc-plat">Description du plat</label>
            </div>
        </div>

        <div class="row">
            <div class="col s4 offset-s1 input-field">
                <textarea id="textarea-allergies" title="Les allergies possibles dans le plat" class="materialize-textarea"></textarea>
                <label for="textarea-allergies">Allergies</label>
            </div>
        </div>
        
        <div class="row">
            <div class="input-field col s4 offset-s1">
                <select title="Sélection de la catégorie">
                    <option value="" disabled selected>Catégorie</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
                <label>Catégorie</label>
            </div>
        </div>

        <div class="row">
            <div class="col s1 offset-s1 input-field">
                <input id="prix_plat" title="Prix du plat" type="text" class="validate">
                <label for="prix_plat">Prix</label>
            </div>
        </div>
        <div class="row">
            <div class="col s2 offset-s1">
                <a href="#" class="red-text">Retour</a>
                <a class="waves-effect waves-light btn">Ajouter</a>
            </div>
        </div>
    </div>
</div>
    
</template>

<script>
import M from 'materialize-css';

export default {
    name: "AjoutPlatForm",
    mounted() {
        M.AutoInit()
    }
}
</script>