<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMembershipRequest extends FormRequest
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
        return [
            'gvBrowseCompanyName' => 'required|string|max:255',
            'gvBrowseAttention' => 'required|string|max:255',
            'gvBrowseUDF_NOAHLISKMC' => 'required|numeric',
            'gvBrowseUDF_TEMPATLAHIR' => 'required|string|max:255',
            'gvBrowseUDF_ICNO' => 'required|string|max:255',
            'gvBrowsePhone1' => 'required|string|max:255',
            'gvBrowseAddress1' => 'required|string|max:255',
            'area_id' => 'integer|required',
            'gvBrowseUDF_DOB' => 'required|date',
            'gvBrowseUDF_TARIKHMEMOHON' => 'required|date',
            'gvBrowseUDF_PEKERJAAN' => 'required|string|max:255',
            'gvBrowseUDF_JANTINA' => 'required|string|max:255',
        ];
    }
}
