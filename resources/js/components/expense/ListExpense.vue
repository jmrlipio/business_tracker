<template>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-6">
                <h2 class="text-center"> Total: ₱{{ total_expense.toLocaleString() }} </h2>
                 <div class="radio-inline clearfix">
                    <input @click="getExpenseByBusiness($event)" v-model="business_id" 
                        type="radio" class="form-check-input" 
                        value="all" 
                        :checked="true">
                    <label for="all">All</label>
                </div>
                <div class="radio-inline clearfix" v-for="business in businesses" v-bind:key="business.id">
                    <input class="form-check-input" type="radio" v-bind:id="business.id"
                     @click="getExpenseByBusiness($event)" 
                     v-bind:value="business.id" 
                     v-model="business_id"> 
                     <label v-bind:for="business.id">{{ business.name }} </label>
                </div>
               

                <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]">
                        <a @click="fetchExpenses(pagination.prev_page_url)" 
                            href="#" aria-label="previous">
                            <span>Previous</span>
                        </a>
                    </li>
                    <li class="disabled">
                        <a href="#">Page {{pagination.current_page}} of {{pagination.last_page}}</a>
                    </li>
                    <li v-bind:class="[{disabled: !pagination.next_page_url}]">
                        <a @click="fetchExpenses(pagination.next_page_url)" 
                            href="#" aria-label="next">
                            <span>Next</span>
                        </a>
                    </li>
                </ul>
                </nav>

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
            total_expense: 0,
            pagination: {},
            temp_total_expense: 0,
            temp_expenses: [],
        }
    },
    created(){
        this.fetchBusiness();
        this.fetchExpenses();
        this.fetchAllExpenses();
    },
    methods: {        
        fetchExpenses(page_url){
            let vm = this;
            page_url = page_url || '/api/expenses';
            fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.expenses = res.data;
                    this.temp_expenses = res.data;
                    vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
        },
        fetchAllExpenses(){
            fetch('/api/expenses-all') 
                .then(res => res.json())
                .then(res => {
                    this.total_expense = res.expenses;
                    this.temp_total_expense = res.expenses;
                })
                .catch(err => console.log(err));
        },
        makePagination(meta, links){
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev,
            }
            this.pagination = pagination;
        },
        fetchExpenseByBusiness(id){
            let vm = this;
            fetch('/api/expenses/'+ id)
                .then(res => res.json())
                .then(res => {
                    this.expenses = res.data;
                    vm.makePagination(res.meta, res.links);
            })
        },
        fetchTotalExpenseByBusiness(id){
            fetch('/api/expenses/business/'+ id)
                .then(res => res.json())
                .then(res => {
                    this.total_expense = res;
            })
        },
        getExpenseByBusiness(event){
            this.fetchExpenseByBusiness(event.target.value);  
            this.fetchTotalExpenseByBusiness(event.target.value);  
            if(event.target.value === 'all'){
                let temp = this.temp_expenses;
                this.expenses = temp;
                console.log(this.expenses)
                this.total_expense = this.temp_total_expense;
            }
        },
        fetchBusiness(){
            fetch('/api/business')
            .then(res => res.json())
            .then(res => {
                this.businesses = res.data;
            })
            .catch(err => console.log(err));
        },
    },
}
</script>
