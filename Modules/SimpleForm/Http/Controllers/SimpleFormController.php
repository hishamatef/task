<?php

namespace Modules\SimpleForm\Http\Controllers;

use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Modules\SimpleForm\Entities\SimpleForm;
use Modules\SimpleForm\Http\FormServices;
use Modules\SimpleForm\Http\Requests\StoreSimpleForm;
use Modules\SimpleForm\Imports\ImportFile;

class SimpleFormController extends Controller
{
    public function index()
    {
        return view('simpleform::index');
    }

    public function store(StoreSimpleForm $request)
    {
        $services = new FormServices();
        $services->storeService($request);
        return view('simpleform::index')->with('success', 'Successfully Done');
    }
}
