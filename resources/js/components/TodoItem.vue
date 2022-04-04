<template>
  <div class="item">
    <div class="info">
      <input type="checkbox" :checked="item.completed" disabled>
      <div class="description">
        {{ item.name }}
      </div>
    </div>
    <div class="options">
      <button class="edit" @click="$emit('editTodo', item.id)">
        <font-awesome-icon icon="fa-solid fa-pencil"/>
      </button>
      <button class="remove" @click="$emit('deleteTodo', item.id)">
        <font-awesome-icon icon="fa-solid fa-trash-can"/>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "TodoItem",
  props: ['item'],
  data: () => {
    return {
      editing: false
    }
  },
  methods: {
    editTodo: function () {

    },
  }
}
</script>

<style scoped>
/* Item card & description */
.item, .item > .options {
  display: flex;
  flex-direction: row;
  align-items: center;
}

.item {
  padding: 10px;
  border: 1px solid #c5c2c2;
  border-radius: 0.300rem;
}

.item:not(:first-child) {
  margin-top: 10px;
}

.item > .info, .item > .info > .description {
  display: flex;
  flex-direction: row;
  align-items: center;
  width: 100%;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}

.item > .info > input {
  width: 20px;
  height: 20px;
  margin-right: 10px;
}

/* Buttons */
.item > .options > .edit {
  background-color: #0d6efd;
}

.item > .options > .edit:hover {
  background-color: #489cfa;
}

.item > .options > .remove {
  background-color: #810e0e;
}

.item > .options > .remove:hover {
  background-color: #8d2b2b;
}

.item > .options > button:not(:first-child) {
  margin-left: 10px;
}
</style>
