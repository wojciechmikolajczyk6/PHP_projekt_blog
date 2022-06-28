@extends('admin_template')

@section('content')
    <form method='POST' action='/admin/editUser/{{$editUser->id}}/edit'>
        @csrf
        @method('PATCH')
        <div hidden class="form-group">
            <label class="form-label">ID uzytkownika</label>
            <input name="id" type="text" class="form-control" placeholder="Enter title:" value="{{$editUser->id}}">
        </div>
        <div class="form-group">
            <label class="form-label">Nazwa uzytkownika</label>
            <input name="username" type="text" class="form-control" placeholder="Enter title:" value=" {{$editUser->username}}">
        </div>
        <div class="form-group">
            <label class="form-label">Imie i nazwisko</label>
            <input name="name" type="text" class="form-control" placeholder="Enter title:" value=" {{$editUser->name}}">
        </div>
        <div class="form-group">
            <label class="form-label">Email</label>
            <br>
            <input name="email" type="text" class="form-control" placeholder="Email:" value=" {{$editUser->email}}">
        </div>
        <br>


        <button name="submit" type="submit" class="btn btn-primary">Zatwierdż zmianę</button>
        <button name="delete" type="submit" class="btn btn-outline-warning">Usuń uzytkownika</button>
        <a href="/admin" class="btn btn-danger">Anuluj zmiany</a>
    </form>
    <br>




@endsection

