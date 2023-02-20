<template>
    <div class="form">
        <input class="input" type="text" name="todo" v-model="item.name" />
        <button :class="[item.name ? 'active' : 'inactive']" @click="addItem()">
            Add
        </button>
    </div>
    <loader :loading="loading"></loader>
</template>
<script>
import axios from "axios";
import Loader from "./loader.vue";
export default {
    name: "AddItemForm",
    data: function () {
        return {
            item: {
                name: "",
            },
            loading: false,
        };
    },
    methods: {
        async addItem() {
            this.loading = true;
            if (this.item.name == "") return;
            await axios
                .post("api/item/store", {
                    item: this.item,
                })
                .then((response) => {
                    if (response.status == 200) {
                        this.item.name = "";
                        this.$emit("reloadlist");
                    }
                    this.loading = false;
                })
                .catch((error) => {
                    console.log(error);
                    this.loading = false;
                });
        },
    },
    components: { Loader },
};
</script>
<style scoped>
.active {
    background-color: rgb(11, 190, 68);
    color: white;
    padding: 0px 10px 0px 4px;
}
.inactive {
    background-color: rgb(110, 118, 112);
    color: white;
    padding: 0px 10px 0px 4px;
}
.input {
    outline: none;
}
.form {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
