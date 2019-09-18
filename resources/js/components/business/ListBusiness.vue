<template>
    <section class="content">
        <div class="row">
            <form @submit.prevent="addBusiness">
                <div class="form-group">
                    <input type="text" class="form-control" 
                    placeholder="Business name" v-model="business.name">
                </div>
                <div class="form-group">
                    <textarea type="text" class="form-control" 
                    placeholder="Business description" v-model="business.description"></textarea>
                </div>
                <button type="submit" class="btn btn-light btn-block">Save</button>
            </form>
           
            <div class="col-lg-12 col-xs-12">
                <div class="card card-body mb-2" v-for="business in businesses" v-bind:key="business.id">
                    <h3>{{ business.name }}</h3>
                    <p>{{ business.description }}</p>
                    <hr>
                    <button @click="editBusiness(business)" class="btn btn-warning">Edit</button>
                    <button @click="deleteBusiness(business.id)" class="btn btn-danger">Delete</button>
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
            },
            business_id: '',
            edit: false   
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
            })
            .catch(err => console.log(err));
        },
        deleteBusiness(id){
            if(confirm('Are you Sure?')){
                fetch('api/business/'+id, {
                    method: 'delete'
                })
                .then(res => res.json())
                .then(res => {
                    alert('Business Removed');
                    this.fetchBusiness();
                })
                .catch(err => console.log(err));
            }
        },
        addBusiness(){
            if(this.edit === false){
                fetch('api/business', {
                    method: 'post',
                    body: JSON.stringify(this.business),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.business.name = '';
                    this.business.description = '';
                    alert('Business Added');
                    this.fetchBusiness();
                })
                .catch(err => console.log(err))
            } else {
                fetch('api/business', {
                    method: 'put',
                    body: JSON.stringify(this.business),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.business.name = '';
                    this.business.description = '';
                    alert('Business Updated');
                    this.fetchBusiness();
                })
                .catch(err => console.log(err))
            }            
        },
        editBusiness(business){
            this.edit = true;
            this.business.id - business.id;
            this.business.business_id = business.id;
            this.business.name = business.name;
            this.business.description = business.description;
        }
    }
}
</script>
