<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AskAiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'question' => ['required', 'string', 'min:3', 'max:1000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'question.required' => 'Pertanyaan tidak boleh kosong.',
            'question.min' => 'Pertanyaan minimal 3 karakter.',
            'question.max' => 'Pertanyaan maksimal 1000 karakter.',
        ];
    }
}