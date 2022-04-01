<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $item) {
        $this->todo = $item;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Todo
     */
    public function index()
    {
        return $this->todo->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Todo
     */
    public function store(Request $request): Todo
    {
        $newTodo = $this->todo;
        $newTodo->name = $request['name'];
        $newTodo->completed = $request['completed'];
        $newTodo->save();

        return $newTodo;
    }

    /**
     * Display the specified resource.
     *
     * @param  Todo $todo
     * @return Todo
     */
    public function show(Todo $todo)
    {
        return $todo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Todo $todo
     * @return Todo
     */
    public function update(Request $request, Todo $todo)
    {
        $todo->update($request->all());
        return $todo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Todo $todo
     * @return bool
     */
    public function destroy(Todo $todo)
    {
        return $todo->delete();
    }
}
