@extends('public_template')

@section('content')
    <form method='post' action='addPost'>
        @csrf
        <div class="form-group">
            <label class="form-label">Post title</label>
            <input name="title" type="text" class="form-control" placeholder="Enter title:">
        </div>

        <div class="form-group">
            <label class="form-label">Krotki opis zawartosci posta</label>
            <br>
            <textarea name="post_fragment" class="form-control" placeholder="Enter body of the post:" id="" cols="50" rows="10"></textarea>
        </div>


        <div class="form-group">
            <label class="form-label">Tresc posta</label>
            <br>
            <textarea name="body" class="form-control" placeholder="Enter body of the post:" id="" cols="50" rows="10"></textarea>
        </div>

        <br>

        <label class="form-label">Category</label>
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

