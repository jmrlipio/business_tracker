<template>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-6">
                <div class="col-lg-6 col-xs-3">
                    <form @submit.prevent="addExpense">
                        <label>Select Business</label>
                        <div class="form-group">
                            <select :required="true" class="custom-select form-control mb-1" v-model="expense.business_id">
                                <option v-for="business in businesses" 
                                    v-bind:key="business.id"
                                    v-bind:value="business.id"
                                    :selected="business == '1'">
                                        {{ business.name }}  
                                </option>   
                            </select>
                        </div>
                        <div class="form-group">
                            <input :required="true" type="number" class="form-control" 
                            placeholder="Quantity" v-model="expense.quantity">
                        </div>
                        <div class="form-group">
                            <input :required="true" type="text" class="form-control" 
                            placeholder="Amount" v-model="expense.amount"
                            @keypress="isNumber($event)">
                        </div>
                        <div class="form-group">
                            <textarea type="text" class="form-control" 
                            placeholder="Expense description" v-model="expense.description">
                            </textarea>
                        </div>                
                        
                        <button type="submit" class="btn btn-light btn-block">Save</button>
                    </form>
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
            expense_id: '',
            edit: false  ,
            businesses: [],
            expense:{
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
                    body: JSON.stringify(this.expense),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    alert('Expense Added');
                })
                .catch(err => console.log(err))
        },
        fetchBusiness(){
            fetch('/api/business')
            .then(res => res.json())
            .then(res => {
                this.businesses = res.data;
                console.log(res)
            })
            .catch(err => console.log(err));
        },
        isNumber(event){
            if(!/\d/.test(event.key) && event.key !== '.') return event.preventDefault();
        }
    },
}
</script>
