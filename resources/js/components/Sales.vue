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
            <div class="box box-solid bg-teal-gradient">
                <div class="box-header">
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
            expense:{
                id: '',
                business_id: '',
                quantity: '',
                amount: ''                
            },
            Days: [],
            Prices: [],
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
                let temp_container = [];
                let days_container = [];
                let arr_data = [];
                let year = moment().year();

                this.sales.forEach(element => {
                  temp_container.push(moment(String(element.created_at)).format('D'));
                  this.Prices.push(element.amount);
                });
                days_container = new Set(temp_container);
                this.Days = Array.from(days_container)
                
                arr_data = {
                   'prices' : this.Prices, 
                   'days' : this.Days, 
                   'year' : year
                };
                console.log(arr_data['prices'])
                this.drawChart(arr_data); //add input variables for day labels, month and amount 
            })
        },
        drawChart(arr_data){
          new Chart(this.$refs.myChart, {
            type: 'line',
            data: {
              labels: arr_data['days'],
              datasets: [
                {
                  label: arr_data['year'] + ' Sales',
                  data: arr_data['prices'],
                  lineColors       : ['#efefef'],
                  lineWidth        : 2,
                  hideHover        : 'auto',
                  gridTextColor    : '#fff',
                  gridStrokeWidth  : 0.4,
                  pointSize        : 4,
                  pointStrokeColors: ['#efefef'],
                  gridLineColor    : '#efefef',
                  gridTextFamily   : 'Open Sans',
                  gridTextSize     : 10
                }
              ]
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


// $(function () {

//     'use strict';
//     var line = new Morris.Line({
//     element          : 'line-chart',
//     resize           : true,
//     data             : [
//         { y: '2019-01', item1: 2666 },
//         { y: '2019-02', item1: 2778 },
//         { y: '2019-03', item1: 4912 },
//         { y: '2019-04', item1: 3767 },
//         { y: '2019-05', item1: 6810 },
//         { y: '2019-06', item1: 5670 },
//         { y: '2019-07', item1: 4820 },
//         { y: '2019-08', item1: 15073 },
//         { y: '2019-09', item1: 10687 },
//         { y: '2019-10', item1: 8432 },
//         { y: '2019-11', item1: 9678 },
//         { y: '2019-12', item1: 15980}
//     ],
//     xkey             : 'y',
//     ykeys            : ['item1'],
//     labels           : ['Item 1'],
//     lineColors       : ['#efefef'],
//     lineWidth        : 2,
//     hideHover        : 'auto',
//     gridTextColor    : '#fff',
//     gridStrokeWidth  : 0.4,
//     pointSize        : 4,
//     pointStrokeColors: ['#efefef'],
//     gridLineColor    : '#efefef',
//     gridTextFamily   : 'Open Sans',
//     gridTextSize     : 10
//     });
// });
</script>
