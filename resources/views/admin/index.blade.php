@extends('admin_template')

@section('content')

    <table class="table table-striped">

        <tr>
            <th>ID uzytkownika</th>
            <th>Nazwa uzytkownika</th>
            <th>Email</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->email}}</td>
        </tr>
        @endforeach


    </table>

    <table class="table table-striped">
        <tr>
            <th>ID postu</th>
            <th>Nazwa postu</th>
            <th>Kategoria</th>
            <th>Autor</th>
            <th>Data</th>
            <th>Edytuj</th>
            <th>Usuń</th>
        </tr>
        <tr>
            @foreach ($posts as $post)
            <td>{{$post->id}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->category->name}}</td>
            <td>{{$post->author->name}}</td>
            <td>{{$post->created_at}}</td>
                <td><a href="/admin/<?= $post->id;?>">Edytuj</a></td>
{{--                <td><a href="/admin/<?= $post->id;?>">Usun</a></td>--}}
                <td><form method="POST" action="/admin/<?=$post->id?>">
                    @csrf
                    @method('DELETE')
                        <button class="text-danger">Usuń</button></form></td>
                </form>

        </tr>
        @endforeach

    </table>



@endsection
