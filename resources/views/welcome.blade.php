<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta name="csrf-token" content="{{csrf_token()}}">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div id="app">
    <example-component></example-component>
    <todo-list></todo-list>
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
<script>
    import ExampleComponent from "../js/components/ExampleComponent";
    import TodoList from "../js/components/TodoList";
    export default {
        components: {TodoList, ExampleComponent}
    }
</script>
