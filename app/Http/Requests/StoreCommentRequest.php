<?php

namespace App\Http\Requests;

use App\Comment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class StoreCommentRequest extends FormRequest
{


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        // FacadesValidator::extends('canReply', function ($attribute, $value, $parameter) {
        //     if (!$value) {
        //         return true;
        //     }
        //     $comment = Comment::find($value);
        //     if ($comment) {
        //         return $comment->reply == 0;
        //     }
        //     return false;
        // });
        return [
            'username' => 'required|max:255',
            'email' => 'required|email',
            // 'reply' => 'canReply'
        ];
    }
}
