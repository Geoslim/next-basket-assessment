<?php

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request): array
    {
        return [
            'title' => [
              'required',
              Rule::unique('todo_lists', 'title')->ignore($request->todoList)
            ],
            'body' => 'required',
        ];
    }
}
