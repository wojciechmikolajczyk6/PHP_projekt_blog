@extends('admin_template')

@section('content')

    <div class="container box">
        <h3 align="center">Lista uzytkownikow</h3><br />
        <div class="panel panel-default">
            <div class="panel-heading">Wyszukaj uzytkownika</div>
            <div class="panel-body">
                <div class="form-group">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search User Data" />
                </div>
                <div class="table-responsive">
                    <h3 align="center">Liczba wyszukanych uzytkownikow : <span id="total_records"></span></h3>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Nazwa uzytkownika</th>
                            <th>Imie i nazwisko</th>
                            <th>email</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>


    <script>
        $(document).ready(function(){

            fetch_user_data();

            function fetch_user_data(query = '')
            {
                $.ajax({
                    url:"{{ route('index.action') }}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data)
                    {
                        $('tbody').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                })
            }

            $(document).on('keyup', '#search', function(){
                var query = $(this).val();
                fetch_user_data(query);
            });
        });
    </script>
@endsection
