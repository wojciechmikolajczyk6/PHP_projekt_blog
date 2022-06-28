
@extends('public_template')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Nazwa uzytkownika</td>
            <td><?= $user['username']?></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Imie i nazwisko</td>
            <td><?= $user['name']?></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td colspan>Email</td>
            <td><?=$user['email']?></td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td colspan>Avatar</td>
            <td><img src=<?=$user['avatar']?>></td>
        </tr>
        </tbody>
    </table>
    <h2>Zmien swój Avatar</h2>
    <div class="container mt-5">
        <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
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
            <div class="custom-file">
                <label class="form-label" for="chooseFile">Wybierz zdjecie</label>
                <input type="file" name="file" class="form-control" id="chooseFile">

            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block mt-2">
                Zmień avatar
            </button>
        </form>
    </div>

@endsection
