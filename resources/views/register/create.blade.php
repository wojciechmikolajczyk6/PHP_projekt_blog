@extends('public_template')
<script src="https://www.google.com/recaptcha/api.js"></script>

<script>
    function onSubmit(token) {
        document.getElementById("demo-form").submit();
    }
</script>
@section('content')
    <div class="col-md-8">
    <form action="/register" method="post">
        @csrf
            <label class="form-label">Imie i nazwisko:</label>
            <input class="form-control" value="{{ old('name') }}" type="text" name="name" placeholder="Wprowadz nazwę użytkownika:" required>
            @error('name')
            <p class="text-danger text-xs mt-1">{{$message}}</p>

            @enderror

            <label class="form-label">Email:</label>
            <input class="form-control" value="{{ old('email') }}" type="email" name="email" placeholder="Email:" required>
        @error('email')
        <p class="text-danger text-xs mt-1">{{$message}}</p>

        @enderror

            <label class="form-label">Nazwa użytkownika:</label>
            <input class="form-control" type="text" value="{{ old('username') }}" name="username" placeholder="Username:" required>
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
