<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog o języku Japońskim</title>
    <!-- Bootstrap core CSS -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="/css/custom.css" rel="stylesheet">
</head>

<body>

<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item active" href="/">Strona główna</a>

            <?php if (isset(auth()->user()->name) && (auth()->user()->name == 'admin')):?>
                <a class='blog-nav-item' href='/admin'>Admin</a>

            <?php endif;?>
            @guest
            <a class="blog-nav-item" href="/register">Rejestracja</a>
            <a class="blog-nav-item" href="/login">Logowanie</a>
            @else
                <a class="blog-nav-item" href="/addPost">Dodaj post</a>
                <div class="mt-8 md:mt-0 fixed right-10 flex items-center">
                <a href="/userpage/{{ auth()->user()->name }}"><span class="">{{ auth()->user()->name }}</span></a>
                <form method="POST" action="/logout">
                    @csrf
                    <button class="text-xs text-green-600 ml-6" type="submit">Wyloguj się</button>
                </form>

                </div>
                @endguest


        </nav>
    </div>
</div>



<div class="container">

    <div class="blog-header">
        <div class="logo"><img src="/images/logoJPN.png" /></div>
        <h1 class="blog-title">Blog o Japonii</h1>
        <p class="lead blog-description">Japońska kultura, język, filmy i więcej.</p>
    </div>

    @yield('search')





    <div class="row">

        <div class="col-sm-8 blog-main">

            @yield('content')
            @yield('comment')

        </div><!-- /.blog-main -->


        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>O stronie</h4>
                <p>O mnie</p>
            </div>
            <div class="sidebar-module">
                <h4>Kategorie</h4>

                <ol class="list-unstyled">
{{--                    @yield('category')--}}
                    <?php $categories = \App\Models\Category::all();?>
                    @foreach ($categories as $category)
                        <li><a href="/categories/{{$category->name}}">{{ $category->name }}</a></li>
                    @endforeach
                </ol>
            </div>
        </div><!-- /.blog-sidebar -->

    </div><!-- /.row -->

</div><!-- /.container -->








<div class="blog-footer">
  <p>Blog o Japonii i języku Japońskim</p>
   <a href="/contact"><p>Kontakt</p></a>
  <p>
    <a href="#">Back to top</a>
  </p>
</div>

@if (session()->has('user_created'))

    <div x-data="{show: true}"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
        class="fixed bottom-10 right-10 bg-green-100 py-2 px-4 text-gray rounded-3xl">
        <p>
            {{session('user_created')}}
        </p>
    </div>
    @else (session()->has('user_loggedOut'))

        <div x-data="{show: true}"
             x-init="setTimeout(() => show = false, 4000)"
             x-show="show"
             class="fixed bottom-10 right-10 bg-green-100 py-2 px-4 text-gray rounded-3xl">
            <p>
                {{session('user_loggedOut')}}
            </p>
        </div>
    @endif
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdn.tiny.cloud/1/ldfdbjzphvljdbcymthcuqzl84w0l6iq1dcuxo5rlpvv0b0g/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: 'textarea#post_body, textarea#text_body',
        plugins: [
            "advlist autolink lists link image charmap preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media save table contextmenu directionality",
            "paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | formatselect styleselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | fullscreen code",
        // plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
        // toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
    });
</script>


</body>

</html>
