<template>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-6">
                <label>Select Business</label>
                <div class="form-check form-check-inline" v-for="business in businesses" v-bind:key="business.id">
                    <input class="form-check-input" type="radio" v-bind:id="business.id"
                     @change="getExpenseByBusiness($event)" 
                     v-bind:value="business.id" 
                     v-model="expenses.business_id"> 
                     <label v-bind:for="business.id">{{ business.name }} </label>
                </div>
                <ul class="list-group">
                    <li v-for="data in expenses" v-bind:key="data.id"  class="list-group-item">{{data.amount}} - {{data.description}}</li>
                </ul>
            </div>
        </div>
    </section>
</template>
<script>
import moment from 'moment';
export default {
    data(){
        return{
            expense_id: '',
            edit: false  ,
            businesses: [],
            expenses:{
                id: '',
                business_id: '',
                amount: '',
                quantity: '',
                description: '',               
            },
            selectedBusiness: "1"
        }
    },
    created(){
        this.fetchBusiness();
    },
    methods: {
        addExpense(){
            fetch('api/expenses', {
                    method: 'post',
                    body: JSON.stringify(this.expenses),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.expenses.amount = '';
                    this.expenses.description = '';
                    alert('Expense Added');
                })
                .catch(err => console.log(err))
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
