<template>
  <div class="modal" v-bind:class="[(opened) ? 'active' : '']">
    <form @submit.prevent="$emit('saveTodo', form)">
      <header>
        <button @click="$emit('closeModal', false)">X</button>
      </header>
      <main>
        <input type="checkbox" :checked="info['completed']" @change="(e) => form.completed = e.target.value" />
        <input type="text" :value="info['name']" @change="(e) => form.name = e.target.value" />
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
  props: ['opened', 'info'],
  data: () => {
    return {
      form: {
        id: this.info['id'],
        name: this.info['name'],
        completed: this.info['completed']
      }
    }
  },
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
