<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ItemTakeOutRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user' => 'required|email|exists:users,email',
            'koli' => 'required|exists:koli,koli',
            'item.*.name' => 'required|exists:user_koli_item,item_key'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
