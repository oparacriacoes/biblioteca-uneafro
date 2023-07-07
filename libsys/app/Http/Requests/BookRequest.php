<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'number_of_copies' => ['required', 'integer', 'min:1'],
            'number_of_reference_book' => ['required', 'integer', 'min:0',
                function ($attribute, $value, $fail) {
                    $numberOfCopies = $this->input('number_of_copies');
                    if ($value > $numberOfCopies) {
                        $fail('O número de livros de referência deve ser menor que o número de cópias.');
                    }
                },
            ],
            'ISBN' => ['required', 'integer', 'min_digits:10', 'unique:book']
        ];
    }
}
