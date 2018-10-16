<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h4 class="card-header bg-secondary text-white">
                        List Of Topics
                    </h4>

                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                //
            };
        },

        created: function() {
            var self = this;
            axios.get("/api/get-topics", {
                headers: {
                    Authorization: 'Bearer ' + self.$root.userAccessToken
                }
            })
            .then(function(response) {
                console.log(response);
                self.$root.user = response.data.user;
            }).catch(function(error) {
                console.log(error);
            });
        }
    };
</script>
