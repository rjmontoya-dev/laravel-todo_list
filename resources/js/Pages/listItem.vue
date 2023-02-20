<template>
    <div class="item">
        <input
            type="checkbox"
            @change="updateCheck()"
            v-model="item.completed"
        />
        <span :class="[item.completed ? 'completed' : '', 'itemText']">{{
            item.name
        }}</span>
        <button class="trash" @click="removeItem()">delete</button>
    </div>
    <loader :loading="loading"></loader>
</template>
<script>
import axios from "axios";
import loader from "./loader.vue";
export default {
    props: ["item"],
    name: "listItem",
    components: { loader },
    data: function () {
        return {
            loading: false,
        };
    },
    methods: {
        async updateCheck() {
            this.loading = true;
            await axios
                .post("api/item/" + this.item.id, {
                    item: this.item,
                })
                .then((response) => {
                    if (response.status == 200) {
                        this.$emit("itemchanged");
                    }
                    this.loading = false;
                })
                .catch((error) => {
                    console.log(error);
                    this.loading = false;
                });
        },
        async removeItem() {
            await axios
                .post("api/item/" + this.item.id, {
                    item: this.item,
                })
                .then((response) => {
                    if (response.status == 200) {
                        this.$emit("itemchanged");
                    }
                    this.loading = !this.loading;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
<style>
.completed {
    text-decoration: line-through;
    color: #999999;
}
.itemText {
    width: 100%;
    margin-left: 20px;
}
.item {
    display: flex;
    justify-content: center;
    align-items: center;
}
.trash {
    color: red;
}
</style>
