<template>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-6">
                <div class="card card-body mb-2" v-for="business in businesses" v-bind:key="business.id">
                    <h3>{{ business.name }}</h3>
                    <p>{{ business.name }}</p>
                </div>
            </div>
        </div>
    </section>
</template>
<script>

export default {
    data(){
        return{
            sales: [],
            sale:{
                id: '',
                business_id: '',
                amount: '',
                created_at: ''
            },
            expenses: [],
            expense:{
                id: '',
                business_id: '',
                quantity: '',
                amount: ''                
            },   
            businesses: [],
            business:{
                id: '',
                name: '',
                description: '',               
            },         
            daily_sales: [],
            monthly_sales: [],
            yearly_sales: [],
            Days: [],
            Prices: [],        
        }
    },
    created(){
        this.fetchSales();
    },

    methods: {
        fetchSales(){
            fetch('/api/sales')
            .then(res => res.json())
            .then(res => {
                this.sales = res.sales;
                this.expenses = res.expenses;
                this.businesses = res.business;
                this.daily_sales = res.daily_sales;
                this.monthly_sales = res.monthly_sales;
                this.yearly_sales = res.yearly_sales;
                let arr_data = [];
                
                this.daily_sales.forEach(element => {
                  this.Days.push(element.sales_day);
                  this.Prices.push(element.total_sales);
                });

            })
        },
    },
}
</script>
