<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationHandlerException;
use Illuminate\Foundation\Http\FormRequest;

class CreatePublishRequest extends FormRequest
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
        $data = $this->request->all();

        $errorBag =  [];

        if (sizeof($data) > 0) {
            foreach ($data as $key => $value) {
                if (empty($value)) {
                    $errorBag[$key] = $value;
                }
            }

            if (sizeof($errorBag) > 0) {
                throw new ValidationHandlerException($errorBag, "the following fields listed have no values attached");
            }
            return [];
        }

        throw new ValidationHandlerException($errorBag, "Data to publish should be in value:key pairs format");
    }
}
