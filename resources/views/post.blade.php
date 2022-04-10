
@extends('public_template')
<!-- Bootstrap core CSS -->



    @section('content')
        <div class="blog-post">
            <h2 class="blog-post-title"><?=$post->title?></h2>
            <p class="blog-post-meta"><?= $post->date; ?>
        By <a href="/authors/{{$post->author->username}}"><?=$post->author->name?></a> in <a href="/categories/{{$post->category->name}}"> {{ $post->category->name }}</a>
        <article>
            <?=$post->body?>
        </article>
        <a href="/">Go back</a>
        </div>
        @section('comment')
            @auth
            <section class="col-span-8 col-start-5 mt-10 space-y-6">
                <form method="post" action="/comments" class="border border-gray-100 p-6 border roundex-xl">
                    @csrf
                    <header class="flex items-center">
                        <h2>Napisz komentarz:</h2>
                    </header>
                    <div class>
                        <textarea  name="body" id="" cols="30" rows="10" class="w-full" placeholder="Treść komentarza...."></textarea>
                    </div>
                    <div>
                        <?php session(['post_id' => $post->id])?>
                        <button class="btn-success px-5 py-2 hover:bg-blue-500" type="submit">Wyślij komentarz</button>
                    </div>
                    @endauth
                    @guest
                        <h2><a href="/login">Zaloguj się</a> aby móc komentować!</h2>
                        @endguest


                </form>
            </section>

            @foreach ($post->comment as $comment)

            <article class="flex mt-10 bg-gray-100 p-6 border border-gray-200 roundex-xl">
                <div style="flex-shrink: 0; margin: 10px;">
                    <img style="border-radius: 50%;" src="https://eu.ui-avatars.com/api/?name={{$comment->author->username}}">
                </div>

                <div>
                    <header>
                        <h3><strong>{{$comment->author->username}}</strong></h3>
                        <p class="text-xs">Posted <time>{{$comment->created_at }}</time></p>
                    </header>
                    <p>
                            {{$comment->body}}
                    </p>

                </div>
            </article>

            @endforeach

        @endsection


    @endsection
