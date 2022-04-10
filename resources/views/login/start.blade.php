@extends('public_template')
@section('content')



<h2>Logowanie</h2>
<form action="/login" method="post">
    @csrf

    <div class="col-md-8">
        <label class="form-label">Nazwa użytkownika:</label>
        <input class="form-control" type="text" name="username" placeholder="Username:" required>
    </div>

    @error('username')
    <p class="text-danger mt-1">{{$message}}</p>

    @enderror
    <div class="col-md-8">
        <label class="form-label">Hasło:</label>
        <br>
        <input class="form-control" type="password" name="password" placeholder="Hasło:" required>
    </div>
    <div class="col-md-8">
        <br>
        <button type="submit" name="submit">Zaloguj się</button>
    </div>


</form>

@endsection
