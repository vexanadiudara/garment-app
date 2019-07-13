<?php

namespace App\Http\Requests\API;

use App\Models\OperatorGosok;
use Webcore\Generator\Request\APIRequest;

class CreateOperatorGosokAPIRequest extends APIRequest
{
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
        return OperatorGosok::$rules;
    }
}
