<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h4 class="card-header bg-secondary text-white">
                        Login
                    </h4>

                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">
                                    E-Mail Address
                                </label>

                                <div class="col-md-6">
                                    <input type="email"
                                        id="email"
                                        class="form-control"
                                        name="email"
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
                                        name="password"
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
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
