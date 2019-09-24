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
        name="address"
        v-model="restaurant.address"
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
export default {
    data() {
        return {
            restaurant: this.basicResto()
        }
    },
    methods: {
        basicResto() {
            return { name: "", address: "", tables: 0 }
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