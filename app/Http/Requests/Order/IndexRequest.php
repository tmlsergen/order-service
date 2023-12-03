<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'filters' => 'nullable|array',
            'filters.*.field' => 'string',
            'filters.*.operator' => 'string|in:=,!=,>,<,>=,<=,like,not like,in,not in',
            'filters.*.value' => 'string',
            'sort' => 'nullable|array',
            'sort.field' => 'string',
            'sort.direction' => 'string|in:asc,desc',
            'paging' => 'nullable|array',
            'paging.page' => 'integer',
            'paging.limit' => 'integer',
        ];
    }
}
