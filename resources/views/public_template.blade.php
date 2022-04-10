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
            <a class="blog-nav-item" href="/">Wszystkie posty</a>
            <?php if (isset(auth()->user()->name) && (auth()->user()->name == 'admin')):?>
                <a class='blog-nav-item' href='admin/'>Admin</a>

            <?php endif;?>
            @guest
            <a class="blog-nav-item" href="/register">Rejestracja</a>
            <a class="blog-nav-item" href="/login">Logowanie</a>
            @else
                <div class="mt-8 md:mt-0 fixed right-10 flex items-center">
                <span class="">{{ auth()->user()->name }}</span>
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
</body>

</html>
