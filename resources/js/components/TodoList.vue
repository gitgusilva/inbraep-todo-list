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
      <sliding-pagination
          :current="pagination.currentPage"
          :total="pagination.lastPage"
          @page-change="getList"
          v-if="todos.length"
          class="pagination"
      ></sliding-pagination>
    </main>
    <footer>
      <div class="copyright">
        <span>To-Do List criada por Gustavo Silva.</span>
      </div>
    </footer>

    <TodoModal :opened="modal.opened" info:="modal.data" v-on:saveTodo="saveTodo" v-on:closeModal="cancelEdit"/>
  </div>
</template>

<script>
import TodoItem from "./TodoItem";
import TodoForm from "./TodoForm";
import TodoModal from "./TodoModal";
import SlidingPagination from 'vue-sliding-pagination'

export default {
  name: "todo-list",
  components: {TodoModal, TodoForm, TodoItem, SlidingPagination},
  data: () => {
    return {
      todos: [],
      name: "",
      modal: {
        opened: false,
        data: null
      },
      pagination: {
        firstPage: 1,
        currentPage: Number,
        lastPage: Number,
      }
    }
  },
  methods: {
    getList: function (page = this.pagination.firstPage) {
      axios.get("api/todo?page=" + page).then(res => {
        this.todos = res.data.data.data;
        this.pagination.currentPage = res.data.data.current_page;
        this.pagination.lastPage = res.data.data.last_page;
      }).catch(err => console.log(err));
    },
    addTodo: function (name) {
      axios.post('api/todo', {
        name: name
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
    saveTodo: function (item) {
      axios.patch('api/todo/' + item.id, {
        name: item.name,
        completed: item.completed
      }).then(res => {
        if (res.status === 200) {
          this.getList();
        }
      }).catch(err => console.log(err));
    },
    editTodo: function (item) {
      this.modal.opened = true;
      this.modal.data = this.todos.find(e => e.id === item);
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

.todo-list > main .pagination {
  margin-top: 20px;
}

.todo-list > main .pagination ul {
  display: flex;
  flex-direction: row;
  width: 100%;
  margin: 0;
  padding: 0;
}

.todo-list > main .pagination ul > li {
  list-style-type: none;
}

.todo-list > main .pagination ul > li:not(:first-child) {
  margin-left: 5px;
}

.todo-list > main .pagination ul > li a {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 30px;
  height: 30px;
  color: #FFFFFF;
  text-decoration: none;
  background-color: #247DFFFF;
  border-radius: 0.300rem;
}

.todo-list > main .pagination > ul > li a.c-sliding-pagination__page--current, .todo-list > main .pagination > ul > li a:hover {
  background-color: #254674;
}

.todo-list > main .pagination > ul > li.c-sliding-pagination__list-element--disabled a {
  cursor: not-allowed;
  color: #333333;
  background-color: #c9c9c9;
}

</style>
