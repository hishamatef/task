<?php

namespace Modules\SimpleForm\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SimpleForm\Entities\SimpleForm;
use Modules\SimpleForm\Http\Requests\StoreSimpleForm;
use Spatie\Activitylog\Models\Activity;

class SimpleFormController extends Controller
{
    public function index()
    {
        return view('simpleform::index');
    }

    public function store(StoreSimpleForm $request)
    {
        try {
            $simple_form = $this->createRecord($request);
            $simple_form_item = SimpleForm::find($simple_form->id);
            $simple_form_item->addMedia($request['file'])->toMediaCollection('only-xlsx-please');
            $this->sendEmail();
            \Session::put('success', 'Successfully Done');
            return redirect(route('simpleform.index'));
        }catch (\Throwable $e){
            echo "<pre>";
            print_r('<br />');
            print_r($e->getMessage());
            print_r('<br />');
            print_r('Something Went Wrong, please check the error message above');
            print_r('<br />');
            die('Hisham');
        }
    }

    public function createRecord($data)
    {
        return SimpleForm::create([
            'data01' => $data['data01'],
            'data02' => $data['data02'],
            'data03' => $data['data03']
        ]);
    }

    public function sendEmail()
    {
        $accepted_count = SimpleForm::getRecordsCount('form-accepted');
        $rejected_count = SimpleForm::getRecordsCount('form-rejected');
        $email_subject = 'Accepted and Rejected Records Count';
        $email_body = 'Accepted records count is '.$accepted_count.' and Rejected Records Count is '.$rejected_count ;
        SimpleForm::sendEmail($email_subject,$email_body,'Hisham Atef',env('MAIL_TO_EMAIL'),'truedoc 24/7','noreply@trudoc247.com');
    }

}
