<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CopieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:50'],
            'author' => ['required', 'string', 'max:50'],
            'book_publisher' => ['required', 'string', 'max:30'],
            'edition' => ['required', 'integer'],
            'volume' => ['required', 'integer'],
            'year' => ['required', 'integer'],
            'ISBN' => ['required', 'integer', 'min_digits:10',
                Rule::unique((new Book())->getTable())->ignore(auth()->id())]
        ];
    }
}
