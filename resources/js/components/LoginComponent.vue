<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h4 class="card-header bg-secondary text-white">
                        Login
                    </h4>

                    <div class="card-body">
                        <form method="POST" v-on:submit.prevent="loginFormSubmit">
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">
                                    E-Mail Address
                                </label>

                                <div class="col-md-6">
                                    <input type="email"
                                        id="email"
                                        class="form-control"
                                        v-model="login.email"
                                        required
                                        autofocus
                                    >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                    Password
                                </label>

                                <div class="col-md-6">
                                    <input type="password"
                                        id="password"
                                        class="form-control"
                                        v-model="login.password"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                login : {
                    email: '',
                    password: '',
                }
            }
        },
        methods: {
            loginFormSubmit: function() {
                var self = this;

                axios.post('/login', {
                    email: self.login.email,
                    password: self.login.password,
                }).then(function (response) {
                    window.location = '/';
                }).catch(function (error) {
                    console.log(error.data);
                });
            }
        },

        created: function() {
            if (isLoggedIn) {
                this.$root.$router.push({ path: '/' });
                return;
            }
        }
    }
</script>
