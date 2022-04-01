<template>
  <div class="todo-list">
    <header>
      <h1 class="title">Inbraep To-Do List</h1>
      <TodoForm/>
    </header>
    <div class="divider"/>
    <main>
      <TodoItem v-for="(todo, index) in todos" :key="index" :item="todo" v-on:remove="deleteTodo"/>
    </main>
    <footer>
      <div class="copyright">
        <span>To-Do List criada por Gustavo Silva.</span>
      </div>
    </footer>
  </div>
</template>

<script>
import TodoItem from "./TodoItem";
import TodoForm from "./TodoForm";

export default {
  name: "todo-list",
  components: {TodoForm, TodoItem},
  data: () => {
    return {
      todos: []
    }
  },
  methods: {
    getList: async function () {
      await axios.get("api/todo").then(res => {
        this.todos = res.data.data;
      }).catch(err => console.log(err));
    },
    deleteTodo: function (event) {
      alert(event.target.getAttribute('identifier'));
    }
  },
  created() {
    this.getList();
  },
}
</script>

<style scoped>
  .todo-list {
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
  }

  button:hover {
    cursor: pointer;
    box-shadow: inset 0 0 5px #333333;
  }
</style>
