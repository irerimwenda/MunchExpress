<template>
<div class="resto_add_form_wrapper">
    <h3>Add a new restaurant</h3>

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text"
        class="form-control"
        name="name"
        v-model="restaurant.name"
        placeholder="Enter Restaurant Name">
    </div>

    <div class="form-group">
        <label for="name">Address</label>
        <input type="text"
        class="form-control"
        name="location"
        v-model="restaurant.location"
        placeholder="Enter Restaurant Address">
    </div>

    <div class="form-group">
        <label for="name">Number of Tables</label>
        <input type="text"
        class="form-control"
        name="tables"
        v-model="restaurant.tables"
        placeholder="Enter Restaurant Tables">
    </div>

    <button class="btn btn-primary" @click="handleAddButton">Add</button>
    <button class="btn btn-warning" @click="handleCancelButton">Cancel</button>
</div>
    
</template>

<script>
/* import axios from 'axios'; */

export default {
    /* created() {
        axios.get('/api/user')
        .then(response => {
            console.log(response.data);
        });
    }, */
    data() {
        return {
            restaurant: this.basicResto()
        }
    },
    methods: {
        basicResto() {
            return { name: "", location: "", tables: 0 }
        },
        handleAddButton() {
            this.$emit('addRestaurantEvent', this.restaurant);
        },
        handleCancelButton() {
            this.restaurant = this.basicResto();
            this.$emit('modalCancel');
        }
    }
     
}
</script>