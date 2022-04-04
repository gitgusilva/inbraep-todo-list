<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Type\Integer;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $item)
    {
        $this->todo = $item;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json([
                "message" => "Sucesso ao buscar por itens.",
                "data" => $this->todo->paginate(10)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Ops, Nenhum item foi encontrado na busca. Tente novamente mais tarde!"
            ], 403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request): JsonResponse
    {
        try {
            if (!$request['name']) {
                return response()->json([
                    "message" => "Ops, Você deve informar o nome do item. Tente novamente!"], 400);
            }

            $newTodo = $this->todo;
            $newTodo->name = $request['name'];
            $newTodo->save();

            return response()->json([
                "message" => "Item $newTodo->name, criado com sucesso."], 201);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Ops, Ocorreu um erro ao criar o item. Tente novamente!"
            ], 403);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param Todo $todo
     * @return JsonResponse
     */
    public function show(Todo $todo): JsonResponse
    {
        try {
            return response()->json([
                "message" => "Sucesso ao encontrar o item solicitado.",
                "data" => $todo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Ops, Ocorreu um erro ao exibir o item informado. Tente novamente!"
            ], 403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Todo $todo
     * @return JsonResponse
     */
    public function update(Request $request, Todo $todo): JsonResponse
    {
        try {
            $todo->update($request->all());

            return response()->json([
                "message" => "Sucesso ao editar o item solicitado.",
                "data" => $todo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Ops, Ocorreu um erro ao atualizar as informações do item informado. Tente novamente!"
            ], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Todo $todo
     * @return JsonResponse
     */
    public function destroy(Todo $todo): JsonResponse
    {
        try {
            $todo->delete();

            return response()->json([
                "message" => "Sucesso ao deletar o item solicitado."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Ops, Ocorreu um erro ao excluir o item informado. Tente novamente!"
            ], 403);
        }
    }
}
