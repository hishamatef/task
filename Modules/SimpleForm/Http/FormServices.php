<?php

namespace Modules\SimpleForm\Http;

use App\Jobs\SendMail;
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
        (new ImportFile)->queue($destinationPath)->chain([
            new SendMail(),
        ]);
    }


}
