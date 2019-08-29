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
            businesses: [],
            business:{
                id: '',
                name: '',
                description: '',               
            }     
        }
    },
    created(){
        this.fetchBusiness();
    },

    methods: {
        fetchBusiness(){
            fetch('/api/business')
            .then(res => res.json())
            .then(res => {
                this.businesses = res.data;
                console.log(this.businesses)
            })
        }
    }
}
</script>
