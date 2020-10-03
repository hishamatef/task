<?php

namespace Modules\SimpleForm\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSimpleForm extends FormRequest
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
        // check acceptance
//        $acceptance = $this->check_acceptance($this->all());
        //add to log
//        activity()
//        ->withProperties([
////            'data01' => $this['data01'],
////            'data02' => $this['data02'],
////            'data03' => $this['data03'],
//            'file' => isset($this['file'])?$_FILES['file']['name']:'',
//            'accepted' => $acceptance,
//        ])
//        ->log($acceptance==1?'form-accepted':'form-rejected');
        return [
//            'data01' => 'required',
//            'data02' => 'required',
//            'data03' => 'required',
            'file' => 'required|mimes:xlsx'
        ];
    }
//    public function check_acceptance($data){
//        if($data['data01'] == "" || $data['data02'] == "" ||  $data['data03'] == "" || !isset($data['file'])){
//            // check for empty data
//            // this function accepts also all files type if you need to accept xlsx files only add the condition below
//            // || (isset($data['file']) && $data['file']->extension() != 'xlsx')
//            return 0;
//        }
//        return 1;
//    }
}
