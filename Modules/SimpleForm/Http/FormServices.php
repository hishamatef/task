<?php

namespace Modules\SimpleForm\Http;

use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Modules\SimpleForm\Entities\SimpleForm;
use Modules\SimpleForm\Http\Requests\StoreSimpleForm;
use Modules\SimpleForm\Imports\ImportFile;

class FormServices
{
    public function storeService(StoreSimpleForm $request)
    {
        try {
            $valid_check = $this->validate_file($request);
            if($valid_check){
                $path = $this->uploadFile($request);
                $this->importFile($path);
                $this->sendEmail();
            }else{
                info('please,upload a file');
            }
        } catch (\Throwable $e) {
            info($e->getTrace());
        }
    }

    protected function validate_file($data)
    {
        if ($data->hasFile('file')) {
            if ($data->file('file')->isValid()) {
                return 1;
            }
        }
        return 0;
    }

    protected function uploadFile($data)
    {
        $path = $data->file->store('uploads', 'public');
        return (public_path('storage') . '/' . $path);
    }
    protected function importFile($destinationPath)
    {
        Excel::import(new ImportFile, $destinationPath);
    }

    protected function sendEmail()
    {
        $accepted_count = SimpleForm::getAcceptedRecordsCount();
        $rejected_count = SimpleForm::getRejectedRecordsCount();
        $email_subject = 'Accepted and Rejected Records Count';
        $email_body = 'Accepted records count is '.$accepted_count.' and Rejected Records Count is '.$rejected_count ;
        SimpleForm::sendEmail($email_subject,$email_body,'Hisham Atef',env('MAIL_TO_EMAIL'),'truedoc 24/7','noreply@trudoc247.com');
    }

}
