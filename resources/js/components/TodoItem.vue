<template>
  <div class="item" v-bind:class="[item.completed ? 'completed' : '']">
    <div class="info">
      <input type="checkbox" :checked="item.completed" disabled />

      <div class="description">
        {{ item.name }}
      </div>
    </div>
    <div class="options">
      <button class="edit" @click="$emit('edit', item)">
        <font-awesome-icon icon="fa-solid fa-pencil"/>
      </button>
      <button class="remove" @click="$emit('delete', item.id)">
        <font-awesome-icon icon="fa-solid fa-trash-can"/>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "TodoItem",
  props: ['item'],
}
</script>

<style scoped>
/* Item card & description */
.item {
  position: relative;
  padding: 10px;
  border: 1px solid #c5c2c2;
  border-radius: 0.300rem;
}

.item, .item > .options {
  display: flex;
  flex-direction: row;
  align-items: stretch;
}

.item:not(:first-child) {
  margin-top: 10px;
}

.item.completed {
  color: #707070;
  background-color: #d0d0d0;
}

.item.completed > .info > .description {
  text-decoration: line-through;
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
