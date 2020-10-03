@extends('simpleform::layouts.master')

@section('content')
    <div class="container mt-5">
        <form action="{{route('simpleform.store')}}" method="post" enctype="multipart/form-data">
            <h3 class="text-center mb-5">Tru Doc 24/7 Task</h3>
            <div class="alert alert-success">
                <strong>Note 1 : I don't know if other file types are accepted or not so i considered it as accepted as it is not mentioned as rejected if it's rejected i will add just small check </strong>
                <br>
                <br>
                <strong>Note 2 : please fill in the env file those data where  MAIL_USERNAME equal MAIL_FROM_ADDRESS
                    (MAIL_USERNAME,
                    MAIL_PASSWORD,
                    MAIL_FROM_ADDRESS,
                    MAIL_TO_EMAIL)
                </strong>
                <br>
                <br>
                <strong>Note 3 : this step has to be done to allow (Gmail) account to send mail from the system "Once you are on My Account Page then click on Security and scroll down to the bottom and you will find ‘Less secure app access’ settings. Click on the radio button to set it ON."</strong>
            </div>
            <br>
            @csrf
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
                @php Session::forget('success') @endphp
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <br>

            <div>
                <label for="chooseFile">Data 01</label>
                <input type="text" name="data01">
            </div>
            <br>
            <div>
                <label for="chooseFile">Data 02</label>
                <input type="text" name="data02">
            </div>
            <br>
            <div>
                <label for="chooseFile">Data 03</label>
                <input type="text" name="data03">
            </div>
            <br>
            <div>
                <input type="file" name="file" id="chooseFile">
            </div>
            <button type="submit" name="submit" >
                submit
            </button>
        </form>
    </div>
@endsection
