@extends('admin.layouts.admin')


@section('content')

    <h2>Смена пароля админа</h2>

    <div class="container mt-5 Events__edit-form">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <form method="post" enctype="multipart/form-data">

            @csrf

            <div class="form-group row">
                <label for="url" class="col-sm-2 col-form-label">Новый пароль</label>
                <div class="col-sm-10">
                    <input
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            required="required"
                            minlength="6"
                            value=""
                    >
                </div>
            </div>

            <div class="form-group row">
                <label for="url" class="col-sm-2 col-form-label">Подтверждение пароля</label>
                <div class="col-sm-10">
                    <input
                            type="password"
                            name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="password_confirmation"
                            required="required"
                            minlength="6"
                            value=""
                            oninput="check(this)"
                    >
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Изменить пароль</button>
        </form>
    </div>

    <script language='javascript' type='text/javascript'>
        function check(input) {
            if (input.value !== document.getElementById('password').value) {
                input.setCustomValidity('Password Must be Matching.');
            } else {
                // input is valid -- reset the error message
                input.setCustomValidity('');
            }
        }
    </script>

@endsection