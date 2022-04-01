<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component. slc tiu
                    </div>

                    <button @click="incrementCounter">Clique aqui</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "example-component",
        beforeMount() {
            console.log('Component mount initialized.');
        },
        mounted() {
            console.log('Component mounted. I\'m happy!!');
        },
        methods: {
            incrementCounter: () => {
                alert("alohhhhaaaa");
                axios.get('api/item', this.item.id).then(res => {
                    const {email, nome} = res;
                    console.log(`Dados recebidos: ${email}, ${nome}`);
                }).catch(err => {
                   console.log(err);
                });
            }
        }
    }
</script>

<style>
    body {
        background: black;
        height: 100vh;
    }
</style>
