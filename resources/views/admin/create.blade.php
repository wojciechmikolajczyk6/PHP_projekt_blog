@extends('admin_template')

@section('content')
    <form method='post' action='/admin/addPost'>
        @csrf
        <div class="form-group">
            <label class="form-label">Tytuł posta</label>
            <input name="title" type="text" class="form-control" placeholder="Enter title:">
        </div>
        <div class="form-group">
            <label class="form-label">Skrót posta</label>
            <br>
            <textarea name="post_fragment" class="form-control" placeholder="Wpisz skrót posta:" id="post_body" cols="50" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Treść posta</label>
            <br>
            <textarea name="body" class="form-control" placeholder="Wpisz treść posta:" id="post_body" cols="50" rows="10"></textarea>
        </div>

        <br>

        <label class="form-label">Kategoria</label>
        <select name="category_id" id="category_id">
            @php
            $categories = \App\Models\Category::all();

            @endphp
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{ $category->name }}</option>
            @endforeach

        </select>

        <button name="submit" type="submit" class="btn btn-primary">Dodaj</button>
        <a href="index.php" class="btn btn-danger">Anuluj</a>
    </form>
    <br>

@endsection
