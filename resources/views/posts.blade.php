@extends('public_template')
@section('search')
    <div class="input-group">
        <form method="get" action="/">
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
                By <a href="/authors/<?=$post->author->username;?>"><?=$post->author->name;?></a> in <a href="/categories/{{$post->category->name}}"> {{ $post->category->name }}</a>
            </p>
            <?= $post->post_fragment;?>

        </div>



        <?php endforeach;?>


{{$posts ->withQueryString()->links()}}
@endsection

