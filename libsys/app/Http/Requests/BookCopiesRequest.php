<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BookCopiesRequest extends FormRequest
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
            'copies' => ['required', 'integer', 'min:1'],
            'reference_books' => ['required', 'integer', 'min:0',
                function ($attribute, $value, $fail) {
                    $numberOfCopies = $this->input('copies');
                    if ($value > $numberOfCopies) {
                        $fail('O número de livros de referência deve ser menor que o número de cópias.');
                    }
                },
            ]
        ];
    }
}
