<template>
    <div class="todo-list">
        <h1>Title</h1>
        <div class="items">
            <TodoItem v-for="(todo, index) in todos" :key="index" :name="todo" v-on:edit="updateTodo(index)"
                      v-on:remove="deleteTodo(index)"/>
        </div>
    </div>
</template>

<script>
import TodoItem from "./TodoItem";

export default {
    name: "todo-list",
    components: {TodoItem},
    data: () => {
        return {
            todos: [
                "Todo de teste",
                "slc mermão",
                "sei lá o que"
            ]
        }
    },
    methods: {
        updateTodo: (index) => {
            alert(`Updated ${index}`);
            console.log(axios.get('/api/todo'));
        },
        deleteTodo: (index) => {
            axios.delete('/api/todo', index);
            alert(`Deleted ${index}`);
        }
    }
}
</script>

<style scoped>

</style>
