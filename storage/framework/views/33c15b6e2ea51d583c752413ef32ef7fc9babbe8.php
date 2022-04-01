<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>
<body>
<div id="app">
    <example-component></example-component>
    <todo-list></todo-list>
</div>
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
</body>
</html>
<script>
    import ExampleComponent from "../js/components/ExampleComponent";
    import TodoList from "../js/components/TodoList";
    export default {
        components: {TodoList, ExampleComponent}
    }
</script>
<?php /**PATH C:\Users\gugco\PhpstormProjects\untitled\resources\views/welcome.blade.php ENDPATH**/ ?>