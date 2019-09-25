<template>

<div class="resto-group__wrapper mb-5">
    <div class="row">
        <div class="col-md-4 mb-4" v-for="restaurant in localRestaurants" :key='restaurant.id'>
            <card-component>
                <template slot="title">{{restaurant.name}}</template>
                <template slot="body">
                    <i class="fa fa-map-marker"></i> {{restaurant.location}}
                    <br/>
                    <i class="fa fa-table"></i> {{restaurant.tables}}
                    <br/>
                    <a class="card-link" v-bind:href="restaurant.slug">Menu</a>
                    <a class="card-link" v-bind:href="restaurant.ordersSlug">Orders</a>
                </template>
            </card-component>
        </div>
 
        <div class="col-md-4" v-if="showAddForm">
            <card-component>
                <template slot="title">Add New Restaurant</template>
                <template slot="body">
                    <button style="color:white" class="btn btn-info" @click="handleAddNewRestaurant">+ Add</button>
                </template>
            </card-component>

            <modal name="add-new-restaurant" height="55%" draggable="true">
                <div class="container-padding">

                    <RestaurantAddForm 
                    @addRestaurantEvent="handleSaveRestaurant"
                    @modalCancel="handleCancelRestaurant">
                    </RestaurantAddForm>

                </div>
            </modal>
        </div>
    </div>
</div>
    
</template>

<script>
import RestaurantAddForm from './RestaurantAddForm';
import axios from 'axios';

export default {
    components: {
        RestaurantAddForm
    },
    props: ['restaurants'],
    created() {
        console.log('this.restaurants.length', this.restaurants.length);
        this.localRestaurants = this.restaurants;
    },
    computed: {
        showAddForm() {
            return (this.localRestaurants.length < 5) ? true : false;
        }
    },
    data() {
        return {
            localRestaurants: []
        }
    },
    methods: {
        handleAddNewRestaurant() {
            this.$modal.show('add-new-restaurant');
        },
        handleCancelRestaurant() {
            this.$modal.hide('add-new-restaurant');
        },
        handleSaveRestaurant(restaurantData) {
            console.log('restaurantData', restaurantData);
            axios.post('/api/restaurant', restaurantData).then(response => {
                console.log('response', response.data);
                this.localRestaurants.unshift(response.data);
            this.$modal.hide('add-new-restaurant');
            });
        }
    }
}
</script>