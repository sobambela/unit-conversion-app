<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Conversion History</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">From</th>
                                <th scope="col">Value</th>
                                <th scope="col">To</th>
                                <th scope="col">Converted Value</th>
                                <th scope="col">Status</th>
                                <th scope="col">Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item,i) in history">
                                    <td>{{i+1}}</td>
                                    <td>{{item.from}}</td>
                                    <td>{{item.from_value}}</td>
                                    <td>{{item.to}}</td>
                                    <td>{{item.to_value}}</td>
                                    <td>{{item.status}}</td>
                                    <td>{{item.message}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getData();
        },

        data () {
            return {
                history: null
            }
        },
 
        methods: {
            getData(){
                let vm = this;
                axios.get('/get-history')
                    .then(function (response) {
                        vm.history = response.data.data;
                    }).catch(function (error) {
                        console.log(error);
                    });
            }
        },

        computed: {
        }
    }
</script>
