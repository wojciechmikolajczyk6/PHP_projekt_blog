
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Strona admina.</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/custom.css" rel="stylesheet">
</head>

<body>

<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item active" href="/admin">Strona admina</a>
            <a class="blog-nav-item" href="/admin/create">Dodaj post</a>
            <a class="blog-nav-item pull-right" href="/">Strona główna</a>
        </nav>
    </div>
</div>

<div class="container">

    <div class="blog-header">
        <h2>Admin</h2>
    </div>



    @yield('content')
    <div class="row">




        </div><!-- /.row -->

    </div><!-- /.container -->




    <div class="blog-footer">
        <p>Blog o Japonii i języku Japońskim</p>
        <p>
            <a href="#">Back to top</a>
        </p>
    </div>


    <!-- Bootstrap core JavaScript
        ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>

