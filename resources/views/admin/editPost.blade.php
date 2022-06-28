@extends('admin_template')

@section('content')
<?//= ddd($editPost)?>
    <form method='POST' action='/admin/{{$editPost->id}}/edit'>
        @csrf
        @method('PATCH')
        <div hidden class="form-group">
            <label class="form-label">Post id</label>
            <input name="post_id" type="text" class="form-control" placeholder="Enter title:" value="{{$editPost->id}}">
        </div>
        <div class="form-group">
            <label class="form-label">Tytuł</label>
            <input name="title" type="text" class="form-control" placeholder="Enter title:" value=" {{$editPost->title}}">
        </div>
        <div class="form-group">
            <label class="form-label">Skrót</label>
            <input name="post_fragment" type="text" class="form-control" placeholder="Enter title:" value=" {{$editPost->title}}">
        </div>
        <div class="form-group">
            <label class="form-label">Treść</label>
            <br>
            <textarea name="body" class="form-control" placeholder="Enter body of the post:" id="" cols="50" rows="10">{{$editPost->body}}</textarea>
        </div>
        <select name="category_id" id="category_id">
            @php
                $categories = \App\Models\Category::all();

            @endphp
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{ $category->name }}</option>
            @endforeach

        </select>
        <br>


        <button name="submit" type="submit" class="btn btn-primary">Zatwierdż zmianę</button>
        <button name="delete" type="submit" class="btn btn-outline-warning">Usuń post</button>
        <a href="/admin" class="btn btn-danger">Anuluj zmiany</a>
    </form>
    <br>




@endsection
