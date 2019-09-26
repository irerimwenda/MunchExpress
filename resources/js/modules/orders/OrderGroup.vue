<template>
    <div>
        <div class="row">
            <div class="col-md-12 mb-2">
                <button @click="handleOrderSave" class="btn btn-success float-right">Save</button>
            </div>
        </div>
        <div class="row">
        <div class="col-md-7">
            <div class="mb-5">
                <h3>Customer Details</h3>
                <order-form 
                @customerDetailsChanged="handleCustomerDetails">
                </order-form>
            </div>

            <div class="mb-5">
                <h3>Order Details <span class="float-right" v-if="finalAmount > 0">{{finalAmount}}</span></h3>
                <order-details
                :order-details="orderDetails">
                </order-details>
            </div>
        </div>

        <div class="col-md-5">
            <h3>Menu</h3>
            <order-menu-items
            :items="menuItems"
            @menuItemAdded="handleNewMenuItem">
            </order-menu-items>
        </div>
    </div>
    </div>
</template>

<script>
import OrderForm from './OrderForm.vue';
import OrderMenuItems from './OrderMenuItems.vue';
import OrderDetails from './OrderDetails.vue';
import axios from 'axios';

export default {
    props: ['restaurant_id'],
    components: {
        OrderForm, OrderMenuItems ,OrderDetails
    },
    created() {
        this.loadRestaurantMenuItems();
        window.eventBus.$on('menuItemAdded', this.handleNewMenuItem);
        window.eventBus.$on('filteredList', this.handleFilteredList);
        window.eventBus.$on('clearFilteredList', this.handleClearedFilteredList);
    },
    computed: {
        finalAmount() {
            let price = 0;
            //this.orderDetails.forEach(order => price = price + order.price);
            this.orderDetails.forEach(order => {
                price = price + order.price;
            }); 
            return price;
        }
    },
    data () {
        return {
            menuItems: [],
            orderDetails: [],
            originalMenuItems: [],
            customerDetails: null
        }
    }, 
    methods: {
        loadRestaurantMenuItems() {
            let postData = {restaurant_id: this.restaurant_id}
            axios.post('/api/restaurant/menu', postData)
            .then(response => {
                //console.log('response', this.menuItems = response.data)
                this.menuItems = response.data
                this.originalMenuItems = response.data
            })
            .catch(error => console.error(error.response))
        },
        handleNewMenuItem(item) {
            this.orderDetails.unshift(item);
        }, 
        handleFilteredList(filteredList) {
            this.menuItems = filteredList;
        },
        handleClearedFilteredList() {
            this.menuItems = this.originalMenuItems;
        },
        handleCustomerDetails(customer) {
            console.log('customer', customer); 
            this.customerDetails = customer;
        },
        handleOrderSave() {
            let orderedItemsIds = [];

            this.orderDetails.forEach(item => {
                orderedItemsIds.push(item.id);
            });

            let orderData = {
                customerDetails: this.customerDetails,
                finalAmount: this.finalAmount,
                orderDetails: orderedItemsIds
            };

            console.log(orderData);
            axios.post('/api/order/save', orderData).then(response => console.log('response', response))
        }
    }
    
}
</script> 