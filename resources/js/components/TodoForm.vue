<template>
  <div class="addItem">
    <input type="text" :value="item" @change="changeValue" />
    <button class="add" @click="$emit('createTodo', item)"><font-awesome-icon icon="fa-solid fa-plus" /></button>
  </div>
</template>

<script>
export default {
  name: "TodoForm",
  props: ['item'],
  methods: {
    changeValue: function (event) {
      this.item = event.target.value;
    }
  }
}
</script>

<style scoped>
.addItem {
  display: flex;
  flex-direction: row;
  align-items: center;
  padding: 10px;
  border: 1px solid #c5c2c2;
  border-radius: 0.300rem;
}

.addItem > input {
  display: block;
  width: 100%;
  flex: 1 auto;
}

.addItem > .add {
  background-color: #5bb42b;
}
</style>
