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
    <todo-list></todo-list>
</div>
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
</body>
</html>
<script>
    import TodoList from "../js/components/TodoList";
    export default {
        components: {TodoList}
    }
</script>
<?php /**PATH D:\Projects\In Development\inbraep-todo-list\resources\views/welcome.blade.php ENDPATH**/ ?>