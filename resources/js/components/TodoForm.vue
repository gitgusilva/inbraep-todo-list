<template>
  <div class="addItem">
    <input type="text" v-model="name" />
    <button class="add" @click="addTodo()"><font-awesome-icon icon="fa-solid fa-plus" /></button>
  </div>
</template>

<script>
export default {
  name: "TodoForm",
  data: () => {
    return {
      name: ""
    }
  },
  methods: {
    addTodo: function () {
      axios.post('api/todo', {
        name: this.name
      }).then(res => {
        console.log(res.data);
      }).catch(err => console.log(err));
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