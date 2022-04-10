@extends('public_template')
@section('search')
    <div class="input-group">
        <form method="get" action="/">
{{--        <select class="select" data-mdb-filter="true" placeholder="kategoria">--}}
{{--            <option value="1">One</option>--}}
{{--            <option value="2">Two</option>--}}
{{--            <option value="3">Three</option>--}}
{{--            <option value="4">Four</option>--}}
{{--            <option value="5">Five</option>--}}
{{--            <option value="6">Six</option>--}}
{{--            <option value="7">Seven</option>--}}
{{--            <option value="8">Eight</option>--}}
{{--            <option value="9">Nine</option>--}}
{{--            <option value="10">Ten</option>--}}
{{--        </select>--}}
        <div class="form-outline">
            <input type="text" name="search" id="form1" class="form-control" placeholder="search" value="{{ request('search') }}" />

        </div>
        </form>
    </div>

@endsection

@section('content')
        <?php foreach ($posts as $post):?>
        <div class="blog-post">
            <h2 class="blog-post-title"><a href="/posts/<?= $post->id;?>"> <?= $post->title;?></a></h2>

            <?= $post->created_at;?>
            <p>
                By <a href="/authors/{{$post->author->username}}"><?=$post->author->name?></a> in <a href="/categories/{{$post->category->name}}"> {{ $post->category->name }}</a>
            </p>
            <?= $post->body;?>

        </div>



        <?php endforeach;?>
    {{$posts ->links("pagination::bootstrap-4")}}

    @section('category')
        <?php $categories = \App\Models\Category::all();?>
        @foreach ($categories as $category)
        <li><a href="/categories/{{$category->name}}">{{ $category->name }}</a></li>

        @endforeach
    @endsection



@endsection

