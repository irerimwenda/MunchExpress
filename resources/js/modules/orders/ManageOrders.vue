<template>
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>Order Id</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Customer Details</th>
                <th>Actions</th>
            </tr>
        </thead>

        <ordered-items :orders="orders.data"></ordered-items>

    </table>
    
</template>

<script>
import OrderedItems from './../../components/OrderedItems';

export default {
    props: ['orders'],
    components: {
        OrderedItems
    }
    
}
</script>