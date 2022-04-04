<template>
  <div class="todo-list">
    <header>
      <h1 class="title">Inbraep To-Do List</h1>
      <form @submit.prevent="createTodo">
        <input type="text" v-model="creatingTodo.name"/>
        <button type="submit" :disabled="!creatingTodo.name.length || todos.isLoading">
          <font-awesome-icon icon="fa-solid fa-plus"/>
        </button>
      </form>
    </header>
    <div class="divider"/>
    <main>
      <div class="list">
        <div v-if="todos.isLoading" class="loading">
          <div class="loader"/>
          <span>Carregando...</span>
        </div>
        <TodoItem v-if="!todos.isLoading && todos.data.length" v-for="(todo, index) in todos.data" :key="index"
                  :item="todo" v-on:delete="deleteTodo" v-on:edit="showEditModal"/>
        <div v-if="!todos.data.length && !todos.isLoading" class="empty">
          <font-awesome-icon icon="fa-solid fa-question" class="icon"/>
          <span class="description">Nada foi encontrado!</span>
        </div>
      </div>
      <sliding-pagination v-if="todos.data.length" class="pagination" :current="pagination.currentPage"
                          :total="pagination.lastPage" @page-change="refreshList"/>
    </main>
    <footer>
      <div class="copyright">
        <span>To-Do List criada por Gustavo Silva.</span>
      </div>
    </footer>

    <div class="modal" v-if="modal.isOpened">
      <form @submit.prevent="updateTodo">
        <header>
          <button type="button" @click="modal.isOpened = false">
            <font-awesome-icon icon="fa-solid fa-xmark"/>
          </button>
        </header>
        <main>
          <div class="form-group">
            <label for="name">Nome da tarefa:</label>
            <input id="name" type="text" v-model="editingTodo.name"/>
          </div>
          <div class="form-group align-row">
            <input id="completed" type="checkbox" v-model="editingTodo.completed"/>
            <label for="completed">Tarefa Completa?</label>
          </div>
        </main>
        <footer>
          <button type="submit">Salvar</button>
        </footer>
      </form>
    </div>
  </div>
</template>

<script>
import TodoItem from "./TodoItem";
import SlidingPagination from 'vue-sliding-pagination'

export default {
  name: "todo-list",
  components: {TodoItem, SlidingPagination},
  data: () => {
    return {
      todos: {
        isLoading: false,
        data: []
      },
      creatingTodo: {
        name: "",
      },
      editingTodo: {
        id: undefined,
        name: undefined,
        completed: undefined,
      },
      pagination: {
        firstPage: 1,
        currentPage: undefined,
        lastPage: undefined,
      },
      modal: {
        isOpened: false
      }
    }
  },
  methods: {
    refreshList: function (page = this.pagination.firstPage) {
      this.todos.isLoading = true;
      axios.get(`api/todos?page=${page}`).then((response) => {
        this.todos.data = response.data.data.data;
        this.pagination.currentPage = response.data.data.current_page;
        this.pagination.lastPage = response.data.data.last_page;
      }).catch(() => {
        return this.$toast.error("Ops, Ocorreu um erro inesperado ao consultar os itens existentes.");
      }).finally(() => {
        this.todos.isLoading = false;
      });
    },
    createTodo: function () {
      if (this.creatingTodo.name.length) {
        axios.post('api/todos', {
          name: this.creatingTodo.name
        }).then(res => {
          if (res.status === 201) {
            this.refreshList();
            return this.$toast.success(res.data.message);
          }
        }).catch(() => {
          return this.$toast.error("Ops, Ocorreu um erro inesperado ao criar o novo item.");
        });
        this.creatingTodo.name = "";
      }
    },
    deleteTodo: function (item) {
      axios.delete(`api/todos/${item}`).then(res => {
        if (res.status === 200) {
          this.refreshList();
          return this.$toast.success(res.data.message);
        }
      }).catch(err => console.log(err))
    },
    updateTodo: function () {
      this.todos.isLoading = true;
      this.modal.isOpened = false;
      axios.put(`api/todos/${this.editingTodo.id}`, this.editingTodo)
          .then((response) => {
            this.editingTodo.id = undefined;
            this.editingTodo.name = undefined;
            this.editingTodo.completed = undefined;

            if (response.status === 200) {
              this.refreshList();
              return this.$toast.success(response.data.message);
            }
          })
          .catch(() => {
            return this.$toast.error("Ops, Ocorreu um erro inesperado ao salvar as alterações do item.");
          })
          .finally(() => {
            this.todos.isLoading = false;
          })
    },
    showEditModal: function (item) {
      this.editingTodo.id = item.id;
      this.editingTodo.name = item.name;
      this.editingTodo.completed = item.completed;
      this.modal.isOpened = true;
    },
  },
  async created() {
    await this.refreshList();
  },
}
</script>

<style scoped>
.todo-list {
  position: relative;
  display: flex;
  flex-direction: column;
  max-width: 400px;
  width: 400px;
  background-color: #FFFFFF;
  border-radius: 0.300rem;
  overflow: hidden;
}

.todo-list > header {
  display: flex;
  flex-direction: column;
  padding: 15px 20px 0;
}

.todo-list > header > h1 {
  margin: 15px 0;
  color: #1a1e21;
  font-size: 1.5rem;
  font-weight: 600;
}

.todo-list > header > form {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: stretch;
  width: 100%;
}

.todo-list > header > form > input {
  display: block;
  width: 100%;
  padding: 0 10px;
  flex: 1 auto;
  border: 1px solid #c5c2c2;
  border-radius: 0.300rem;
}

.todo-list > header > form > button {
  margin-left: 10px;
}

.todo-list > .divider {
  height: 1px;
  margin: 20px;
  background-color: #c5c2c2;
}

.todo-list > main {
  padding-left: 20px;
  padding-right: 20px;
  margin-bottom: 20px;
}

.todo-list > main > .list {
  height: 350px;
  overflow: auto;
}

.todo-list > main > .list > .empty {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  text-align: center;
}

.todo-list > main > .list > .empty > .icon {
  font-size: 35px;
}

.todo-list > main > .list > .empty > span.description {
  font-size: 15px;
  margin-top: 15px;
}

.todo-list > footer > .copyright {
  padding: 15px 20px;
  text-align: center;
  background-color: #0d6efd;
}

.todo-list > footer > .copyright > span {
  color: #FFFFFF;
  font-weight: 500;
}

.todo-list > .modal {
  position: absolute;
  inset: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.8);
  -webkit-backdrop-filter: saturate(180%) blur(5px);
  backdrop-filter: saturate(180%) blur(5px);
}

.todo-list > .modal > form {
  display: flex;
  flex-direction: column;
  width: 80%;
  padding: 15px;
  background-color: #FFFFFF;
  -webkit-box-shadow: 0px 3px 11px -5px #242424;
  box-shadow: 0px 3px 11px -5px #242424;
  border-radius: 0.300rem;
}

.todo-list > .modal > form > header, .todo-list > .modal > form > footer {
  display: flex;
  justify-content: end;
}

.todo-list > .modal > form > main > .form-group {
  display: flex;
  flex-direction: column;
}

.todo-list > .modal > form > main > .form-group:not(:first-child) {
  margin-top: 15px;
}

.todo-list > .modal > form > main > .form-group.align-row {
  flex-direction: row;
  align-items: center;
}

.todo-list > .modal > form > main > .form-group input {
  width: 100%;
  height: 40px;
  padding-left: 10px;
  padding-right: 10px;
  border: 1px solid #c5c2c2;
  border-radius: 0.300rem;
}

.todo-list > .modal > form > main > .form-group input[type=checkbox] {
  width: 25px;
  height: 25px;
  padding: unset;
}

.todo-list > .modal > form > main > .form-group label {
  margin-bottom: 8px;
  font-size: 1.2rem;
}

.todo-list > .modal > form > main > .form-group.align-row label {
  margin-left: 5px;
  margin-bottom: unset;
}


.todo-list > .modal > form > footer {
  margin-top: 15px;
}

@media (max-width: 769px) {
  .todo-list {
    display: flex;
    justify-content: space-around;
    width: 100%;
    max-width: unset;
    min-height: 100vh;
    border-radius: unset;
    overflow: auto;
  }
}
</style>
