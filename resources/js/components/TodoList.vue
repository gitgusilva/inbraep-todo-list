<template>
  <div class="todo-list">
    <header>
      <h1 class="title">Inbraep To-Do List</h1>
      <TodoForm v-on:createTodo="addTodo" :item="name"/>
    </header>
    <div class="divider"/>
    <main>
      <div class="list">
        <TodoItem v-for="(todo, index) in todos" :key="index" :item="todo" v-on:deleteTodo="deleteTodo" v-on:editTodo="editTodo"/>
        <div v-if="!todos.length" class="empty">
          <font-awesome-icon icon="fa-solid fa-question" class="icon"/>
          <p class="description">Não existe nenhum dado guardado, tente criar um novo.</p>
        </div>
      </div>
      <div v-if="todos.length" class="pagination">
        <button type="button" :disabled="pagination.currentPage === pagination.firstPage"
                @click="getList(pagination.currentPage-1)">Previous
        </button>
        <button type="button" class="page-link" v-for="pageNumber in pagination.lastPages"
                v-bind:class="[(pageNumber === pagination.currentPage) ? 'active' : '']" @click="getList(pageNumber)">
          {{ pageNumber }}
        </button>
        <button type="button"
                :disabled="pagination.currentPage > pagination.lastPage"
                @click="getList(pagination.currentPage+1)">Next
        </button>
      </div>
    </main>
    <footer>
      <div class="copyright">
        <span>To-Do List criada por Gustavo Silva.</span>
      </div>
    </footer>

    <TodoModal :opened="modal.opened" v-on:cancelEdit="cancelEdit"/>
  </div>
</template>

<script>
import TodoItem from "./TodoItem";
import TodoForm from "./TodoForm";
import TodoModal from "./TodoModal";

export default {
  name: "todo-list",
  components: {TodoModal, TodoForm, TodoItem},
  data: () => {
    return {
      todos: [],
      name: "",
      modal: {
        opened: false,
        data: {
          id: Number,
          completed: Boolean,
          name: String,
        }
      },
      pagination: {
        firstPage: Number,
        currentPage: Number,
        lastPage: Number,
      }
    }
  },
  methods: {
    getList: function (page = this.pagination.firstPage) {
      axios.get("api/todo?page=" + page).then(res => {
        this.todos = res.data.data;
        this.pagination.currentPage = res.data.current_page;
        this.pagination.lastPages = res.data.last_page;
      }).catch(err => console.log(err));
    },
    addTodo: function (name) {
      axios.post('api/todo', {
        name: name,
        completed: 0
      }).then(res => {
        if (res.status === 201) {
          this.getList();
        }
      }).catch(err => console.log(err));

      this.name = "";
    },
    deleteTodo: function (item) {
      axios.delete('api/todo/' + item).then(res => {
        if (res.status === 200) {
          this.getList();
        }
      }).catch(err => console.log(err));
    },
    editTodo: function (item) {
      this.modal.opened = true;
      let info = this.todos.find(e => e.id === item);
      console.log(info);
    },
    cancelEdit: function (cancel) {
      return this.modal.opened = cancel;
    },
  },
  async created() {
    await this.getList();
  },
}
</script>

<style scoped>
.todo-list {
  position: relative;
  display: flex;
  flex-direction: column;
  max-width: 400px;
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
  margin: 15px auto;
  color: #1a1e21;
  font-size: 1.7rem;
  font-weight: 600;
  text-align: center;
  text-transform: uppercase;
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

.todo-list > main > .list::-webkit-scrollbar {
  width: 10px;
}

.todo-list > main > .list > .empty {
  width: 80%;
  text-align: center;
}

.todo-list > main > .list > .empty > .icon {
  font-size: 35px;
}

.todo-list > main > .list > .empty > .description {
  font-size: 15px;
}

.todo-list > main > .pagination {
  display: flex;
  flex-direction: row;
  width: 100%;
  margin-top: 20px;
}

.todo-list > main > .pagination button:not(:first-child) {
  margin-left: 10px;
}

.todo-list > main > .pagination button.active {
  background-color: red;
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

<style>
button {
  display: flex;
  align-items: center;
  padding: 10px;
  color: #FFFFFF;
  border: none;
  border-radius: 0.300rem;
  background-color: #0d6efd;
}

button:disabled {
  color: #707070;
  background-color: #d0d0d0;
}

button:not(:disabled):hover {
  cursor: pointer;
  box-shadow: inset 0 0 5px #333333;
}
</style>
