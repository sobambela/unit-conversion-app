<style>

</style>
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Converter</div>

                    <div class="card-body"> 
                    
                        <div class="row">
                            <div class="col-md-12 mb-3">          
                                <div class="form-group">
                                    <label for="conversionType">Please select conversion units</label>
                                    <select @change="handleTypeChange" v-model="conversionType" class="form-control" id="conversionType">
                                        <option v-for="option in conversionTypeOptions" :value="option">{{option}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">          
                                <div class="form-group">
                                    <label for="fromValue">Value</label>
                                    <input v-model="fromValue" type="text" class="form-control" id="fromValue">
                                </div>
                            </div>
                            <div class="col-md-6">          
                                <div class="form-group">
                                    <label for="toValue">Conversion</label>
                                    <input v-model="toValue" type="text" class="form-control" id="toValue" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">          
                                <div class="form-group">
                                    <label for="from">From</label>
                                    <select v-model="from" class="form-control" id="from">
                                        <option v-for="option in fromOptions" :value="option">{{option}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">          
                                <div class="form-group">
                                    <label for="to">To</label>
                                    <select v-model="to" class="form-control" id="to">
                                        <option v-for="option in toOptions" :value="option">{{option}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3" v-if="showError">
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">
                                {{errorMessage}}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6"> 
                                <button @click="handleConvert" type="button" class="btn btn-info">
                                    Convert
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
            console.log('Component mounted.')
            this.fromOptions = this.toOptions = this.lengthOptions 
        },

        data () {
            return {
                from: 'Meter',
                to: 'Kilometer',
                conversionTypeOptions: [
                    'Length',
                    'Weight',
                    'Temperature'
                ],
                lengthOptions: [
                    'Meter',
                    'Kilometer',
                    'Mile'
                ],
                weightOptions: [
                    'Gram',
                    'Kilogram',
                    'Pound'
                ],
                temperatureOptions: [
                    'Celsius',
                    'Kelvin',
                    'Fahrenheit'
                ],
                fromOptions: [],
                toOptions: [],
                conversionType: 'Length',
                fromValue: '',
                toValue: '',
                showError: false,
                errorMessage: '',
                loader: false
            }
        },
 
        methods: {
            handleConvert(){
                let vm = this;
                
                if (vm.fromValue == '') {
                    return false;
                }

                vm.loader = true;
                vm.showError = false;
                axios.post('http://localhost:8000/api/convert',
                        {
                            "from": vm.from.toLowerCase(),
                            "to": vm.to.toLowerCase(),
                            "value": vm.fromValue
                        }
                    )
                    .then(function (response) {
                        vm.toValue = response.data.result.target.value;
                        vm.loader = false;
                    }).catch(function (error) {
                        if (error.response.data.error) {
                            vm.errorMessage = error.response.data.message;
                            vm.showError = true;
                        }
                        vm.loader = false;
                    });
            },
            handleTypeChange() {
                let vm = this;
                switch (vm.conversionType) {
                    case 'Length':
                        vm.conversionType = 'Length';
                        vm.to = 'Meter';
                        vm.from = 'Kilometer';
                        this.fromOptions = this.toOptions = this.lengthOptions;
                    break;                    
                    case 'Weight':
                        vm.conversionType = 'Weight';
                        vm.to = 'Kilogram';
                        vm.from = 'Gram';
                        this.fromOptions = this.toOptions = this.weightOptions;
                    break;                    
                    case 'Temperature':
                        vm.conversionType = 'Length';
                        vm.to = 'Kelvin';
                        vm.from = 'Celsius';
                        this.fromOptions = this.toOptions = this.temperatureOptions;
                    break;
                }
            }
        },

        computed: {
        }
    }
</script>
