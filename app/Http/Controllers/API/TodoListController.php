<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Todo\StoreRequest;
use App\Http\Requests\Todo\UpdateRequest;
use App\Http\Resources\TodoListResource;
use App\Models\TodoList;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            return $this->successResponse(TodoList::with('user')->get());
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            return $this->successResponse(
                TodoListResource::make(
                    $request->user()->todoLists()->create($data)
                ),
                'Operation Successful',
                Response::HTTP_CREATED
            );

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, TodoList $todoList): JsonResponse
    {
        try {
            $data = $request->validated();

            $todoList->update($data);
            return $this->successResponse(
                TodoListResource::make($todoList)
            );

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroy(TodoList $todoList): JsonResponse
    {
        try {
            $todoList->delete();
            return $this->successResponse(
                null,
                'Todo Deleted Successfully',
                Response::HTTP_NO_CONTENT
            );

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
