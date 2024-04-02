<style>

</style>
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Update Profile</div>

                    <div class="card-body"> 
                        <div class="row mb-3">
                            <div class="col-md-6">          
                                <div class="form-group">
                                    <label for="Name">Name</label>
                                    <input v-model="user.name" type="text" class="form-control" id="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">          
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input v-model="user.email" type="email" class="form-control" id="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div :class="{'alert': true, 'alert-danger': showError, 'alert-success':showSuccess}" role="alert">
                                {{message}}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6"> 
                                <button @click="handleUpdate" type="button" class="btn btn-info">
                                    Update
                                </button>
                                <div v-if="loader" class="spinner-border mx-2" role="status" style="position: relative;top: 11px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            let vm = this;
            axios.get('/get-profile')
                .then(function (response) {
                    vm.user = response.data.user;
                }).catch(function (error) {
                    console.log(error);
                });
        },
        data () {
            return {
                user: [],
                showSuccess: false,
                message: '',
                showError: false,
                loader: false
            }
        },
 
        methods: {
            handleUpdate(){
                let vm = this;
                
                if (vm.fromValue == '') {
                    return false;
                }

                vm.loader = true;
                vm.showError = false;
                vm.showSuccess = false;
                vm.message = '';
                axios.post('/profile',
                        {
                            "id": vm.user.id,
                            "name": vm.user.name,
                            "email": vm.user.email,
                        }
                    )
                    .then(function (response) {
                        vm.user = response.data.user;
                        console.log(vm.user);
                        vm.message = "Profile updated successfully";
                        vm.loader = false;
                        vm.showSuccess = true;
                    }).catch(function (error) {
                        
                        vm.message = "Data validation erros have occured.";
                        vm.showError = true;
                        vm.loader = false;
                    });
            }
        },

        computed: {
        }
    }
</script>
