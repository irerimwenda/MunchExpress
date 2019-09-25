<template>

<div class="add_form__wrapper">
    <form v-on:submit.prevent="handleSubmit">
        <div class="form-group">
            <label for="name">Food Item</label>
            <input type="text" class="form-control" placeholder="Enter food item name"
            v-model="food.item">

            <div class="validation-message" 
            v-text="validation.getMessage('item')">
            </div>

        </div>

        <div class="form-group">
            <label for="name">Select category</label>
            <multiselect
            v-model="food.category"
            :options="categories"
            ></multiselect>

            <div class="validation-message" 
            v-text="validation.getMessage('category')">
            </div>
        </div>

        <div class="form-group">
            <label for="name">Price</label>
            <input type="number" placeholder="Enter food item price" class="form-control"
            v-model="food.price">

            <div class="validation-message" 
            v-text="validation.getMessage('price')">
            </div>
        </div>

        <div class="form-group">
            <label for="name">Description</label>
            <textarea class="form-control" v-model="food.description" placeholder="Enter item description"></textarea>

            <div class="validation-message" 
            v-text="validation.getMessage('description')">
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
    
</template>

<script>
import Multiselect from 'vue-multiselect';
import Validation from  './../../utils/Validation.js';

export default {
    props: ['categories', 'restoraunt_id'],
    components: {
        Multiselect
    },

    data() {
        return {
            food: this.emptyFoodItem(),
            validation: new Validation()
        }
    },

    methods: {
        emptyFoodItem() {
           return {
                item: '',
                category: '',
                price: 100,
                description: '', 
           } 
        },
        handleSubmit() {
            console.log('form data', this.food);

            let postData = this.food;
            postData.restoraunt_id = this.restoraunt_id;
            window.axios.post('/api/item/save', postData).then(response => {
                console.log('response', response.data);
                this.$emit('newMenuItemAdded', response.data, postData.category);
                this.food = this.emptyFoodItem();
            }).catch(error => {
                console.log('error', error.response);
                if (error.response.status == 422){
                    this.validation.setMessages(error.response.data.errors);
                }
                });

            /* let postData = this.food;
            postData.restoraunt_id = this.restoraunt_id;
            window.axios.post('api/item/save', postData).then(response => {
                console.log('response', response.data);
            }).catch(error => console.log('error', error.response)); */
        }
    }
}
</script>