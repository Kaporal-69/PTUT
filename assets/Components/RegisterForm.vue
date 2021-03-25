<template>
    <form v-on:submit.prevent="handleSubmit" class="register-form">
        <title>S'enregistrer</title>
        <p style="color:red;">Les champs suivi d'un (*) sont obligatoires</p>
        <div v-show="error" class="alert alert-danger" style="color:red;">
            {{ error }}
        </div>
        <div class="form-group">
            <label>Vous êtes:*</label>
            <label>
                <input type="radio" id="userTypeClient" name="userTypeRadio" value="1" v-model="userType"> <span>Un consommateur</span>
            </label>
            <br/>
            <label>
            <input type="radio" id="userTypeProducer" name="userTypeRadio" value="2" v-model="userType"> <span>Un producteur</span>
            </label>
            <br/>
            <label>
            <input type="radio" id="userTypeRestaurant" name="userTypeRadio" value="3" v-model="userType"> <span>Un restaurateur</span>
            </label>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Adresse *</label>
            <input type="text" v-model="adress" class="form-control" id="exampleInputEmail1"
                   aria-describedby="emailHelp" title="Votre Adresse" placeholder="votre adresse ici" autocomplete="on">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Code Postal*</label>
            <input type="text" v-model="zipCode" class="form-control" id="exampleInputEmail1"
                   aria-describedby="emailHelp" title="Votre Adresse" placeholder="votre adresse ici" autocomplete="on">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Ville*</label>
            <input type="text" v-model="city" class="form-control" id="exampleInputEmail1"
                   aria-describedby="emailHelp" title="Votre Adresse" placeholder="votre adresse ici" autocomplete="on">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Adresse Email*</label>
            <input type="email" v-model="email" class="form-control" id="exampleInputEmail1"
                   aria-describedby="emailHelp" title="Votre Adresse" placeholder="votre adresse ici" autocomplete="on">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe*</label>
            <input type="password" v-model="password" class="form-control"
                   id="exampleInputPassword1" title="Votre mot de passe" placeholder="votre mot de passe">
        </div>
         <div class="form-group">
            <label for="exampleInputPassword1">Confirmez le mot de passe*</label>
            <input type="password" v-model="password" class="form-control"
                   id="exampleInputPassword1" title="Votre mot de passe" placeholder="votre mot de passe">
        </div>
        <button type="submit" class="btn btn-primary" v-bind:class="{ disabled: isLoading }">Log in</button>
    </form>
</template>  
<script>
    import axios from 'axios';
    export default {
        name: "RegisterForm",
        data() {
            return {
                email: '',
                password: '',
                userType: '',
                adress: '',
                zipCode: '',
                city: '',
                error: '',
                isLoading: false
            }
        },
        props: ['user'],
        methods: {
            handleSubmit() {
                let formData = new FormData();
                formData.append('email', this.email);
                formData.append('plainPassword', this.password);
                formData.append('adress', this.adress);
                formData.append('zipCode', this.zipCode);
                formData.append('city', this.city);
                formData.append('userType',this.userType);
                this.isLoading = true;
                this.error = '';
                var token = '';
                axios
                    .post('/api/register', formData)
                    .then(response => {
                        console.log(response.data);
                        if (response.status == 200) {
                            this.$router.push('/login')
                        } else {
                            // console.log(response.status);
                            this.error = response.message;
                            console.log("error " + this.error);
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
            },
        },
        // beforeMount() {
        //     console.log(localStorage.getItem('user-token'));
        //     if(localStorage.getItem('user-token') && localStorage.getItem('user-token') != '') {
        //         this.$router.push('/accueil')
        //     }
        // }
    }
</script>