<template>
    <div>
        <div v-for="(item, index) in items" :key="index">
            <listItem
                :item="item"
                class="item"
                v-on:itemchanged="$emit('reloadlist')"
            />
        </div>
    </div>
</template>
<script>
import listItem from "./listItem.vue";
export default {
    props: ["items"],
    name: "listView",
    components: {
        listItem,
    },
};
</script>
<style scoped>
.item {
    background: rgb(198, 195, 195);
    padding: 5px;
    margin-top: 5px;
}
</style>
