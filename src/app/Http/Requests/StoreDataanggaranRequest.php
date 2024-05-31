<?php

namespace App\Http\Requests;

use App\Models\Dataanggaran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDataanggaranRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('data_anggaran_create');
    }

    public function rules()
    {
        return [
        //     'name' => [
        //         'string',
        //         'nullable',
        //     ],
        //     'description' => [
        //         'string',
        //         'nullable',
        //     ],
        //     'stock' => [
        //         'nullable',
        //         'integer',
        //         'min:-2147483648',
        //         'max:2147483647',
        //     ],
        ];
    }
}