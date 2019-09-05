<template>
<section class="content">
    <div class="row">
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ sales.length }}</h3>

              <p>Total Sales</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>₱{{ totalExpense.toLocaleString() }}</h3>

              <p>Expenses</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>₱{{ totalRevenue.toLocaleString() }}</h3>

              <p>Revenue</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>₱{{ totalProfit }}</h3>

              <p>Profits</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-solid">
                <div class="box-header bg-teal-gradient">
                    <i class="fa fa-th"></i>

                    <h3 class="box-title">Sales Graph</h3>

                    <div class="box-tools pull-right">
                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                    </div>
                </div>
                <div class="box-body border-radius-none">
                    <select :required="true" @change="getSalesByBusiness($event)" class="custom-select form-control mb-1" v-model="sale.business_id">
                        <option value="">---Choose Business---</option>
                        <option v-for="business in businesses" 
                            v-bind:key="business.id"
                            v-bind:value="business.id"
                            :selected="business == '1'">
                                {{ business.name }}  
                        </option>   
                    </select>
                </div>
                <div class="box-body border-radius-none">
                    <!-- <div class="chart" id="line-chart" style="height: 250px;"></div> -->
                    <canvas ref="myChart" width="500" height="100"></canvas>
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
            sales: [],
            sale:{
                id: '',
                business_id: '',
                amount: '',
                created_at: ''
            },
            _totalRevenue: 0,
            _totalExpense: 0,
            _totalProfit: 0,
            expenses: [],
            businesses: [],
            daily_sales: [],
            monthly_sales: [],
            yearly_sales: [],
            Days: [],
            Amount: [],
            CurrentDate: moment().format('MMMM YYYY'),
            ChartData: [],
        }
    },
    name: 'monthly-sales-chart',
    mounted() {
      
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

                this.daily_sales.forEach(element => {
                  this.Days.push(element.sales_day);
                  this.Amount.push(element.total_sales);
                });

                this.monthly_sales.forEach(element => {
                  
                });

                this.yearly_sales.forEach(element => {
                  
                });

                this.ChartData = {
                   'amount' : this.Amount, 
                   'length' : this.Days,
                   'date': this.CurrentDate
                };
                //set onload as daily sales for current month
                this.drawChart(this.ChartData); //add input variables for day labels, month and amount 
            })
        },
        fetchSalesByBusiness(id){
            fetch('/api/business/'+ id + '/sales')
            .then(res => res.json())
            .then(res => {
              this.sales = res.sales;
              this.daily_sales = res.daily_sales;
              this.expenses = res.expenses;
              this.Amount = [];
              this.Days = [];

              this.daily_sales.forEach(element => {
                this.Days.push(element.sales_day);
                this.Amount.push(element.total_sales);
              });
              
              this.ChartData = {
                  'amount' : this.Amount, 
                  'length' : this.Days, 
                  'date': this.CurrentDate
              };
              //set onload as daily sales for current month
              this.drawChart(this.ChartData); //add input variables for day labels, month and amount 
          })
        },
        getSalesByBusiness(event){
          this.fetchSalesByBusiness(event.target.value);
        },
        drawChart(arr_data){
          new Chart(this.$refs.myChart, {
            type: 'line',
            data: {
              labels: arr_data['length'],
              datasets: [
                {
                  label: arr_data['date'] + ' Sales',
                  data: arr_data['amount'],
                  backgroundColor: [
                      'rgba(57, 204, 204, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                      'rgba(57, 204, 204, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 2
                }
              ],
              options: {
                scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero: true
                          }
                      }]
                  },
              }
            }
          });
        }
    },
    computed: {
      totalRevenue(){
        this._totalRevenue = this.sales.reduce((acc, item) => acc + item.amount, 0);
        return this._totalRevenue;
      },
      totalExpense(){
          this._totalExpense = this.expenses.reduce((acc, item) => acc + item.amount, 0);
          return this._totalExpense;
      },
      totalProfit(){
        this._totalProfit = this.totalRevenue - this.totalExpense;
        return this._totalProfit.toLocaleString();
      }
    }
}
</script>
