<template>
    <form v-on:submit.prevent="handleSubmit" class="login-form">
        <div v-show="error" class="alert alert-danger" style="color:red;">
            {{ error }}
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Adresse Email</label>
            <input type="email" v-model="email" class="form-control" id="exampleInputEmail1"
                   aria-describedby="emailHelp" placeholder="votre adresse ici">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe</label>
            <input type="password" v-model="password" class="form-control"
                   id="exampleInputPassword1" placeholder="votre mot de passe">
        </div>
        <button type="submit" class="btn btn-primary" v-bind:class="{ disabled: isLoading }">Log in</button>
    </form>
</template>  
<script>
    import axios from 'axios';
    export default {
        name: "LoginForm",
        data() {
            return {
                email: '',
                password: '',
                error: '',
                isLoading: false
            }
        },
        props: ['user'],
        methods: {
            handleSubmit() {
                this.isLoading = true;
                this.error = '';
                var token = '';
                axios
                    .post('/api/login', {
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                        if (response.status == 200) {
                            token = response.data.token;
                            this.isLoading = false;
                            localStorage.setItem('user-token', token);
                            this.$router.push('/accueil')
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
        },
        beforeMount() {
            console.log(localStorage.getItem('user-token'));
            if(localStorage.getItem('user-token') && localStorage.getItem('user-token') != '') {
                this.$router.push('/accueil')
            }
        }
    }
</script>