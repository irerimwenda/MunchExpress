<template>
<div v-if="orderDetails && orderDetails.length > 0">
    <ul class="list-group">
        <li class="list-group-item" v-for="(item, key) in orderDetails" :key="key">
            {{item.name}} 
            <span class="float-right">
                {{item.price}}
                <span class="ml-3 pointer" @click="handleRemoveItem(item)">X</span>
            </span>
        </li>
    </ul>
</div>

<div v-else>
    <p>No Items Ordered Yet</p>
</div>
</template>

<script>
export default {
    props: ['orderDetails'],
    methods: {
        handleRemoveItem(item){
            window.eventBus.$emit('removeOrderedItem', item);
        }
    }
}
</script>