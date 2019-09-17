<template>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-6">
                <div class="radio-inline" v-for="business in businesses" v-bind:key="business.id">
                    <input class="form-check-input" type="radio" v-bind:id="business.id"
                     @click="getExpenseByBusiness($event)" 
                     v-bind:value="business.id" 
                     v-model="business_id"> 
                     <label v-bind:for="business.id">{{ business.name }} </label>
                </div>
                <div class="list-group">
                    <div v-for="data in expenses" 
                        v-bind:key="data.id"  
                        class="list-group-item clearfix">                        
                           ‎₱ {{data.amount}} : {{data.description}}                        
                        <div class="pull-right">
                            <span>
                            <button class="btn btn-warning btn-xs">Edit</button>
                            <button class="btn btn-danger btn-xs">Delete</button>
                            </span>
                        </div>
                        
                    </div>
                </div>

                
            </div>
        </div>
    </section>
</template>
<script>
import moment from 'moment';
export default {
    data(){
        return{
            business_id: '',
            businesses: [],
            expenses:[],
        }
    },
    created(){
        this.fetchBusiness();
        this.fetchExpenses();
    },
    methods: {        
        fetchExpenses(){
            fetch('/api/expenses')
            .then(res => res.json())
            .then(res => {
                this.expenses = res.data;
            })
        },
        fetchExpenseByBusiness(id){
            fetch('/api/expenses/'+ id)
                .then(res => res.json())
                .then(res => {
                this.expenses = res.expenses;
            })
        },
        getExpenseByBusiness(event){
            this.fetchExpenseByBusiness(event.target.value);  
        },
        fetchBusiness(){
            fetch('/api/business')
            .then(res => res.json())
            .then(res => {
                this.businesses = res.data;
            })
            .catch(err => console.log(err));
        },
        isNumber(event){
            if(!/\d/.test(event.key) && event.key !== '.') return event.preventDefault();
        }
    },
}
</script>
