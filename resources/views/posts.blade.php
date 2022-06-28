@extends('public_template')
@section('search')
    <div class="input-group">
{{--        <form method="get" action="/">--}}
        <div class="form-outline">
            <input type="text" name="search" id="search" class="form-control search" placeholder="search" value="{{ request('search') }}" />

        </div>
        </form>
    </div>

@endsection

@section('content')

        <div class="blog-post post_search" id="posts">
            <?php foreach ($posts as $post):?>
            <h2 class="blog-post-title" id="title"><a href="/posts/<?= $post->id;?>"> <?= $post->title;?></a></h2>

            <?= $post->created_at;?>
            <p>
                <a href="/categories/{{$post->category->name}}"> {{ $post->category->name }}</a>

                By <a href="/authors/<?=$post->author->username;?>"><?=$post->author->name;?></a> in <a href="/categories/{{$post->category->name}}"> {{ $post->category->name }}</a>
            </p>
            <?= $post->post_fragment;?>
                <hr>
                <?php endforeach;?>
        </div>


{{$posts ->withQueryString()->links()}}
@endsection

{{--AJAX CODE--}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="application/javascript">



    $(document).ready(function(){
        $('#search').on('keyup', function () {
            // if (e.keyCode == 13) {
                var search = $('#search').val();
                console.log(search);
                $.ajax({

                    method: "GET",
                    url: "/",
                    //data: search,
                    data: {search: $('#search').val()},
                })
                    .done(function (response) {
                        console.log(response.data);

                        var JSON_response = JSON.parse(JSON.stringify(response.data));
                        var category = JSON.parse(JSON.stringify(response.categories))
                        console.log(JSON.stringify(category[1]['name']))
                        //alert("sukcess");
                        $('div#posts').empty();
                        $.each(response.data, function (index, post) {
                                const html =
                                    '<h2 class="blog-post-title" id="title"><a href="/posts/' + post.id + '">' + post.title + '</a></h2>' +
                                    post.created_at+
                                    '<p><a href="/categories/'+category[post.category_id-1]['name']+'">' + category[post.category_id-1]['name'] + '</a></p>' +
                                    post.post_fragment +
                                    '</div>';

                                $('div#posts').append(html);
                            });

                    })
                    .fail(function (data) {
                        // alert('error');
                    })
            });
    });
</script>
<div id="data"></div>

