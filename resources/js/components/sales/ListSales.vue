<template>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-6">
                <div class="col-lg-6 col-xs-3">
                    <form @submit.prevent="addSales">
                        <label>Select Business</label>
                        <div class="form-group">
                            <select required class="custom-select form-control mb-1" v-model="selectedBusiness">
                                <option v-for="business in businesses" 
                                    v-bind:key="business.id"
                                    v-bind:value="business.id"
                                    :selected="selectedBusiness === business.id">
                                        {{ business.name }}  
                                </option>   
                            </select>
                        </div>
                        <div class="form-group">
                            <input required type="text" class="form-control" 
                            placeholder="Amount" 
                            v-model="sale.amount"
                            @keypress="isNumber($event)">
                        </div>
                        
                        <button type="submit" class="btn btn-light btn-block">Save</button>
                    </form>
                </div>

                <div class="table-responsive">
                    <!-- <table class="table"></table>
                        <thead>
                            <tr>
                                <th>Business</th>
                                <th>Amount</th>
                                <th>Date</th>                                
                            </tr>
                        </thead>
                        <tbody>
                                <tr v-for="sale in sales" v-bind:key="sale.id">
                                    <td>{{ sale.business_id }}</td>

                                    <td>{{ sale.amount }}</td>
                                    <td>{{ sale.created_at }}</td>
                                </tr>
                        </tbody>
                    </table> -->
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
            sales: [],
            sale:{
                id: '',
                business_id: '',
                amount: '',
                created_at: ''
            },      
            sale_id: '',
            edit: false  ,
            businesses: [],
            selectedBusiness: "1"
        }
    },
    created(){
        this.fetchSales();
        this.fetchBusiness();
    },

    methods: {
        fetchSales(){
            fetch('/api/sales-daily')
            .then(res => res.json())
            .then(res => {
               // this.sales = res.sales;
                let _sales = [];

                // res.sales.forEach(element => {
                //     //_sales.push(moment(String(element.created_at)).format('MMM DD YYYY'));
                //     _sales.push(element)
                // });
                console.log(res)
                
            })
        },
        addSales(){
            fetch('api/sales', {
                    method: 'post',
                    body: JSON.stringify(this.sale),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.sale.amount = '';
                    alert('Sales Added');
                    this.fetchSales();
                })
                .catch(err => console.log(err))
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
