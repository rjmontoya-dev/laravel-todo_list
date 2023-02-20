<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">Todo List</h2>
            <AddItemForm v-on:reloadlist="getList()" />
        </div>
        <listView :items="items" v-on:reloadlist="getList()" />
    </div>
    <Loader :loading="loading"></Loader>
</template>
<script>
import axios from "axios";
import AddItemForm from "./AddItemForm.vue";
import listView from "./listView.vue";
import Loader from "./loader.vue";
export default {
    components: {
        AddItemForm,
        listView,
        Loader,
    },
    data: function () {
        return {
            items: [],
            loading: false,
        };
    },
    methods: {
        async getList() {
            this.loading = true;
            await axios
                .get("api/items")
                .then((response) => {
                    this.loading = false;

                    this.items = response.data;
                    if (response.status == 200) {
                        this.$emit("itemchanged");
                    }
                })
                .catch((error) => {
                    console.log(error);
                    this.loading = false;
                });
        },
    },
    created() {
        this.getList();
    },
};
</script>
<style scoped>
.todoListContainer {
    width: 400px;
    margin: auto;
    margin-top: 20px;
}
.heading {
    background: rgb(197, 195, 195);
    padding: 10px;
}
#title {
    text-align: center;
    font-size: 30px;
}
</style>
