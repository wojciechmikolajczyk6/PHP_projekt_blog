@extends('public_template')
<script src="https://www.google.com/recaptcha/api.js"></script>

<script>
    function onSubmit(token) {
        document.getElementById("demo-form").submit();
    }
</script>
@section('content')
    <div class="col-md-8" id="register-form">
    <form action="/register" method="post">
        @csrf
            <label class="form-label">Imie i nazwisko:</label>
            <input class="form-control" value="{{ old('name') }}" type="text" name="name" placeholder="Imie i nazwisko:" required>
            @error('name')
            <p class="text-danger text-xs mt-1">{{$message}}</p>

            @enderror

            <label class="form-label">Email:</label>
            <input class="form-control " id="mail_check"value="{{ old('email') }}" type="email" name="email" placeholder="Email:" required>
        @error('email')
        <p  class="text-danger text-xs mt-1">{{$message}}</p>

        @enderror
        <p style='display:none' id="mail_validation" class="text-danger text-xs mt-1">Mail juz zajety</p>
        <p style='display:none' id="mail_KO" class="text-danger text-xs mt-1">Nieprawidłowy adres e-mail.</p>

            <label class="form-label">Nazwa użytkownika:</label>
            <input class="form-control" type="text" value="{{ old('username') }}" name="username" placeholder="Nazwa użytkownika:" required>
        @error('username')
        <p class="text-danger text-xs mt-1">{{$message}}</p>

        @enderror

            <label class="form-label">Hasło:</label>
            <br>
            <input class="form-control" type="password" name="password" placeholder="Hasło:" required>


            <label class="form-label">Powtórz hasło:</label>
            <br>
            <input class="form-control" type="password" name="password_repeat" placeholder="Hasło:" required>



            <br>
        <label class="form-label">Captcha:</label>
        {!!getCaptchaQuestion()!!}
        <input class="form-control" name="_answer" type="number">
        @error('_answer')
        <p class="text-danger mt-1">{{$message}}</p>
        @enderror

            <input class="btn btn-primary" type="submit" name="submit" value="Załóż konto.">


        </div>
    @if ($errors->any())
    <ul>
    @foreach ($errors->all() as $error)
        <li class="text-danger bg-danger btn-sm">{{$error}}</li>
        @endforeach
        @endif
    </ul>
    </form>



@endsection


{{--AJAX CODE--}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="application/javascript">

    $(document).ready(function(){
        $('#mail_check').on('blur', function (){
            var mail_check = $('#mail_check').val();
            console.log(mail_check);
            $.ajax({

                method: "GET",
                url: "/register",
                //data: search,
                data: {mail_check: mail_check},
            })
            .done(function (response){
                if (!mail_check.includes('@') || !mail_check.includes(".")){
                    console.log('Nieprawidlowy adres');
                    $('#mail_KO').show();
                    $('#mail_validation').hide();
                } else{
                    $('#mail_KO').hide();
                var email = response.data;
                console.log(email);
                if (email.length){
                    console.log('true');
                    $('#mail_validation').show();
                } else{
                    console.log('false');
                    $('#mail_validation').hide();
            }
                    }





            });
        });


    });
</script>
