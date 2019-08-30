<template>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-6">
                <h2>This is for creating sales</h2>
                
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
