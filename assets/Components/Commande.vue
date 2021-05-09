<template>
    <div class="container">
        <div class="commande">
            <ul class="collection with-header">
                <li class="collection-header"><h2>Votre commande</h2></li>
                <li class="collection-item" v-for="item in panier" :key="item.id">
                    {{item.nom}} - {{item.prix}}€
                </li>
            </ul>
            <div class="total-commande">Total de votre commande : {{prixTotal(panier)}}€</div>
            <div class="actions">
                <button class="waves-effect waves-light btn red" style="margin-right: 2px;" @click="$router.go(-1)">RETOUR</button>
                <button class="waves-effect waves-light btn" @click="commande(true)">EFFECTUER LA COMMANDE</button>
            </div>
            <div class="statut-commande" v-show="statutCommande"><span class="teal-text">Votre commande a été effecuté!</span></div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Commande",
    data() {
        return {
            statutCommande: false,
            panier: []
        }
    },
    mounted() {
        if(localStorage.panier) {
            console.log('Panier trouvé');
            this.panier = JSON.parse(localStorage.panier);
        }
    },
    methods: {
        commande(statut) {
            this.statutCommande = statut;
        },
        prixTotal(panier) {
            var prixTotal = 0;
            panier.map(i => prixTotal += i.prix);
            return prixTotal;
        }
    }
}
</script>

<style scoped>
.collection .collection-item {
    line-height: 3;
}

.total-commande {
    font-size: 22px;
}
</style>