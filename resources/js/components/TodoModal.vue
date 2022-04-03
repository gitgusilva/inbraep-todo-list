<template>
  <div class="modal" v-bind:class="[(opened) ? 'active' : '']">
    <form @submit.prevent="sendData">
      <header>
        <button @click="$emit('cancelEdit', false)">X</button>
      </header>
      <main>
        <input type="checkbox" :checked="completed" />
        <input type="text" :value="name" @change="changeValue" />
      </main>
      <footer>
        <button type="submit">Save</button>
      </footer>
    </form>
  </div>
</template>

<script>
export default {
  name: "TodoModal",
  props: ['opened', 'name', 'completed'],
  methods: {
    changeValue: function (event) {
      this.name = event.target.value;
    },
    sendData: function () {

    }
  }
}
</script>

<style scoped>
.modal {
  position: absolute;
  inset: 0;
  display: none;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.8);
  -webkit-backdrop-filter: saturate(180%) blur(5px);
  backdrop-filter: saturate(180%) blur(5px);
}

.modal.active {
  display: flex;
}

.modal > form {
  width: 80%;
  height: auto;
  padding: 15px;
  background-color: #FFFFFF;
  border-radius: 0.300rem;
}
</style>
