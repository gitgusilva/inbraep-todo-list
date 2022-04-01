<template>
    <div class="item">
        <div class="info"><span>{{ name }}</span></div>
        <div class="options">
            <button v-on:click="$emit('edit')">Editar</button>
            <button v-on:click="$emit('remove')">Remover</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "TodoItem",
    props: ['name']
}
</script>

<style scoped>

</style>
